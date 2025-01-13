<?php
require_once("bootstrapt.php");

$templateParams["titolo"] = "Registrazione utente";
$templateParams["nome"] = "register-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm-password"]);

    // Controlli sulle password
    if ($password !== $confirmPassword) {
        $templateParams["errore"] = "Le password non coincidono.";
    } elseif (strlen($password) < 8) {
        $templateParams["errore"] = "La password deve essere di almeno 8 caratteri.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["errore"] = "L'email non è valida.";
    } else {
        // Registra l'utente nel database (senza password hashata per ora)
        $result = $db->registerUser($email, $password, "", ""); 
        if ($result) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $templateParams["errore"] = "Errore durante la registrazione. L'email potrebbe essere già in uso.";
        }
    }
}

require("template/base.php");
?>