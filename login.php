<?php
require_once("bootstrapt.php");

// Controllo se l'utente sta facendo login
if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $db->checkLogin($_POST["email"], $_POST["password"]);
    if(count($login_result) == 0){
        // login fallito
        $templateParams["errorelogin"] = "Errore! Controllare email o password";
    }else{
        registerLoggedUser($login_result[0]);
        
        if(isset($_SESSION["email"]) && $db->checkIsAdmin($_SESSION["email"]) == 1){
            header("Location: dashboard.php");
            exit();
        }else{
            header("Location: utente.php");
            exit();
        }
    }
}

// Controllo se l'utente è loggato
if(isUserLoggedIn()){
    // utente loggato, lo riconduco alla pagina utente
    if(isset($_SESSION["email"]) && $db->checkIsAdmin($_SESSION["email"]) == 1){
        header("Location: dashboard.php");
        exit();
    }else{
        header("Location: utente.php");
        exit();
    }

}else{
    // utente non loggato
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "login-template.php";
    $templateParams["mainClasses"] = "flex-grow-1";
}



require("template/base.php");
?>