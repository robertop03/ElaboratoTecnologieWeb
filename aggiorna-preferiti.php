<?php
require_once("bootstrapt.php");
if (!isset($_SESSION["email"])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['wineId']) || !isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit();
}
$wineId = $data['wineId'];
$action = $data['action'];
$email = $_SESSION['email'];

if($action === "add"){
    $db->addVinoToPreferiti($email, $wineId);
    echo json_encode(['success' => true, 'message' => 'Wine added to favorites']);
}else if($action === "remove"){
    $db->removeVinoFromPreferiti($email, $wineId);
    echo json_encode(['success' => true, 'message' => 'Wine removed from favorites']);
}

?>