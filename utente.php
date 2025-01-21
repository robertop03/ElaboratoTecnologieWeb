<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$lingua = ($linguaAttuale === "en") ? 2 : 1;
$email = $_SESSION["email"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit_form'])) {
        if ($_POST['submit_form'] === 'addPaymentMethod') {
            // Aggiungi un nuovo metodo di pagamento
            $numeroCarta = trim($_POST["numeroCarta"]);
            $meseScadenza = trim($_POST["meseScadenza"]);
            $annoScadenza = trim($_POST["annoScadenza"]);

            $db->addUserPaymentMethod($email, $numeroCarta, $meseScadenza, $annoScadenza);

            // Ricarica la pagina per aggiornare la lista dei metodi di pagamento
            header("Location: utente.php");
            exit();
        }
    }
}

// Carica dati utente, indirizzi e metodi di pagamento
$templateParams["addresses"] = $db->getUserAddresses($email);
$templateParams["paymentMethods"] = $db->getUserPaymentMethods($email);

$nPrefs = $db->getNumberPrefs($email);
numberOfPrefs($nPrefs[0]["numero_occorrenze"]);

$prefs = $db->getViniPreferiti($lingua, $email);

$templateParams["titolo"] = "Profilo utente";
$templateParams["nome"] = "utente-template.php";
$templateParams["mainClasses"] = "";

require("template/base.php");
?>
