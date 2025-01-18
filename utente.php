<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_SESSION["email"];
    if (isset($_POST['submit_form']) && $_POST['submit_form'] === 'formDati'){
        // Ottieni i valori dal modulo
        $nome = trim($_POST["nome"]);
        $cognome = trim($_POST["cognome"]);

        $result = $db->updateNameAndSurname($nome, $cognome, $email);
        $nameAndSurname = $db->getNameAndSurname($email);
        nameAndSurname($nameAndSurname[0]["nome"], $nameAndSurname[0]["cognome"]);

    }elseif (isset($_POST['submit_form']) && $_POST['submit_form'] === 'formPw'){
        $pwAttuale = trim($_POST["current-password"]);
        $pwNuova = trim($_POST["new-password"]);
        $pwNuovaConferma = trim($_POST["confirm-password"]);

        $result = $db->getHashPassword($email);
        $hashDb = $result[0]["password"];
        if($pwNuova === $pwNuovaConferma){
            if (password_verify($pwAttuale, $hashDb)){
                $templateParams["risultatoCambioPw"] = "Password modificata correttamente.";
                $resultChangePw = $db->updatePassword($email, $pwNuova);
            }else{
                $templateParams["risultatoCambioPw"] = "Errore! Password errata.";
            }
        }else{
            $templateParams["risultatoCambioPw"] = "Errore! Le due password sono diverse.";
        }
        
    }
}

$nPrefs = $db->getNumberPrefs($_SESSION["email"]);
numberOfPrefs($nPrefs[0]["numero_occorrenze"]);

$templateParams["titolo"] = "Profilo utente";
$templateParams["nome"] = "utente-template.php";
$templateParams["mainClasses"] = "";

require("template/base.php");
?>