<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- NAVBAR -->
    <header class="fixed-top">
      <nav class="navbar p-2">
        <div class="container-fluid">
          <!-- Mobile: Navbar -->
          <div class="d-flex d-md-none align-items-center justify-content-between w-100">
            <!-- Menu Hamburger -->
            <button class="btn me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLaterale" aria-controls="menuLaterale">
              <span class="bi bi-list" role="img" aria-hidden="true"></span>
            </button>
            <!-- Logo Mobile -->
            <a href="index.php" class="navbar-brand">
              <img src="resources/img/logoWeb.png" alt="Logo" />
            </a>
            <!-- Icone Mobile -->
            <div class="d-flex align-items-center">
              <a href="carrello.php" class="text-decoration-none me-3" aria-label="icona carrello">
                <span class="bi bi-cart" role="img" aria-hidden="true"></span>
              </a>
              <a href="utente.php" class="text-decoration-none" aria-label="icona utente">
                <span class="bi bi-person" role="img" aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <!-- Barra di ricerca Mobile -->
          <div class="d-flex d-md-none mt-2">
            <div class="search-bar d-flex align-items-center rounded px-3 w-100">
              <span class="bi bi-search" role="img" aria-label="icona lente d'ingrandimento"></span>
              <label for="search-bar-mobile" class="visually-hidden">Barra di ricerca</label>
              <input type="text" class="form-control border-0 bg-transparent text-dark" placeholder="Cerca" name="search-bar-mobile" id="search-bar-mobile" />
            </div>
          </div>

          <!-- Desktop: Barra di ricerca e icone -->
          <div class="d-none d-md-flex align-items-center justify-content-between w-100 mt-3 mt-md-0">
            <!-- Logo Desktop -->
            <a href="index.php" class="navbar-brand">
              <img src="resources/img/logoWeb.png" alt="Logo" />
            </a>
            <!-- Barra di ricerca Desktop -->
            <div class="search-bar d-flex align-items-center rounded px-3">
              <span class="bi bi-search" role="img" aria-label="icona lente d'ingrandimento"></span>
              <label for="search-bar-desktop" class="visually-hidden">Barra di ricerca</label>
              <input type="text" class="form-control border-0 bg-transparent text-dark" placeholder="Cerca" name="search-bar-desktop" id="search-bar-desktop" />
            </div>
            <!-- Icone Desktop -->
            <div class="icons-group d-flex align-items-center">
              <div class="dropdown pe-1">
                <a class="btn text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <img src="resources/icons/italy.png" alt="Bandiera Italia" /> IT </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li
                    ><a class="dropdown-item" href="#"><img src="resources/icons/english.png" alt="Bandiera Inghilterra" /> EN</a></li
                  >
                  <li
                    ><a class="dropdown-item" href="#"><img src="resources/icons/italy.png" alt="Bandiera Italia" /> IT</a></li
                  >
                </ul>
              </div>
              <a href="carrello.php" class="text-decoration-none me-3" aria-label="icona carrello">
                <span class="bi bi-cart" role="img" aria-hidden="true"></span>
              </a>
              <a href="utente.php" class="text-decoration-none" aria-label="icona utente">
                <span class="bi bi-person" role="img" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
      </nav>
      <!-- Menu di navigazione (solo desktop) -->
      <div class="container-fluid d-none d-md-flex justify-content-center border border-dark">
        <ul class="nav-links d-flex gap-3 list-unstyled">
          <li><a href="#" class="text-dark text-uppercase" data-bs-toggle="modal" data-bs-target="#map-modal">Regione</a></li>
          <li><a href="#" class="text-dark text-uppercase">Rossi</a></li>
          <li><a href="#" class="text-dark text-uppercase">Bianchi</a></li>
          <li><a href="#" class="text-dark text-uppercase">Rosati</a></li>
          <li><a href="#" class="text-dark text-uppercase">Fermi</a></li>
          <li><a href="#" class="text-dark text-uppercase">Frizzanti</a></li>
        </ul>
      </div>
      <!-- OFFCANVAS MENU -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="menuLaterale" aria-labelledby="menuLateraleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="menuLateraleLabel">Categorie</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Chiudi menù"></button>
        </div>
        <div class="offcanvas-body">
          <!-- LISTA PRINCIPALE -->
          <ul class="list-group">
            <li class="list-group-item"><a href="#">Rossi</a></li>
            <li class="list-group-item"><a href="#">Bianchi</a></li>
            <li class="list-group-item"><a href="#">Rosati</a></li>
            <li class="list-group-item"><a href="#">Fermi</a></li>
            <li class="list-group-item"><a href="#">Frizzanti</a></li>
            <!-- REGIONE CON SUB-MENU -->
            <li class="list-group-item">
              <a class="d-flex justify-content-between align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#menuRegioni" aria-expanded="false" aria-controls="menuRegioni">
                Regioni
                <span class="bi bi-chevron-down" role="img" aria-hidden="true"></span>
              </a>
              <!-- SUBMENU -->
              <ul class="list-group collapse mt-2" id="menuRegioni">
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#map-modal">Vai alla mappa</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <!-- MAIN SECTION -->
    <main class="<?php echo $templateParams['mainClasses']; ?>">
      <?php require("modale-mappa.php"); ?>
      <?php require($templateParams["nome"]); ?>
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-4 custom-footer mt-auto">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <i class="bi bi-lock fs-1 me-3"></i>
            <div>
              <h5><strong>SHOPPING SICURO</strong></h5>
              <p>I tuoi <strong>pagamenti online</strong> sono protetti e accettiamo anche il <strong>pagamento alla consegna</strong></p>
            </div>
          </div>
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <i class="bi bi-truck fs-1 me-3"></i>
            <div>
              <h5><strong>COSTI DI SPEDIZIONE</strong></h5>
              <p><strong>Gratis</strong> per gli ordini sopra i <strong>69€</strong>, altrimenti la spedizione è di 7.75€</p>
            </div>
          </div>
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <i class="bi bi-telephone fs-1 me-3"></i>
            <div>
              <h5><strong>CONTATTACI</strong></h5>
              <p>Consulta la <strong>nostra guida</strong> o contatta il nostro <strong>servizio clienti</strong> per ottenere maggiori informazioni e ricevere assistenza</p>
            </div>
          </div>
        </div>
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
