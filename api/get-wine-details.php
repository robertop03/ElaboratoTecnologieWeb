<?php
header('Content-Type: application/json');
require_once '../db/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID prodotto mancante.']);
    exit;
}

$db = new VinoDatabase();
$vino = $db->getWineAllDetails($id);

if ($vino) {
    echo json_encode(['success' => true, 'vino' => $vino]);
} else {
    echo json_encode(['success' => false, 'message' => 'Prodotto non trovato.']);
}
