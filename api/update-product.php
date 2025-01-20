<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new VinoDatabase();

    $idProdotto = $_POST['vinoId'];
    $prezzo = $_POST['prezzo'];
    $quantitaMagazzino = $_POST['quantitaMagazzino'];
    $foto = $_POST['foto'];
    $titoloIT = $_POST['titoloIT'];
    $sottotitoloIT = $_POST['sottotitoloIT'];
    $descrizioneIT = $_POST['descrizioneIT'];
    $titoloEN = $_POST['titoloEN'];
    $sottotitoloEN = $_POST['sottotitoloEN'];
    $descrizioneEN = $_POST['descrizioneEN'];

    try {
        $db->updateProduct($idProdotto, $prezzo, $quantitaMagazzino, $foto, $titoloIT, $sottotitoloIT, $descrizioneIT, $titoloEN, $sottotitoloEN, $descrizioneEN);
        header('Location: ../wineManager.php');
    } catch (Exception $e) {
        echo "Errore: " . $e->getMessage();
    }
}
