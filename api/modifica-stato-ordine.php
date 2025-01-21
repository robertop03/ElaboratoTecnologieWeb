<?php

header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID ordine mancante.']);
        exit;
    }

    $idOrdine = $input['id'];
    require_once '../db/database.php';

    $db = new VinoDatabase();

    // Chiamata alla funzione per modificare lo stato dell'ordine
    $success = $db->modificaStatoOrdine($idOrdine);

    // Verifica il risultato
    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Stato ordine aggiornato.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Impossibile aggiornare lo stato.']);
    }
} catch (Exception $e) {
    // Restituisci un messaggio di errore JSON se si verifica un'eccezione
    echo json_encode(['success' => false, 'message' => 'Errore: ' . $e->getMessage()]);
}

?>


