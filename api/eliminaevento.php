<?php
header('Content-Type: application/json');
require_once '../db/database.php';

$input = json_decode(file_get_contents('php://input'), true);
$db = new VinoDatabase();

$idEvento = $input['idEvento'];


$success = $db->deleteEventById($idEvento);
echo json_encode(['success' => $success]);
