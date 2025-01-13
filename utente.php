<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "Profilo utente";
$templateParams["nome"] = "utente-template.php";
$templateParams["mainClasses"] = "";

require("template/base.php");
?>