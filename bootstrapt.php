<?php
session_start();
require_once("db/database.php");
require_once("utils/functions.php");

$db = new VinoDatabase();

if (isset($_GET['lang'])) {
    $linguaAttuale = $_GET['lang'];
    setcookie("lingua", $linguaAttuale, time() + (30 * 24 * 60 * 60), "/"); // 30 giorni
} elseif (isset($_COOKIE['lingua'])) {
    $linguaAttuale = $_COOKIE['lingua']; // utilizza la lingua salvata nel cookie
} else {
    $linguaAttuale = "it"; // usiamo come lingua predefinita l'italiano
}

?>