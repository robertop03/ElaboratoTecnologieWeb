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

// Funzione per ottenere il prossimo ID ordine
function getNextOrderId() {
    $file = "order.txt";

    // Controlla se il file esiste
    if (!file_exists($file)) {
        // Se non esiste, inizializza il file con il valore iniziale
        file_put_contents($file, "17");
    }

    // Leggi il valore attuale dal file
    $currentOrderNumber = intval(file_get_contents($file));

    // Incrementa il valore
    $nextOrderNumber = $currentOrderNumber + 1;

    // Scrivi il nuovo valore nel file
    file_put_contents($file, $nextOrderNumber);

    // Ritorna l'ID ordine completo
    return "O" . $currentOrderNumber;
}

   
  
?>