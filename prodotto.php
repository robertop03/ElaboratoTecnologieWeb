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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "getStock" && isset($_POST["productId"])) {
        $productId = trim($_POST["productId"]);

        // Ottieni la quantità in magazzino dal database
        $stock = $db->getProductStock($productId);
        if ($stock !== null) {
            header("Content-Type: application/json");
            echo json_encode(["success" => true, "stock" => $stock]);
        } else {
            header("Content-Type: application/json");
            echo json_encode(["success" => false, "message" => "Prodotto non trovato."]);
        }
        exit();
    }
}

require("template/base.php");
?>
