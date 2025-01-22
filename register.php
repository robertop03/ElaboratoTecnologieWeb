<?php
require_once("bootstrapt.php");
date_default_timezone_set('Europe/Rome');

$templateParams["titolo"] = "Registrazione utente";
$templateParams["nome"] = "register-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm-password"]);

    // Controllo che le password coincidano
    if ($password !== $confirmPassword) {
        $templateParams["errore"] = "Le password non coincidono.";
    } elseif (strlen($password) < 8) {
        $templateParams["errore"] = "La password deve essere di almeno 8 caratteri.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["errore"] = "L'email non è valida.";
    } else {
        $existingUser = $db->checkExistsUser($email);

        if (!empty($existingUser) && isset($existingUser[0]['total']) && $existingUser[0]['total'] > 0) {
            $templateParams["errore"] = "L'email è già registrata. Effettua il login.";
        } else {
            $result = $db->registerUser($email, $password, "", "");
            $userCheck = $db->checkExistsUser($email);
            $createNotification = $db->addNotifica($email, "Creazione account", "Benvenuto, " . $email
             . " Grazie per esserti registrato al nostro servizio!",
            "Account creation", "Welcome, " . $email . " Thank you for signing up for our service!");
            if (!empty($userCheck) && isset($userCheck[0]['total']) && $userCheck[0]['total'] > 0) {
                header("Location: login.php?success=1");
                exit();
            } else {
                $templateParams["errore"] = "Errore durante la registrazione. Riprova più tardi.";
            }
        }
    }
}

require("template/base.php");
?>