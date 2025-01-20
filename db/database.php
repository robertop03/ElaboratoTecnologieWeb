<?php

class VinoDatabase {
    private $pdo;

    // Costruttore per la connessione al database
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=vino", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Esegui la query e restituisci il risultato
    private function executeQuery($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 1 - Estrarre tutti i vini con attributi e filtri opzionali 
    public function getAllVini(
        $lingua = 1, 
        $pmin = 0, 
        $pmax = 100000, 
        $prov = '%', 
        $friz = '%', 
        $tona = '%', 
        $dime = '%',
        $order = ''
    ) {
        
        //query interna per selezione con filtri
        $subQuery = "
            SELECT 
                PRODOTTO.ID_Prodotto, 
                Prezzo, 
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END
                ) AS Frizzantezza,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END
                ) AS Tonalita,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END
                ) AS Provenienza,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END
                ) AS Capacita_Bottiglia,
                TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
                TESTO_PRODOTTO.Descrizione,
                Foto,
                Quantita_Magazzino
            FROM 
                PRODOTTO
            JOIN TESTO_PRODOTTO 
                ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
            LEFT JOIN ATTRIBUTA 
                ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
            LEFT JOIN ATTRIBUTO 
                ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
            LEFT JOIN CATEGORIA 
                ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
            WHERE 
                TESTO_PRODOTTO.Lingua = :lingua
            GROUP BY 
                PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
            HAVING 
                (Frizzantezza        LIKE :friz)
                AND (Tonalita        LIKE :tona)
                AND (Provenienza     LIKE :prov)
                AND (Capacita_Bottiglia LIKE :dime)
                AND Prezzo BETWEEN :pmin AND :pmax
        ";
    
        //query esterna per utilizzo ordinamento senza problemi di raggruppamento 
        $finalQuery = "
            SELECT T.*
            FROM (
                $subQuery
            ) AS T
        ";
    
        //scelgo la query per il sort
        switch ($order) {
            case 'price_asc':
                $finalQuery .= " ORDER BY T.Prezzo ASC";
                break;
            case 'price_desc':
                $finalQuery .= " ORDER BY T.Prezzo DESC";
                break;
            case 'cap_asc':
                $finalQuery .= " ORDER BY FIELD(T.Capacita_Bottiglia, 
                                                 'Mezza 0.375l',
                                                 'Bottiglia 0.75l',
                                                 'Magnum 1.5l')";
                break;
            case 'cap_desc':
                $finalQuery .= " ORDER BY FIELD(T.Capacita_Bottiglia, 
                                                 'Mezza 0.375l',
                                                 'Bottiglia 0.75l',
                                                 'Magnum 1.5l') DESC";
                break;
            default:
                // Nessun ordine aggiuntivo
                break;
        }
    
        $params = [
            ':lingua' => $lingua,
            ':friz'   => $friz,
            ':tona'   => $tona,
            ':prov'   => $prov,
            ':dime'   => $dime,
            ':pmin'   => $pmin,
            ':pmax'   => $pmax
        ];
    
        // Esegui e restituisci i risultati
        return $this->executeQuery($finalQuery, $params);
    }

    public function getWinesPaginated($limit, $offset, $lingua = 1) {
        // Query principale senza filtri opzionali
        $query = "
            SELECT 
                PRODOTTO.ID_Prodotto, 
                Prezzo, 
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END
                ) AS Frizzantezza,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END
                ) AS Tonalita,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END
                ) AS Provenienza,
                GROUP_CONCAT(
                    CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END
                ) AS Capacita_Bottiglia,
                TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
                TESTO_PRODOTTO.Descrizione,
                Foto,
                Quantita_Magazzino
            FROM 
                PRODOTTO
            JOIN TESTO_PRODOTTO 
                ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
            LEFT JOIN ATTRIBUTA 
                ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
            LEFT JOIN ATTRIBUTO 
                ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
            LEFT JOIN CATEGORIA 
                ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
            WHERE 
                TESTO_PRODOTTO.Lingua = :lingua
            GROUP BY 
                PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':lingua', $lingua, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); 
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // 2 - Estrazione eventi 
    public function extractEvents($lingua = 1) {
        $query = "
        SELECT EVENTO.ID_Evento, Data_Inizio, Data_Fine, Foto, Titolo, Sottotitolo, Descrizione
        FROM EVENTO
        JOIN TESTO_EVENTO ON EVENTO.ID_EVENTO = TESTO_EVENTO.ID_EVENTO
        WHERE TESTO_EVENTO.Lingua = :lingua
        ";

        $params = [':lingua' => $lingua];
        return $this->executeQuery($query, $params);
    }

    // 3 - Estrazione prezzo del prodotto 
    public function getProductPrice($product_id) {
        $query = "SELECT Prezzo FROM PRODOTTO WHERE ID_Prodotto = :product_id";
        $params = [':product_id' => $product_id];
        return $this->executeQuery($query, $params);
    }

    // 4 - Verifica stock 
    public function checkStock($product_id) {
        $query = "SELECT Quantita_Magazzino FROM PRODOTTO WHERE ID_Prodotto = :product_id";
        $params = [':product_id' => $product_id];
        return $this->executeQuery($query, $params);
    }

    // 5 - Registrazione utente
    public function registerUser($email, $password, $name, $surname, $newsletter = 'N') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "
        INSERT INTO UTENTE (Email, Password, Nome, Cognome, Newsletter) 
        VALUES (:email, :password, :name, :surname, :newsletter)
        ";
        $params = [
            ':email' => $email,
            ':password' => $hashed_password,
            ':name' => $name,
            ':surname' => $surname,
            ':newsletter' => $newsletter
        ];
        return $this->executeQuery($query, $params);
    }

    // 6 - Elimina utente
    public function deleteUser($email) {
        $query = "DELETE FROM UTENTE WHERE Email = :email";
        $params = [':email' => $email];
        return $this->executeQuery($query, $params);
    }

    // 7 - Verifica password utente
    public function verifyPassword($email, $password) {
        $query = "SELECT * FROM UTENTE WHERE Email = :email AND Password = :password";
        $params = [':email' => $email, ':password' => $password];
        $result = $this->executeQuery($query, $params);
    
        // Se esiste un risultato, la password è corretta
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 8 - Registrazione metodo di pagamento
    public function registerPaymentMethod($method_id, $card_number, $expiration_month, $expiration_year, $email) {
        $query = "
        INSERT INTO METODO_PAGAMENTO (ID_Metodo, Numero_Carta, mese_scadenza, anno_scadenza, Email) 
        VALUES (:method_id, :card_number, :expiration_month, :expiration_year, :email)
        ";
        $params = [
            ':method_id' => $method_id,
            ':card_number' => $card_number,
            ':expiration_month' => $expiration_month,
            ':expiration_year' => $expiration_year,
            ':email' => $email
        ];
        return $this->executeQuery($query, $params);
    }

    // 9 - Registrazione ordine
    public function registerOrder($order_id, $order_date, $order_status, $method_id, $email, $address_id) {
        $query = "
        INSERT INTO ORDINE (ID_Ordine, Data, Stato, ID_Metodo, Email, ID_Indirizzo) 
        VALUES (:order_id, :order_date, :order_status, :method_id, :email, :address_id)
        ";
        $params = [
            ':order_id' => $order_id,
            ':order_date' => $order_date,
            ':order_status' => $order_status,
            ':method_id' => $method_id,
            ':email' => $email,
            ':address_id' => $address_id
        ];
        return $this->executeQuery($query, $params);
    }

    // 10 - Registrazione indirizzo
    public function registerAddress($address_id, $street, $street_number, $postal_code, $city, $country, $email) {
        $query = "
        INSERT INTO INDIRIZZO (ID_Indirizzo, Via, Numero_Civico, CAP, Citta, Paese, Email) 
        VALUES (:address_id, :street, :street_number, :postal_code, :city, :country, :email)
        ";
        $params = [
            ':address_id' => $address_id,
            ':street' => $street,
            ':street_number' => $street_number,
            ':postal_code' => $postal_code,
            ':city' => $city,
            ':country' => $country,
            ':email' => $email
        ];
        return $this->executeQuery($query, $params);
    }

    //11 Funzione per aggiungere il un testo prodotto
    public function addProductText($id_text, $language, $title, $subtitle, $description, $product_id) {
        $query = "INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) 
                  VALUES (:id_text, :language, :title, :subtitle, :description, :product_id)";
        $params = [
            ':id_text' => $id_text,
            ':language' => $language,
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':description' => $description,
            ':product_id' => $product_id
        ];
        return $this->executeQuery($query, $params);
    }
    
    //11 modifica il un testo prodotto dato id testo
    public function modifyProductText($id_text, $language, $title, $subtitle, $description) {
        $query = "UPDATE TESTO_PRODOTTO 
                  SET Lingua = :language, Titolo = :title, Sottotitolo = :subtitle, Descrizione = :description 
                  WHERE ID_Testo = :id_text";
        $params = [
            ':id_text' => $id_text,
            ':language' => $language,
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':description' => $description
        ];
        return $this->executeQuery($query, $params);
    }

    // 16 - Modifica indirizzo
    public function modifyAddress($address_id, $street, $street_number, $cap, $city, $country) {
        $query = "UPDATE INDIRIZZO 
                  SET Via = :street, Numero_Civico = :street_number, CAP = :cap, Citta = :city, Paese = :country 
                  WHERE ID_Indirizzo = :address_id";
        $params = [
            ':street' => $street,
            ':street_number' => $street_number,
            ':cap' => $cap,
            ':city' => $city,
            ':country' => $country,
            ':address_id' => $address_id
        ];
        return $this->executeQuery($query, $params);
    }

    // 16 - Elimina indirizzo
    public function deleteAddress($address_id) {
        $query = "DELETE FROM INDIRIZZO WHERE ID_Indirizzo = :address_id";
        $params = [':address_id' => $address_id];
        return $this->executeQuery($query, $params);
    }

    // 12 - Funzione per filtrare gli eventi disponibili per una data di inizio e una data di fine specifica 
    //formato data : YYYY-MM-DD
    public function getEventiByDate($data_inizio, $data_fine) {
        $query = "SELECT * FROM EVENTO WHERE Data_Inizio >= :data_inizio AND Data_Fine <= :data_fine";

        // Parametri della query
        $params = [
            ':data_inizio' => $data_inizio,
            ':data_fine' => $data_fine
        ];

        // Esegui la query e restituisci i risultati
        return $this->executeQuery($query, $params);
    }

    // 15 - Funzione per estrarre un singolo vino da mostrare nella pagina prodotto
    public function getVinoById($lingua = 1, $id_prodotto) {
        $query = "
        SELECT 
            PRODOTTO.ID_Prodotto, 
            Prezzo, 
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
            TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
            TESTO_PRODOTTO.Descrizione,
            PRODOTTO.Quantita_Magazzino,
            PRODOTTO.Foto,
            TESTO_PRODOTTO.Sottotitolo
        FROM 
            PRODOTTO
        JOIN 
            TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
        LEFT JOIN 
            ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
        LEFT JOIN 
            ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
        LEFT JOIN 
            CATEGORIA ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
        WHERE 
            TESTO_PRODOTTO.Lingua = :lingua
        AND 
            PRODOTTO.ID_Prodotto = :id_prodotto
        GROUP BY 
            PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
        ";

        // Parametri della query
        $params = [
            ':lingua' => $lingua,
            ':id_prodotto' => $id_prodotto
        ];

        // Esegui la query e restituisci i risultati
        return $this->executeQuery($query, $params);
    }

    // 16 - Funzione per cancellare un indirizzo
    public function deleteIndirizzo($id_indirizzo) {
        $query = "DELETE FROM INDIRIZZO WHERE ID_Indirizzo = :id_indirizzo";

        // Parametri della query
        $params = [
            ':id_indirizzo' => $id_indirizzo
        ];

        // Esegui la query
        $this->executeQuery($query, $params);
    }

    // 16 - Funzione per modificare un indirizzo
    public function updateIndirizzo($id_indirizzo, $via, $numero_civico) {
        $query = "UPDATE INDIRIZZO SET Via = :via, Numero_Civico = :numero_civico WHERE ID_Indirizzo = :id_indirizzo";

        // Parametri della query
        $params = [
            ':id_indirizzo' => $id_indirizzo,
            ':via' => $via,
            ':numero_civico' => $numero_civico
        ];

        // Esegui la query
        $this->executeQuery($query, $params);
    }

    // 17 - Elimina metodo di pagamento
    public function deletePaymentMethod($method_id) {
        $query = "DELETE FROM METODO_PAGAMENTO WHERE ID_Metodo = :method_id";
        $params = [':method_id' => $method_id];
        return $this->executeQuery($query, $params);
    }

    // 22 23 - modifica iscrizione alla newsletter
    public function setNewsletter($email , $state) {
        $query = "UPDATE UTENTE SET Newsletter = :newsletter WHERE Email = :email";
        $params = [':email' => $email,':newsletter' => $state];
        return $this->executeQuery($query, $params);
    }

    // 24 - Funzione per aggiungere un vino ai preferiti
    public function addVinoToPreferiti($email, $id_prodotto) {
        $query = "INSERT INTO Preferisce (Email, ID_Prodotto) VALUES (:email, :id_prodotto)";

        // Parametri della query
        $params = [
            ':email' => $email,
            ':id_prodotto' => $id_prodotto
        ];

        // Esegui la query
        $this->executeQuery($query, $params);
    }

    // 25 - Funzione per rimuovere un vino dai preferiti
    public function removeVinoFromPreferiti($email, $id_prodotto) {
        $query = "DELETE FROM Preferisce WHERE Email = :email AND ID_Prodotto = :id_prodotto";

        // Parametri della query
        $params = [
            ':email' => $email,
            ':id_prodotto' => $id_prodotto
        ];

        // Esegui la query
        $this->executeQuery($query, $params);
    }

    //26 -  Funzione per visualizzare i vini preferiti qcpass
    public function getViniPreferiti($lingua = 1, $email) {
        $query = "
        SELECT 
            PRODOTTO.ID_Prodotto, 
            Prezzo, 
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
            TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
            TESTO_PRODOTTO.Descrizione,
            PRODOTTO.Foto
        FROM 
            PRODOTTO
        JOIN 
            TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
        JOIN 
            Preferisce PR ON PRODOTTO.ID_Prodotto = PR.ID_Prodotto 
        LEFT JOIN 
            ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
        LEFT JOIN 
            ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
        LEFT JOIN 
            CATEGORIA ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
        WHERE 
            TESTO_PRODOTTO.Lingua = :lingua
        AND
            PR.Email = :email
        GROUP BY 
            PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
        ";

        // Parametri della query
        $params = [
            ':email' => $email,
            ':lingua' => $lingua
        ];

        // Restituisce i risultati della query
        return $this->executeQuery($query, $params);
    }

    // 28 - Funzione per estrarre tutti gli ordini di un determinato utente
    public function getOrdiniByEmail($email) {
        $query = "SELECT * FROM ORDINE WHERE Email = :email";

        // Parametri della query
        $params = [
            ':email' => $email
        ];

        // Restituisce i risultati della query
        return $this->executeQuery($query, $params);
    }

    // 29 - Funzione per estrarre i vini acquistati in un determinato ordine
    public function getViniAcquistatiByOrderId($lingua = 1, $idOrdine) {
        $query = "
        SELECT 
            PRODOTTO.ID_Prodotto, 
            TESTO_PRODOTTO.Titolo, 
            Compone.Quantità, 
            PRODOTTO.Prezzo
        FROM 
            Compone
        JOIN 
            PRODOTTO ON Compone.ID_Prodotto = PRODOTTO.ID_Prodotto
        JOIN 
            TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
        WHERE 
            Compone.ID_Ordine = :idOrdine
            AND TESTO_PRODOTTO.Lingua = :lingua
        ";

        // Parametri della query
        $params = [
            ':idOrdine' => $idOrdine,
            ':lingua' => $lingua
        ];

        // Restituisce i risultati della query
        return $this->executeQuery($query, $params);
    }



    // Funzione per eseguire il reset del database qcpass
    public function resetDB() {
        try {
            // Esegui il file di creazione del database
            $this->executeSQLFile("creazione_db.sql");

            // Esegui il file di popolazione del database
            $this->executeSQLFile("popolazione.sql");

            echo "Database resettato con successo!";
        } catch (Exception $e) {
            echo "Errore durante il reset del database: " . $e->getMessage();
        }
    }

    // Funzione privata per eseguire un file SQL (utilizzata per il reset del database da file) qcpass
    private function executeSQLFile($filePath) {
        if (!file_exists($filePath)) {
            throw new Exception("File non trovato: $filePath");
        }

        // Leggi il contenuto del file
        $sql = file_get_contents($filePath);
        if ($sql === false) {
            throw new Exception("Impossibile leggere il file: $filePath");
        }

        // Suddividi ed esegui le query
        $this->pdo->exec($sql);
    }

    public function checkLogin($email, $password) {
        $query = "
        SELECT Email, Password FROM UTENTE WHERE Email = :email";
        $params = [':email' => $email];
    
        // Recupera i dati dell'utente
        $result = $this->executeQuery($query, $params);
        if ($result && count($result) > 0) {
            $hashed_password = $result[0]['Password'];
            if (password_verify($password, $hashed_password)) {
                unset($result[0]['Password']);
                return $result;
            }
        }
    
        return [];
    }
    

    public function checkExistsUser($email){
        $query = "
        SELECT COUNT(*) AS total
        FROM UTENTE WHERE email = :email";

        // Parametri della query
        $params = [
            ':email' => $email
        ];

        // Restituisce i risultati della query
        return $this->executeQuery($query, $params);
    }

    public function checkIsAdmin($email) {
        $query = "
            SELECT COUNT(*) AS total
            FROM UTENTE
            WHERE email = :email
            AND admin = 'Y'
        ";
    
        // Parametri della query
        $params = [
            ':email' => $email
        ];
    
        // Eseguo la query e ottengo il risultato
        $result = $this->executeQuery($query, $params);
    
        // Controllo il valore di 'total' nella prima riga (se esiste)
        // Se total > 0, significa che esiste almeno un utente con email corrispondente e admin = TRUE
        if ($result[0]['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    //funzione che restituisce tutti gli ordini del sito
    public function getAllOrders() {
        $query = "
            SELECT 
                ID_Ordine, 
                Email,
                Data, 
                Stato
            FROM ORDINE
            ORDER BY Data DESC
        ";
    
        $params = [];
    
        // Esegui la query con la funzione interna executeQuery
        return $this->executeQuery($query, $params);
    }

    //funzione che restituisce gli ordini con limite e offset per impaginazione
    public function getOrdersPaginated($limit, $offset) {
            $sql = "
            SELECT *
            FROM ORDINE
            ORDER BY Data DESC
            LIMIT :limit OFFSET :offset
        ";

        // Invece di passare $params a executeQuery, fai il bind manuale degli int
        $stmt = $this->pdo->prepare($sql);

        // bindValue con PDO::PARAM_INT
        $stmt->bindValue(':limit',  (int)$limit,  PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // funzione per ottenere il nome e cognome dell'utente loggato se presenti
    public function getNameAndSurname($email){
        $query = "
           SELECT nome, cognome
           FROM UTENTE
           WHERE (nome IS NOT NULL OR cognome IS NOT NULL) AND email = :email;
       ";
   
       $params = [
        ':email' => $email
       ];

       return $this->executeQuery($query, $params);
   }

    // funzione per aggiornare o aggiungere nome e cognome di un utente
    public function updateNameAndSurname($nome, $cognome, $email){
         $query = "
           UPDATE UTENTE
           SET
                nome = CASE 
                    WHEN nome = '' OR nome != :nome THEN :nome 
                ELSE nome 
                END,
                cognome = CASE 
                    WHEN cognome = '' OR cognome != :cognome THEN :cognome
                    ELSE cognome 
                END
            WHERE email = :email;
        ";
    
        $params = [
            ':email' => $email,
            ':nome' => $nome,
            ':cognome' => $cognome
        ];

        return $this->executeQuery($query, $params);
    }

    // funzione per aggiornare la password di un utente
    public function updatePassword($email, $password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "
          UPDATE UTENTE
          SET password = :password
          WHERE email = :email;
       ";
   
       $params = [
           ':email' => $email,
           ':password' => $hashed_password
       ];

       return $this->executeQuery($query, $params);
   }

   // funzione che restituisce l'hash della password di un determinato utente
   // utile per controllare se la vecchia password inserita è corretta e si può proseguire con il suo aggiornamento
   public function getHashPassword($email){
        $query = "
           SELECT password
           FROM UTENTE
           WHERE email = :email;
        ";

        $params = [
            ':email' => $email
        ];

        return $this->executeQuery($query, $params);
    }

    //returna il numero di utenti registrati (escludendo gli admin)
    public function getUsersCount() {
        $query = "SELECT COUNT(*) AS total FROM UTENTE WHERE admin IS NULL";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    
        // Ritorna il numero di utenti senza il campo admin impostato
        return $stmt->fetchColumn();
    }

    //returna il numero totale di ordini presenti nel db
    public function getTotalOrderCount() {
        $sql = "SELECT COUNT(*) AS total_orders FROM ORDINE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }

    // funzione che conta il numero di preferiti di un utente
    public function getNumberPrefs($email){
        $query = "
           SELECT COUNT(*) AS numero_occorrenze
           FROM preferisce
           WHERE email = :email;
        ";

        $params = [
            ':email' => $email
        ];

        return $this->executeQuery($query, $params);
    }

    //funzione che returna il numero di ordini da evadere
    public function getOrdersUnshipped() {
        $query = "SELECT COUNT(*) AS total_ordini FROM ORDINE WHERE Stato = 0";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchColumn();
    }

    //funzione che returna il numero totale di bottiglie presenti in magazzino
    public function getTotalBottleCount() {
        $query = "SELECT SUM(Quantita_Magazzino) FROM PRODOTTO";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    
        return (int) $stmt->fetchColumn();
    }

    // funzione per controllare se quel vino è preferito dall'utente
    public function checkVinoPreferito($email, $id){
        $query = "
           SELECT COUNT(*) AS is_favorite
           FROM preferisce
            WHERE email = :email AND id_prodotto = :id;
        ";

        $params = [
            ':email' => $email,
            ':id' => $id
        ];

        return $this->executeQuery($query, $params);
    }

    // funzione per prendere le notifiche dato un utente
    public function getNotifiche($lingua = 1, $email){
        $query = "
        SELECT N.ID_NOTIFICA, N.Data, TN.Titolo, TN.Testo, N.Visualizzato FROM Notifica AS N
         JOIN testo_notifica AS TN ON N.ID_NOTIFICA = TN.ID_NOTIFICA WHERE N.Email = :email AND TN.lingua = :lingua";

        $params = [
            ':email' => $email,
            ':lingua' => $lingua
        ];

        return $this->executeQuery($query, $params);
    }

    //funzione per ottenere dettagli ordine
    public function getOrderInfo($idOrdine) {
        $query = "
            SELECT 
                O.ID_Ordine,
                O.Data,
                O.Stato,
                O.Email,
                I.Via,
                I.Numero_Civico,
                I.CAP,
                I.Citta,
                I.Paese,
                M.Numero_Carta,
                M.mese_scadenza,
                M.anno_scadenza
            FROM ORDINE O
            LEFT JOIN INDIRIZZO I 
                   ON O.ID_Indirizzo = I.ID_Indirizzo
            LEFT JOIN METODO_PAGAMENTO M
                   ON O.ID_Metodo = M.ID_Metodo
            WHERE O.ID_Ordine = :id
        ";
    
        $params = [
            ':id' => $idOrdine
        ];
    
        $result = $this->executeQuery($query, $params);
        return isset($result[0]) ? $result[0] : null;
    }

    //funzione per ottenere gli item di un ordine
    public function getOrderItems($idOrdine) {
        $query = "
            SELECT 
                P.ID_Prodotto,
                TP.Titolo,
                P.Prezzo,
                C.Quantità
            FROM COMPONE C
            JOIN PRODOTTO P ON C.ID_Prodotto = P.ID_Prodotto
            JOIN TESTO_PRODOTTO TP ON P.ID_Prodotto = TP.ID_Prodotto
            WHERE C.ID_Ordine = :id
              AND TP.Lingua = 1
        ";
    
        $params = [
            ':id' => $idOrdine
        ];
    
        return $this->executeQuery($query, $params);
    }
    
    
    // funzione per segnalare come 'letta' una determinata notifica
    public function setNotificaLetta($idNotifica){
        $query = "
        UPDATE Notifica SET Visualizzato = 'Y' WHERE ID_NOTIFICA = :idNotifica
        ";

        $params = [
            ':idNotifica' => $idNotifica
        ];

        return $this->executeQuery($query, $params);
    }

    // funzione che restituisce il numero di notifiche ancora da leggere di un utente
    public function getNumeroNotificheNonLette($email){
        $query = "
        SELECT COUNT(ID_NOTIFICA) FROM Notifica WHERE Email = :email AND Visualizzato = 'N'
        ";

        $params = [
            ':email' => $email
        ];

        return $this->executeQuery($query, $params);
    }

    // Funzione per modificare lo stato di un ordine
    public function modificaStatoOrdine($idOrdine) {
        // Recupera lo stato attuale dell'ordine
        $queryGetStato = "
            SELECT Stato 
            FROM ORDINE 
            WHERE ID_Ordine = :idOrdine
        ";

        $paramsGetStato = [
            ':idOrdine' => $idOrdine
        ];

        $result = $this->executeQuery($queryGetStato, $paramsGetStato);

        $statoCorrente = (int)$result[0]['Stato'];

        // Determina il nuovo stato
        $nuovoStato = null;
        if ($statoCorrente === 0) {
            $nuovoStato = 1; // Da "confermato" a "spedito"
        } elseif ($statoCorrente === 1) {
            $nuovoStato = 2; // Da "spedito" a "consegnato"
        } else{
            return TRUE;
        }

        $queryUpdateStato = "
            UPDATE ORDINE 
            SET Stato = :nuovoStato
            WHERE ID_Ordine = :idOrdine
        ";

        $paramsUpdateStato = [
            ':nuovoStato' => $nuovoStato,
            ':idOrdine' => $idOrdine
        ];
        $this->executeQuery($queryUpdateStato, $paramsUpdateStato);
        return TRUE;
    }

    public function addEventWithTexts($dataInizio, $dataFine, $foto, $titoloIT, $sottotitoloIT, $descrizioneIT, $titoloEN, $sottotitoloEN, $descrizioneEN) {
        try {
            // Avvia la transazione
            $this->pdo->beginTransaction();

            $idEvento = 'E' . substr(uniqid(), 0, 8);
    
            // Inserisci l'evento nella tabella EVENTO
            $queryEvento = "
                INSERT INTO EVENTO (ID_Evento, Data_Inizio, Data_Fine, Foto)
                VALUES (:idEvento, :dataInizio, :dataFine, :foto)
            ";
            $paramsEvento = [
                ':idEvento' => $idEvento,
                ':dataInizio' => $dataInizio,
                ':dataFine' => $dataFine,
                ':foto' => $foto
            ];
            $this->executeQuery($queryEvento, $paramsEvento);
    
            // Genera ID_Testo per italiano e inglese
            $idTestoIT = 'TI' . substr(uniqid(), 0, 8);
            $idTestoEN = 'TE' . substr(uniqid(), 0, 8);
    
            // Inserisci il testo in italiano
            $queryTestoIT = "
                INSERT INTO TESTO_EVENTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Evento)
                VALUES (:idTesto, 1, :titolo, :sottotitolo, :descrizione, :idEvento)
            ";
            $paramsTestoIT = [
                ':idTesto' => $idTestoIT,
                ':titolo' => $titoloIT,
                ':sottotitolo' => $sottotitoloIT,
                ':descrizione' => $descrizioneIT,
                ':idEvento' => $idEvento
            ];
            $this->executeQuery($queryTestoIT, $paramsTestoIT);
    
            // Inserisci il testo in inglese
            $queryTestoEN = "
                INSERT INTO TESTO_EVENTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Evento)
                VALUES (:idTesto, 2, :titolo, :sottotitolo, :descrizione, :idEvento)
            ";
            $paramsTestoEN = [
                ':idTesto' => $idTestoEN,
                ':titolo' => $titoloEN,
                ':sottotitolo' => $sottotitoloEN,
                ':descrizione' => $descrizioneEN,
                ':idEvento' => $idEvento
            ];
            $this->executeQuery($queryTestoEN, $paramsTestoEN);
    
            // Conferma la transazione
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback in caso di errore
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getAllEvents() {
        $query = "
            SELECT 
                E.ID_Evento,
                E.Data_Inizio,
                E.Data_Fine,
                E.Foto,
                TI.Titolo AS Titolo_IT,
                TE.Titolo AS Titolo_EN
            FROM 
                EVENTO E
            LEFT JOIN 
                TESTO_EVENTO TI ON E.ID_Evento = TI.ID_Evento AND TI.Lingua = 1
            LEFT JOIN 
                TESTO_EVENTO TE ON E.ID_Evento = TE.ID_Evento AND TE.Lingua = 2
            ORDER BY 
                E.Data_Inizio DESC
        ";

        return $this->executeQuery($query);
    }
    public function getProductDetails($productId, $language = 1) {
        $query = "
        SELECT 
            p.ID_Prodotto AS id,
            tp.Titolo AS title,
            p.Prezzo AS price,
            p.Foto AS image
        FROM 
            PRODOTTO p
        JOIN 
            TESTO_PRODOTTO tp ON p.ID_Prodotto = tp.ID_Prodotto
        WHERE 
            p.ID_Prodotto = :productId
        AND 
            tp.Lingua = :language
        ";
    
        $params = [
            ':productId' => $productId,
            ':language' => $language
        ];
    
        $results = $this->executeQuery($query, $params); // Returns an array
        return $results[0] ?? false; // Return the first result or false
    }

    // funzione per aggiungere un utente alla newsletter
    public function addUtenteNewsletter($email){
        $query = "
        SELECT COUNT(ID_NOTIFICA) FROM Notifica WHERE Email = :email AND Visualizzato = 'N'
        ";

        $params = [
            ':email' => $email
        ];

        return $this->executeQuery($query, $params);
    }
    
    public function getTotalWineCount() {
        $query = "
            SELECT COUNT(*) AS total
            FROM PRODOTTO
        ";
    
        $result = $this->executeQuery($query);
    
        // Restituisce solo il numero totale
        return $result[0]['total'] ?? 0;
    }

    public function updateWineQuantity($id, $quantity) {
        $query = "
            UPDATE PRODOTTO
            SET Quantita_Magazzino = :quantity
            WHERE ID_Prodotto = :id
        ";
    
        $params = [
            ':id' => $id,
            ':quantity' => $quantity
        ];
    
        return $this->executeQuery($query, $params);
    }

    public function updateProduct(
        $idProdotto,
        $prezzo,
        $quantitaMagazzino,
        $foto,
        $titoloIT,
        $sottotitoloIT,
        $descrizioneIT,
        $titoloEN,
        $sottotitoloEN,
        $descrizioneEN
    ) {
        try {
            // Inizia la transazione
            $this->pdo->beginTransaction();
    
            // Aggiorna i dati del prodotto
            $queryProdotto = "
                UPDATE PRODOTTO
                SET Prezzo = :prezzo, Quantita_Magazzino = :quantitaMagazzino, Foto = :foto
                WHERE ID_Prodotto = :idProdotto
            ";
            $paramsProdotto = [
                ':prezzo' => $prezzo,
                ':quantitaMagazzino' => $quantitaMagazzino,
                ':foto' => $foto,
                ':idProdotto' => $idProdotto,
            ];
            $this->executeQuery($queryProdotto, $paramsProdotto);
    
            // Aggiorna il testo del prodotto in italiano
            $queryTestoIT = "
                UPDATE TESTO_PRODOTTO
                SET Titolo = :titoloIT, Sottotitolo = :sottotitoloIT, Descrizione = :descrizioneIT
                WHERE ID_Prodotto = :idProdotto AND Lingua = 1
            ";
            $paramsTestoIT = [
                ':titoloIT' => $titoloIT,
                ':sottotitoloIT' => $sottotitoloIT,
                ':descrizioneIT' => $descrizioneIT,
                ':idProdotto' => $idProdotto,
            ];
            $this->executeQuery($queryTestoIT, $paramsTestoIT);
    
            // Aggiorna il testo del prodotto in inglese
            $queryTestoEN = "
                UPDATE TESTO_PRODOTTO
                SET Titolo = :titoloEN, Sottotitolo = :sottotitoloEN, Descrizione = :descrizioneEN
                WHERE ID_Prodotto = :idProdotto AND Lingua = 2
            ";
            $paramsTestoEN = [
                ':titoloEN' => $titoloEN,
                ':sottotitoloEN' => $sottotitoloEN,
                ':descrizioneEN' => $descrizioneEN,
                ':idProdotto' => $idProdotto,
            ];
            $this->executeQuery($queryTestoEN, $paramsTestoEN);
    
            // Conferma la transazione
            $this->pdo->commit();
    
            return true;
        } catch (Exception $e) {
            // Rollback in caso di errore
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getWineAllDetails($idProdotto) {
        $query = "
            SELECT 
                P.ID_Prodotto,
                P.Prezzo,
                P.Quantita_Magazzino,
                P.Foto,
                TP1.Titolo AS Titolo_IT,
                TP1.Sottotitolo AS Sottotitolo_IT,
                TP1.Descrizione AS Descrizione_IT,
                TP2.Titolo AS Titolo_EN,
                TP2.Sottotitolo AS Sottotitolo_EN,
                TP2.Descrizione AS Descrizione_EN
            FROM PRODOTTO P
            LEFT JOIN TESTO_PRODOTTO TP1 ON P.ID_Prodotto = TP1.ID_Prodotto AND TP1.Lingua = 1
            LEFT JOIN TESTO_PRODOTTO TP2 ON P.ID_Prodotto = TP2.ID_Prodotto AND TP2.Lingua = 2
            WHERE P.ID_Prodotto = :idProdotto
        ";
        
        $params = [':idProdotto' => $idProdotto];
        $result = $this->executeQuery($query, $params);
    
        return $result[0] ?? null;
    }

    public function addWineWithAttributesAndTexts(
        $prezzo, 
        $quantitaMagazzino, 
        $foto, 
        $titoloIT, 
        $sottotitoloIT, 
        $descrizioneIT, 
        $titoloEN, 
        $sottotitoloEN, 
        $descrizioneEN, 
        $frizzantezza, 
        $tonalita, 
        $provenienza, 
        $dimensioneBottiglia
    ) {
        try {
            $this->pdo->beginTransaction();
    
            // Genera ID univoco per il prodotto
            $idProdotto = 'P' . substr(uniqid(), 0, 8);
    
            // Inserimento nella tabella PRODOTTO
            $queryProdotto = "
                INSERT INTO PRODOTTO (ID_Prodotto, Prezzo, Quantita_Magazzino, Foto)
                VALUES (:idProdotto, :prezzo, :quantitaMagazzino, :foto)
            ";
            $this->executeQuery($queryProdotto, [
                ':idProdotto' => $idProdotto,
                ':prezzo' => $prezzo,
                ':quantitaMagazzino' => $quantitaMagazzino,
                ':foto' => $foto
            ]);
    
            // Genera ID_Testo per italiano e inglese
            $idTestoIT = 'TI' . substr(uniqid(), 0, 8);
            $idTestoEN = 'TE' . substr(uniqid(), 0, 8);
    
            // Inserimento testo in Italiano
            $queryTestoIT = "
                INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto)
                VALUES (:idTesto, 1, :titolo, :sottotitolo, :descrizione, :idProdotto)
            ";
            $this->executeQuery($queryTestoIT, [
                ':idTesto' => $idTestoIT,
                ':titolo' => $titoloIT,
                ':sottotitolo' => $sottotitoloIT,
                ':descrizione' => $descrizioneIT,
                ':idProdotto' => $idProdotto
            ]);
    
            // Inserimento testo in Inglese
            $queryTestoEN = "
                INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto)
                VALUES (:idTesto, 2, :titolo, :sottotitolo, :descrizione, :idProdotto)
            ";
            $this->executeQuery($queryTestoEN, [
                ':idTesto' => $idTestoEN,
                ':titolo' => $titoloEN,
                ':sottotitolo' => $sottotitoloEN,
                ':descrizione' => $descrizioneEN,
                ':idProdotto' => $idProdotto
            ]);
    
            // Inserimento attributi collegati al prodotto
            $attributes = [
                $frizzantezza,
                $tonalita,
                $provenienza,
                $dimensioneBottiglia
            ];
    
            foreach ($attributes as $idAttributo) {
                $queryAttributo = "
                    INSERT INTO ATTRIBUTA (ID_Attributo, ID_Prodotto)
                    VALUES (:idAttributo, :idProdotto)
                ";
                $this->executeQuery($queryAttributo, [
                    ':idAttributo' => $idAttributo,
                    ':idProdotto' => $idProdotto
                ]);
            }
    
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
     
}
?>
