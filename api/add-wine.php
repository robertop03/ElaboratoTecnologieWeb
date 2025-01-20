<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new VinoDatabase();

    $prezzo = $_POST['prezzo'];
    $quantitaMagazzino = $_POST['quantitaMagazzino'];
    $foto = $_POST['foto'];
    $titoloIT = $_POST['titoloIT'];
    $sottotitoloIT = $_POST['sottotitoloIT'];
    $descrizioneIT = $_POST['descrizioneIT'];
    $titoloEN = $_POST['titoloEN'];
    $sottotitoloEN = $_POST['sottotitoloEN'];
    $descrizioneEN = $_POST['descrizioneEN'];
    $frizzantezza = $_POST['frizzantezza'];
    $tonalita = $_POST['tonalita'];
    $provenienza = $_POST['provenienza'];
    $dimensioneBottiglia = $_POST['dimensioneBottiglia'];

    try {
        $success = $db->addWineWithAttributesAndTexts(
            $prezzo,
            $quantitaMagazzino,
            $foto,
            $titoloIT,
            $sottotitoloIT,
            $descrizioneIT,
            $titoloEN,
            $sottotitoloEN,
            $descrizioneEN,
            $frizzantezza,
            $tonalita,
            $provenienza,
            $dimensioneBottiglia
        );

        if ($success) {
            header('Location: ../wineManager.php?success=1');
        } else {
            echo "Errore durante l'inserimento del vino.";
        }
    } catch (Exception $e) {
        echo "Errore: " . $e->getMessage();
    }
} else {
    header('Location: ../wineManager.php');
}
