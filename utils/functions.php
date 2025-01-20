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

function actualProduct($id){
    $_SESSION["id"] = $id;
}

function numberOfPrefs($nPrefs){
    $_SESSION["nPrefs"] = $nPrefs;
}

function deleteCookie($name) {
    // Imposta il cookie con una data di scadenza passata
    setcookie($name, '', time() - 3600, '/');
}
   
  
?>