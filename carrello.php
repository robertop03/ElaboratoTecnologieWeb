<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Ottieni il carrello dai cookie
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Recupera i dettagli dei prodotti dal database
$completeCart = [];

foreach ($cart as $item) {
    $productDetails = $db->getProductDetails($item['id'], $_SESSION['lingua'] ?? 1);

    if ($productDetails) {
        // Poiché getProductDetails restituisce già un array, non devi avvolgerlo in un altro array
        $completeCart[] = [
            'id' => $productDetails['id'],
            'title' => $productDetails['title'],
            'price' => $productDetails['price'],
            'image' => $productDetails['image'],
            'quantity' => $item['quantity']
        ];
    }
}

// Passa i dettagli completi al file JavaScript
echo "<script>const completeCart = " . json_encode($completeCart) . ";</script>";

// Imposta i parametri per il template
$templateParams["titolo"] = "Carrello";
$templateParams["nome"] = "carrello-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

// Include il template base
require("template/base.php");
?>
