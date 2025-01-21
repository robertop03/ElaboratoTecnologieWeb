<!DOCTYPE html>
<html lang="<?php $linguaAttuale ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <script src="js/script.js?v=1"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- NAVBAR -->
    <header class="fixed-top">
      <nav class="navbar navbar-expand-lg" style="background-color: #343a40;">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="dashboard.php">Admin Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item me-3">
                <a class="nav-link btn btn-outline-dark text-white" href="OrderManager.php">Ordini</a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link btn btn-outline-dark text-white" href="eventManager.php">Eventi</a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link btn btn-outline-dark text-white" href="wineManager.php">Vini  </a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link btn btn-outline-dark text-white" href="index.php">Home  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark text-danger" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- MAIN SECTION -->
    <main class="flex-grow-1">
      <div class="container">
        <?php require($templateParams["nome"]); ?>
      </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-4 custom-footer mt-auto" style="background-color: #343a40;">
      <div class="container">
        <div class="row text-center mt-3">
          <div class="col">
            <img src="resources/img/logoWeb.png" alt="Logo" class="img-fluid logo-footer" />
            <p class="mt-2">/vino copyright © 2024</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- END FOOTER -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
