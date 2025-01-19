<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$notifiche = $db->getNotifiche($_SESSION["email"]);

$templateParams["titolo"] = "Notifiche";
$templateParams["nome"] = "notifiche-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

require("template/base.php");
?>