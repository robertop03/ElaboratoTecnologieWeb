<?php

$db = new VinoDatabase();

print $db->getAllVini();

class VinoDatabase {
    private $pdo;

    // Costruttore per la connessione al database
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost","dbname=vino", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Esegui una query e restituisci il risultato
    private function executeQuery($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 1 - Estrarre tutti i vini con attributi
    public function getAllVini($lingua = 1) {
        $query = "
        SELECT 
            PRODOTTO.ID_Prodotto, 
            Prezzo, 
            GROUP_CONCAT(CASE ATTRIBUTO.Titolo 
                WHEN 'Frizzantezza' THEN ATTRIBUTO.Valore END) AS Frizzantezza,
            GROUP_CONCAT(CASE ATTRIBUTO.Titolo 
                WHEN 'Tonalità' THEN ATTRIBUTO.Valore END) AS Tonalita,
            GROUP_CONCAT(CASE ATTRIBUTO.Titolo 
                WHEN 'Provenienza' THEN ATTRIBUTO.Valore END) AS Provenienza,
            GROUP_CONCAT(CASE ATTRIBUTO.Titolo 
                WHEN 'Capacità Bottiglia' THEN ATTRIBUTO.Valore END) AS Capacita_Bottiglia,
            TESTO_PRODOTTO.Titolo, 
            TESTO_PRODOTTO.Descrizione
        FROM 
            PRODOTTO
        JOIN 
            TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
        LEFT JOIN 
            ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
        LEFT JOIN 
            ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
        WHERE 
            TESTO_PRODOTTO.Lingua = :lingua
        GROUP BY 
            PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione
        ";
        return $this->executeQuery($query, ['lingua' => $lingua]);
    }
}
?>