<?php
require_once("bootstrapt.php");

// Determina la lingua (1 = Italiano, 2 = Inglese)
$lingua = ($linguaAttuale === "en") ? 2 : 1;

// Recupera i 3 prodotti più venduti in base alla lingua
$topSellingProducts = $db->getTopSellingProducts($lingua);

// Recupera i 2 eventi in arrivo in base alla lingua
$events = $db->getEvents($lingua);

// Passa i dati al template
$templateParams["titolo"] = "Home - ". htmlspecialchars("<vino>");
$templateParams["nome"] = "index-template.php";
$templateParams["mainClasses"] = "content-wrapper";
$templateParams["topSellingProducts"] = $topSellingProducts;
$templateParams["events"] = $events;

require("template/base.php");
?>