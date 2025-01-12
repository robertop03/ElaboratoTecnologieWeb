<?php

$db = new VinoDatabase();
$db->resetDB();

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

    // Esegui una query e restituisci il risultato
    private function executeQuery($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 1 - Estrarre tutti i vini con attributi e filtri opzionali
    public function getAllVini($lingua = 1, $pmin = 0, $pmax = 100000, $prov = '%', $friz = '%', $tona = '%', $dime = '%') {
        $query = "
        SELECT 
            PRODOTTO.ID_Prodotto, 
            Prezzo, 
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
            GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
            TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
            TESTO_PRODOTTO.Descrizione
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
        GROUP BY 
            PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
        HAVING 
            (Frizzantezza LIKE :friz)
            AND (Tonalita LIKE :tona)
            AND (Provenienza LIKE :prov)
            AND (Capacita_Bottiglia LIKE :dime)
            AND Prezzo BETWEEN :pmin AND :pmax
        ";

        // Parametri della query
        $params = [
            ':lingua' => $lingua,
            ':friz' => $friz,
            ':tona' => $tona,
            ':prov' => $prov,
            ':dime' => $dime,
            ':pmin' => $pmin,
            ':pmax' => $pmax
        ];

        return $this->executeQuery($query, $params);
    }

    // Funzione per eseguire il reset del database
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

    // Funzione privata per eseguire un file SQL
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
}
?>
