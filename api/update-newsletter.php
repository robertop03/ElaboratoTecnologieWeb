<?php
require_once '../bootstrapt.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? null;
    $stato = $input['action'] ?? null;

    $response = [];

    if (isset($_SESSION["email"])) {
        if ($email === $_SESSION["email"]) {
            try {
                $db->setNewsletter($email, $stato);
                if ($stato === "Y") {
                    $response['message'] = "Ti sei iscritto con successo alla newsletter.";
                } else {
                    $response['message'] = "Sei stato disiscritto dalla newsletter.";
                }
            } catch (Exception $e) {
                $response['message'] = "Errore durante l'aggiornamento: " . $e->getMessage();
            }
        } else {
            $response['message'] = "L'email non corrisponde all'utente loggato.";
        }
    } else {
        $response['message'] = "Devi essere loggato per modificare la tua iscrizione.";
    }

    echo json_encode($response);
} else {
    echo json_encode(['message' => 'Metodo non valido. Usa POST.']);
}