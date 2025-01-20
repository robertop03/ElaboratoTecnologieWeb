<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new VinoDatabase();

    $dataInizio = $_POST['dataInizio'];
    $dataFine = $_POST['dataFine'];
    $foto = $_POST['foto'];
    $titoloIT = $_POST['titoloIT'];
    $sottotitoloIT = $_POST['sottotitoloIT'];
    $descrizioneIT = $_POST['descrizioneIT'];
    $titoloEN = $_POST['titoloEN'];
    $sottotitoloEN = $_POST['sottotitoloEN'];
    $descrizioneEN = $_POST['descrizioneEN'];



    $success = $db->addEventWithTexts($dataInizio, $dataFine, $foto, $titoloIT, $sottotitoloIT, $descrizioneIT, $titoloEN, $sottotitoloEN, $descrizioneEN);

    if ($success) {
        header('Location: ../eventManager.php');
    } else {
        echo "Errore durante l'inserimento dell'evento.";
    }

} else {
    header('Location: ../eventManager.php');
}

?>