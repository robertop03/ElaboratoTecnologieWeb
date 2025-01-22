<?php
require_once("bootstrapt.php");

$templateParams["titolo"] = "Prodotto";
$templateParams["nome"] = "prodotto-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION["id"];

actualProduct($id);

if ($linguaAttuale === "it") {
    $vino = $db->getVinoById(1, $id);
} else {
    $vino = $db->getVinoById(2, $id);
}

// Verifica disponibilità in magazzino
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "checkAvailability") {
    $productId = $_POST["productId"];
    $requestedQuantity = (int)$_POST["quantity"];
    
    // Ottieni la quantità disponibile dal database
    $availableQuantity = $db->getProductStock($productId);

    header("Content-Type: application/json");
    echo json_encode([
        "isAvailable" => $requestedQuantity <= $availableQuantity,
    ]);
    exit();
}

require("template/base.php");
?>
