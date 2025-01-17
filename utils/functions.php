<?php

function isUserLoggedIn(){
    return !empty($_SESSION["email"]);
}

function registerLoggedUser($user){
    $_SESSION["email"] = $user["Email"];
}

function nameAndSurname($nome, $cognome){
    $_SESSION["nome"] = $nome;
    $_SESSION["cognome"] = $cognome;
}

?>