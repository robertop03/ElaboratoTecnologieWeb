<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$notifiche = $db->getNotifiche($_SESSION["email"]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'data') {
            // RESTITUISCE IL JSON DELLE NOTIFICHE
            header('Content-Type: application/json');

            if (!isset($_SESSION["email"])) {
                echo json_encode(['error' => 'Utente non autenticato']);
                exit();
            }

            $notifiche = $db->getNotifiche($_SESSION["email"]);
            echo json_encode($notifiche);
            exit();
        } elseif ($_GET['action'] === 'update') {
            // SEGNA LA NOTIFICA COME LETTA
            header('Content-Type: application/json');

            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'ID della notifica non fornito']);
                exit();
            }

            $idNotifica = htmlspecialchars($_GET['id']);
            $db->setNotificaLetta($idNotifica);
            echo json_encode(['success' => true, 'id' => $idNotifica]);
            exit();
        } elseif ($_GET['action'] === 'count') {
            $nNotifications = $db->getNumeroNotificheNonLette($_SESSION["email"]);
            numberOfNotificationsUnread($nNotifications);
            echo json_encode(['count' => $nNotifications[0]["COUNT(ID_NOTIFICA)"]]);
            exit();
        }
    } 

    // VISUALIZZA IL TEMPLATE HTML
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }

    $templateParams["titolo"] = "Notifiche";
    $templateParams["nome"] = "notifiche-template.php";
    $templateParams["mainClasses"] = "flex-grow-1";

    require("template/base.php");
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metodo non consentito']);
    exit();
}
?>