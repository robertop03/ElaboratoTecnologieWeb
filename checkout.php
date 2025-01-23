<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Ottenere indirizzi e metodi di pagamento
$templateParams["addresses"] = $db->getUserAddresses($_SESSION["email"]);
$templateParams["paymentMethods"] = $db->getUserPaymentMethods($_SESSION["email"]);

// Imposta i parametri per il template
$templateParams["titolo"] = "Checkout";
$templateParams["nome"] = "checkout-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

// Debug opzionale per verificare
// echo '<pre>', print_r($templateParams, true), '</pre>';

require("template/base.php");
?>
