<?php
// dashboard.php
session_start();

// Verifica se il cookie "loggedIn" è impostato e ha valore "true"
if (!isset($_COOKIE["loggedIn"]) || $_COOKIE["loggedIn"] != "true") {
    // Se non è loggato, reindirizza alla pagina di login
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operatore</title>
    <!-- Includi Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }
        .btn-custom {
            background-color: #dc3545;
            color: white;
        }
        header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
        }
        footer {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="text-center">Benvenuto nella Dashboard Operatore</h1>
    </header>

    <div class="container mt-5">
        <p class="text-center">Sei loggato con successo.</p>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <a href="menu1.php" class="btn btn-custom w-100">Menu 1</a>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <a href="menu2.php" class="btn btn-custom w-100">Menu 2</a>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <a href="menu3.php" class="btn btn-custom w-100">Menu 3</a>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <a href="menu4.php" class="btn btn-custom w-100">Menu 4</a>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <a href="menu5.php" class="btn btn-custom w-100">Menu 5</a>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <a href="menu6.php" class="btn btn-custom w-100">Menu 6</a>
            </div>
        </div>

        <form action="logout.php" method="post" class="mt-3">
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Operatore</p>
    </footer>

    <!-- Includi Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
