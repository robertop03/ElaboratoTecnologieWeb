<?php
require_once("bootstrapt.php");
require_once("template/checkAdmin.php");


$templateParams["titolo"] = "Dashboard Operatore";
$templateParams["nome"] = "orderdetail-template.php";
$templateParams["mainClasses"] = "content-wrapper";

require("template/base-operatore.php");

?>
