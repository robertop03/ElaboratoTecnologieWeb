<?php
header('Content-Type: application/json');
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vinoId = $_POST['vinoId'] ?? null;
    $nuovaQuantita = $_POST['nuovaQuantita'] ?? null;

    if (!$vinoId || !is_numeric($nuovaQuantita)) {
        echo json_encode(['success' => false, 'message' => 'ID prodotto o quantità non validi.']);
        exit;
    }

    $db = new VinoDatabase();
    try {
        $db->updateWineQuantity($vinoId, (int)$nuovaQuantita);
        header('Location: ../winemanager.php');
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Richiesta non valida.']);
}
