<?php
require_once("../db_connection.php"); // Connessione al database

header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Verifica del metodo della richiesta
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Metodo non consentito
    echo json_encode(["error" => "Metodo non consentito"]);
    exit();
}

// Recupera i dati inviati dal client
$input = json_decode(file_get_contents("php://input"), true);

// Controlla se "ids" è presente e non vuoto
if (!isset($input['ids']) || !is_array($input['ids']) || count($input['ids']) === 0) {
    http_response_code(400); // Richiesta errata
    echo json_encode(["error" => "Lista di ID prodotti non valida"]);
    exit();
}

// Prepara la query per recuperare i dettagli dei prodotti
$placeholders = implode(",", array_fill(0, count($input['ids']), "?"));
$query = "SELECT p.ID_Prodotto, p.Prezzo, p.Foto, t.Titolo
          FROM PRODOTTO p
          JOIN TESTO_PRODOTTO t ON p.ID_Prodotto = t.ID_Prodotto
          WHERE t.Lingua = :lingua AND p.ID_Prodotto IN ($placeholders)";

$stmt = $db->prepare($query);

// Aggiungi gli ID prodotti come parametri della query
$params = array_merge([':lingua' => $_SESSION['lingua']], $input['ids']);
$stmt->execute($params);

// Recupera i risultati
$prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ritorna i dati come JSON
echo json_encode($prodotti);
?>