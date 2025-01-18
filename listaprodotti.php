<?php
require_once("bootstrapt.php");

/*************************************************
 * Legge i filtri di GET per:
 *  - pmin, pmax
 *  - prov (Provenienza)
 *  - friz (Frizzantezza)
 *  - tona (Tonalità)
 *  - dime (Capacita_Bottiglia)
 *  - sort (ascPrice, descPrice, ascFormato, descFormato)
 * e mostra i vini usando il template fornito.
 *************************************************/

// 1. Lettura dei parametri GET con fallback ai default
$pmin  = isset($_GET['pmin'])  ? (float) $_GET['pmin']  : 0; // Prezzo minimo
$pmax  = isset($_GET['pmax'])  ? (float) $_GET['pmax']  : 10000; // Prezzo massimo
$prov  = isset($_GET['prov'])  ? $_GET['prov']         : '%'; // Provenienza
$friz  = isset($_GET['friz'])  ? $_GET['friz']         : '%'; // Frizzantezza
$tona  = isset($_GET['tona'])  ? $_GET['tona']         : '%'; // Tonalità
$dime  = isset($_GET['dime'])  ? $_GET['dime']         : '%'; // Capacità bottiglia
$sort  = isset($_GET['sort'])  ? $_GET['sort']         : ''; // Ordinamento

// 1 = italiano, 2 = inglese
$lingua = ($linguaAttuale === "en") ? 2 : 1;

switch ($sort) {
  case 'ascPrice':
    $ordine = "price_asc";           
    break;
  case 'descPrice':
    $ordine = "price_desc";
    break;
  case 'ascFormato':
    $ordine = "cap_asc";
    break;
  case 'descFormato':
    $ordine = "cap_desc";
    break;
  default:
    $ordine = ""; // Nessun ordinamento
    break;
}

if(isset($_GET['prefs'])){
    $wines = $db->getViniPreferiti($linguaAttuale === "it" ? 1 : 2, $_SESSION["email"]);
    $nPrefs = $db->getNumberPrefs($_SESSION["email"]);
    numberOfPrefs($nPrefs[0]["numero_occorrenze"]);
}else{
    $wines = $db->getAllVini($lingua, $pmin, $pmax, $prov, $friz, $tona, $dime, $ordine );
}

$templateParams["titolo"] = "Lista prodotti";
$templateParams["nome"] = "listaprodotti-template.php";
$templateParams["mainClasses"] = "container";

require("template/base.php");
?>