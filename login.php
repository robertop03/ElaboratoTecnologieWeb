<?php
require_once("bootstrapt.php");

// Controllo se l'utente sta facendo login
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $db->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result) == 0){
        // login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password";
    }
}

$templateParams["titolo"] = "Login";
$templateParams["nome"] = "login-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

require("template/base.php");
?>