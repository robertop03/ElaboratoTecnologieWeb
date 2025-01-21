<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new VinoDatabase();

    $idEvento = $_POST['eventoId'];
    $dataInizio = $_POST['dataInizio'];
    $dataFine = $_POST['dataFine'];
    $foto = $_POST['foto'];

    $titoloIT = $_POST['titoloIT'];
    $sottotitoloIT = $_POST['sottotitoloIT'];
    $descrizioneIT = $_POST['descrizioneIT'];

    $titoloEN = $_POST['titoloEN'];
    $sottotitoloEN = $_POST['sottotitoloEN'];
    $descrizioneEN = $_POST['descrizioneEN'];

    try {
        $db->updateEvent($idEvento, $dataInizio, $dataFine, $foto, $titoloIT, $sottotitoloIT, $descrizioneIT, $titoloEN, $sottotitoloEN, $descrizioneEN);
        header('Location: ../eventManager.php');
    } catch (Exception $e) {
        echo "Errore: " . $e->getMessage();
    }
} else {
    header('Location: ../eventManager.php');
}
