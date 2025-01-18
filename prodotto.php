<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "Prodotto";
$templateParams["nome"] = "prodotto-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION["id"];

actualProduct($id);
if($linguaAttuale === "it"){
    $vino = $db->getVinoById(1, $id);
}else{
    $vino = $db->getVinoById(2, $id);
}
require("template/base.php");
?>