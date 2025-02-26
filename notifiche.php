<?php
require_once("bootstrapt.php");
date_default_timezone_set('Europe/Rome');

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
$lingua = ($linguaAttuale === "en") ? 2 : 1;

$notifiche = $db->getNotifiche($lingua, $_SESSION["email"]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'update') {
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
            header('Content-Type: application/json');
            $nNotifications = $db->getNumeroNotificheNonLette($_SESSION["email"]);
            echo json_encode(['count' => $nNotifications[0]["COUNT(ID_NOTIFICA)"]]);
            exit();
        } elseif ($_GET['action'] === 'delete'){
            header('Content-Type: application/json');
    
            // Controllo sessione
            if (!isset($_SESSION["email"])) {
                echo json_encode(['success' => false, 'error' => 'Utente non autenticato']);
                exit();
            }
            // Controllo ID notifica
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'ID della notifica non fornito']);
                exit();
            }
            $idNotifica = htmlspecialchars($_GET['id']);
            $db->deleteNotifica($idNotifica);
            echo json_encode(['success' => true, 'message' => 'Notifica eliminata']);
            exit();
        }
    }

    // VISUALIZZA IL TEMPLATE HTML
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }

   
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metodo non consentito']);
    exit();
}

$templateParams["titolo"] = "Notifiche";
$templateParams["nome"] = "notifiche-template.php";
$templateParams["mainClasses"] = "flex-grow-1";
if (!(isset($_SESSION["email"]) && $db->checkIsAdmin($_SESSION["email"]) == 1)) {
    require("template/base.php");
}else{
    require("template/base-operatore.php");
    echo '<script src="js/script.js?v=1"></script>';
}
?>