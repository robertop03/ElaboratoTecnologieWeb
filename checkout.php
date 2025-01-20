<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "Checkout";
$templateParams["nome"] = "checkout-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

require("template/base.php");
?>