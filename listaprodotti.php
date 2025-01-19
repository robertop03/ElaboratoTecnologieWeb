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

if (isset($_GET['q'])) {
    $query = strtolower(htmlspecialchars($_GET['q']));
    $getCompose = [];

    // Mappa di parole chiave con i parametri GET
    $mapping = [
        'prov' => ['abruzzo', 'basilicata', 'calabria', 'campania', 'emilia romagna', 'friuli venezia giulia', 'lazio', 'liguria', 'lombardia', 'marche', 'molise', 'piemonte', 'puglia',
         'sardegna', 'sicilia', 'toscana', 'trentino alto adige', 'umbria', 'valle d\'aosta', 'veneto'],
        'tona' => [
            'rosso' => 'rosso',
            'rossi' => 'rosso',
            'bianco' => 'bianco',
            'bianchi' => 'bianco',
            'rosati' => 'rosè',
            'rosato' => 'rosè',
            'rosè' => 'rosè'
        ],
        'friz' => [
            'fermo' => 'fermo',
            'fermi' => 'fermo',
            'frizzante' => 'frizzante',
            'frizzanti' => 'frizzante'
        ],
        'dime' => [
            '0,375l' => 'Mezza 0.375l',
            '0,375' => 'Mezza 0.375l',
            '0,75l' => 'Bottiglia 0.75l',
            '0,75' => 'Bottiglia 0.75l',
            '1,5l' => 'Magnum 1.5l',
            '1,5' => 'Magnum 1.5l'
        ]
    ];

    // Controllo parole chiave
    foreach ($mapping as $param => $keywords) {
        foreach ($keywords as $keyword => $value) {
            if (is_numeric($keyword)) { // Per liste semplici (es. regioni)
                if (strpos($query, $value) !== false) {
                    $getCompose[$param] = $value;
                    break;
                }
            } else { // Per mappe complesse (es. tono, dimensioni)
                if (strpos($query, $keyword) !== false) {
                    $getCompose[$param] = $value;
                    break;
                }
            }
        }
    }
    $queryString = http_build_query($getCompose);
    header("Location: listaprodotti.php?$queryString");
}


if(isset($_GET['prefs'])){
    if(isset($_SESSION["email"])){
        $wines = $db->getViniPreferiti($lingua, $_SESSION["email"]);
        $nPrefs = $db->getNumberPrefs($_SESSION["email"]);
        numberOfPrefs($nPrefs[0]["numero_occorrenze"]);
    }
}else{
    $wines = $db->getAllVini($lingua, $pmin, $pmax, $prov, $friz, $tona, $dime, $ordine );
}

$templateParams["titolo"] = "Lista prodotti";
$templateParams["nome"] = "listaprodotti-template.php";
$templateParams["mainClasses"] = "container";

require("template/base.php");
?>