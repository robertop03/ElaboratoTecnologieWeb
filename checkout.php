<?php
require_once("bootstrapt.php");

$province = [
    "AG" => "Agrigento", "AL" => "Alessandria", "AN" => "Ancona", "AO" => "Aosta",
    "AR" => "Arezzo", "AP" => "Ascoli Piceno", "AT" => "Asti", "AV" => "Avellino",
    "BA" => "Bari", "BT" => "Barletta-Andria-Trani", "BL" => "Belluno", "BN" => "Benevento",
    "BG" => "Bergamo", "BI" => "Biella", "BO" => "Bologna", "BZ" => "Bolzano",
    "BS" => "Brescia", "BR" => "Brindisi", "CA" => "Cagliari", "CL" => "Caltanissetta",
    "CB" => "Campobasso", "CI" => "Carbonia-Iglesias", "CE" => "Caserta", "CT" => "Catania",
    "CZ" => "Catanzaro", "CH" => "Chieti", "CO" => "Como", "CS" => "Cosenza",
    "CR" => "Cremona", "KR" => "Crotone", "CN" => "Cuneo", "EN" => "Enna",
    "FM" => "Fermo", "FE" => "Ferrara", "FI" => "Firenze", "FG" => "Foggia",
    "FC" => "Forlì-Cesena", "FR" => "Frosinone", "GE" => "Genova", "GO" => "Gorizia",
    "GR" => "Grosseto", "IM" => "Imperia", "IS" => "Isernia", "AQ" => "L'Aquila",
    "SP" => "La Spezia", "LT" => "Latina", "LE" => "Lecce", "LC" => "Lecco",
    "LI" => "Livorno", "LO" => "Lodi", "LU" => "Lucca", "MC" => "Macerata",
    "MN" => "Mantova", "MS" => "Massa-Carrara", "MT" => "Matera", "ME" => "Messina",
    "MI" => "Milano", "MO" => "Modena", "MB" => "Monza e della Brianza", "NA" => "Napoli",
    "NO" => "Novara", "NU" => "Nuoro", "OT" => "Olbia-Tempio", "OR" => "Oristano",
    "PD" => "Padova", "PA" => "Palermo", "PR" => "Parma", "PV" => "Pavia",
    "PG" => "Perugia", "PU" => "Pesaro e Urbino", "PE" => "Pescara", "PC" => "Piacenza",
    "PI" => "Pisa", "PT" => "Pistoia", "PN" => "Pordenone", "PZ" => "Potenza",
    "PO" => "Prato", "RG" => "Ragusa", "RA" => "Ravenna", "RC" => "Reggio Calabria",
    "RE" => "Reggio Emilia", "RI" => "Rieti", "RN" => "Rimini", "RM" => "Roma",
    "RO" => "Rovigo", "SA" => "Salerno", "SS" => "Sassari", "SV" => "Savona",
    "SI" => "Siena", "SR" => "Siracusa", "SO" => "Sondrio", "SU" => "Sud Sardegna",
    "TA" => "Taranto", "TE" => "Teramo", "TR" => "Terni", "TO" => "Torino",
    "TP" => "Trapani", "TN" => "Trento", "TV" => "Treviso", "TS" => "Trieste",
    "UD" => "Udine", "VA" => "Varese", "VE" => "Venezia", "VB" => "Verbano-Cusio-Ossola",
    "VC" => "Vercelli", "VR" => "Verona", "VV" => "Vibo Valentia", "VI" => "Vicenza",
    "VT" => "Viterbo"
];

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Gestione delle richieste AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data["action"] === "getAddressById" && isset($data["id"])) {
        $id = intval($data["id"]);
        $address = getAddressById($id);
        header("Content-Type: application/json");
        echo json_encode($address);
        exit();
    }

    if ($data["action"] === "getCardById" && isset($data["id"])) {
        $id = intval($data["id"]);
        $card = getCardById($id);
        header("Content-Type: application/json");
        echo json_encode($card);
        exit();
    }
}

// Ottenere indirizzi e metodi di pagamento
$templateParams["addresses"] = $db->getUserAddresses($_SESSION["email"]);
$templateParams["paymentMethods"] = $db->getUserPaymentMethods($_SESSION["email"]);
$templateParams["province"] = $province;

// Imposta i parametri per il template
$templateParams["titolo"] = "Checkout";
$templateParams["nome"] = "checkout-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

require("template/base.php");
?>
