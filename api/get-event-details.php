<?php
header('Content-Type: application/json');
require_once '../db/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID evento mancante.']);
    exit;
}

$idEvento = $_GET['id'];

try {
    $db = new VinoDatabase();

    $evento = $db->getEventAllDetails($idEvento);

    if (!$evento) {
        echo json_encode(['success' => false, 'message' => 'Evento non trovato.']);
        exit;
    }

    echo json_encode(['success' => true, 'evento' => $evento]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Errore: ' . $e->getMessage()]);
}
