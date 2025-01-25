<?php
// Importa il contenuto di database.php
require_once 'database.php';

// Crea un'istanza della classe VinoDatabase e resetta il database
$db = new VinoDatabase();
$db->resetDB();
?>