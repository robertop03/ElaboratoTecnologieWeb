<?php
require_once '../db/database.php';

$idProdotto = $_POST['idProdotto'];

try {
    $db = new VinoDatabase(); 
    $db->toggleHidden($idProdotto); 
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} catch (Exception $e) {
    die('Errore: ' . $e->getMessage());
}
?>