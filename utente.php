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
        } elseif ($_POST['submit_form'] === 'addAddress') {
            // Aggiungi o modifica un indirizzo
            $via = trim($_POST["address"]);
            $numeroCivico = trim($_POST["numeroCivico"]);
            $cap = trim($_POST["cap"]);
            $citta = trim($_POST["city"]);
            $paese = trim($_POST["country"]);
            $id = isset($_POST["id"]) && !empty($_POST["id"]) ? trim($_POST["id"]) : null;

            if ($id) {
                // Modifica un indirizzo esistente
                $success = $db->updateUserAddress($id, $via, $numeroCivico, $cap, $citta, $paese);
            } else {
                // Aggiungi un nuovo indirizzo
                $success = $db->addUserAddress($email, $via, $numeroCivico, $cap, $citta, $paese);
            }

            // Risposta JSON per AJAX
            header("Location: utente.php");
            exit();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'getOrderDetails') {
        // Ottenere i dettagli di un ordine
        $orderId = isset($_POST['orderId']) ? trim($_POST['orderId']) : null;
        if ($orderId) {
            error_log("Richiesta dettagli per l'ordine ID: " . $orderId);
            $orderDetails = $db->getOrderDetails($orderId);
            if ($orderDetails) {
                header("Content-Type: application/json");
                echo json_encode(["success" => true, "details" => $orderDetails]);
            } else {
                header("Content-Type: application/json");
                echo json_encode(["success" => false, "message" => "Dettagli dell'ordine non trovati."]);
            }
        } else {
            error_log("Ramo else, ordine id non preso");
            header("Content-Type: application/json");
            echo json_encode(["success" => false, "message" => "ID ordine non specificato."]);
        }
        exit();
    }
}

// Carica dati utente, indirizzi, metodi di pagamento e ordini
$templateParams["addresses"] = $db->getUserAddresses($email);
$templateParams["paymentMethods"] = $db->getUserPaymentMethods($email);

$orders = $db->getUserOrders($email);
$templateParams["orders"] = $orders;
$templateParams["orderCount"] = $db->countUserOrders($email); // Usa la funzione count

$nPrefs = $db->getNumberPrefs($email);
numberOfPrefs($nPrefs[0]["numero_occorrenze"]);

$prefs = $db->getViniPreferiti($lingua, $email);

$templateParams["titolo"] = "Profilo utente";
$templateParams["nome"] = "utente-template.php";
$templateParams["mainClasses"] = "";

require("template/base.php");
?>