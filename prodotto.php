<?php
require_once("bootstrapt.php");

$templateParams["titolo"] = "Prodotto";
$templateParams["nome"] = "prodotto-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

$id = isset($_GET['id']) ? $_GET['id'] : null;
if($linguaAttuale === "it"){
    $vino = $db->getVinoById(1, $id);
}else{
    $vino = $db->getVinoById(2, $id);
}



require("template/base.php");
?>