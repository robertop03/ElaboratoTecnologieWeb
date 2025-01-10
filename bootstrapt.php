<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "vino", 3306);
$lingua_predefinita = "it";


if (isset($_GET['lang'])) {
    $linguaAttuale = $_GET['lang'];
    setcookie("lingua", $linguaAttuale, time() + (30 * 24 * 60 * 60), "/"); // 30 giorni
} elseif (isset($_COOKIE['lingua'])) {
    $linguaAttuale = $_COOKIE['lingua']; // Usa la lingua salvata nel cookie
} else {
    $linguaAttuale = $lingua_predefinita; // Usa la lingua predefinita
}

?>