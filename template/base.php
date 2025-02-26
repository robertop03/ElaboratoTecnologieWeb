<!DOCTYPE html>
<html lang="<?php echo $linguaAttuale ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <script src="js/script.js?v=1"></script>
    <?php
      $pageName = basename($_SERVER['PHP_SELF'], ".php");
      if ($pageName === 'carrello') {
        echo '<script src="js/cart.js?v=1"></script>';
      }
      if ($pageName === 'checkout') {
        echo '<script src="js/checkout.js?v=1"></script>';
      }
      if ($pageName === 'index') {
        echo '<script src="js/newsletter.js?v=1"></script>';
      }
      if ($pageName === 'utente') {
        echo '<script src="js/user.js?v=1"></script>';
      }
      if ($pageName === 'prodotto') {
        echo '<script src="js/product.js?v=1"></script>';
        echo '<script src="js/script.js?v=1"></script>';
      }
    ?>
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
            <button class="btn me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLaterale" aria-controls="menuLaterale" aria-label="icona menu burger">
              <span class="bi bi-list" role="img" aria-hidden="true"></span>
            </button>
            <!-- Logo Mobile -->
            <a href="index.php" class="navbar-brand">
              <img src="resources/img/logoWeb.png" alt="Logo" />
            </a>
            <!-- Icone Mobile -->
            <div class="d-flex align-items-center">
              <a href="carrello.php" class="text-decoration-none me-3" aria-label="icona carrello" title="Vai al carrello">
                <span class="bi bi-cart" role="img" aria-hidden="true"></span>
              </a>
              <a href="login.php" class="text-decoration-none" aria-label="icona utente" title="Vai al tuo profilo">
                <span class="bi bi-person" role="img" aria-hidden="true"></span>
              </a>
              <?php if(isset(($_SESSION["email"]))): ?>
                  <?php $nNotifications = $db->getNumeroNotificheNonLette($_SESSION["email"]); ?>
                  <?php if($nNotifications[0]["COUNT(ID_NOTIFICA)"] !== 0): ?>
                  <p id="notification-count-mb"> <?php echo $nNotifications[0]["COUNT(ID_NOTIFICA)"]?></p> 
                  <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
          <!-- Barra di ricerca Mobile -->
          <div class="d-flex d-md-none mt-2">
            <div class="search-bar d-flex align-items-center rounded">
              <span class="bi bi-search" role="img" aria-label="icona lente d'ingrandimento"></span>
              <form action="listaprodotti.php" method="get" class="w-100">
                <label for="search-bar-mobile" class="visually-hidden"><?php echo $linguaAttuale == "en" ? "Search bar" : "Barra di ricerca" ?></label>
                <input type="text" class="form-control border-0 bg-transparent text-light" placeholder="<?php echo $linguaAttuale == "en" ? "Search" : "Cerca" ?>" name="q" id="search-bar-mobile" />
              </form>
            </div>
          </div>

          <!-- Desktop: Barra di ricerca e icone -->
          <div class="d-none d-md-flex align-items-center justify-content-between w-100 mt-3 mt-md-0">
            <!-- Logo Desktop -->
            <a href="index.php" class="navbar-brand">
              <img src="resources/img/logoWeb.png" alt="Logo" />
            </a>
            <!-- Barra di ricerca Desktop -->
            <div class="search-bar d-flex align-items-center rounded">
                <span class="bi bi-search" role="img" aria-label="icona lente d'ingrandimento"></span>
                <form action="listaprodotti.php" method="get" class="w-100">
                  <label for="search-bar-desktop" class="visually-hidden"> <?php echo $linguaAttuale == "en" ? "Search bar" : "Barra di ricerca" ?></label>
                  <input type="text" class="form-control border-0 bg-transparent text-dark w-100" placeholder="<?php echo $linguaAttuale == "en" ? "Search" : "Cerca" ?>" name="q" id="search-bar-desktop" />
                </form>
            </div>
            <!-- Icone Desktop -->
            <div class="icons-group d-flex align-items-center">
              <div class="dropdown pe-1">
                <a class="btn text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLinkDesktop" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="resources/icons/<?php echo $linguaAttuale == "en" ? "english.png" : "italy.png" ?>" alt="<?php echo $linguaAttuale == "en" ? "Bandiera Inghilterra" : "Bandiera Italia" ?>" />
                  <?php echo $linguaAttuale == "en" ? "EN" : "IT" ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLinkDesktop">
                  <li
                    ><a class="dropdown-item" href="?lang=en"><img src="resources/icons/english.png" alt="Bandiera Inghilterra" /> EN</a></li
                  >
                  <li
                    ><a class="dropdown-item" href="?lang=it"><img src="resources/icons/italy.png" alt="Bandiera Italia" /> IT</a></li
                  >
                </ul>
              </div>
              <a href="carrello.php" class="text-decoration-none me-3" aria-label="icona carrello" title="Vai al carrello">
                <span class="bi bi-cart" role="img" aria-hidden="true"></span>
              </a>
              <a href="login.php" class="text-decoration-none" aria-label="icona utente" title="Vai al carrello">
                <span class="bi bi-person" role="img" aria-hidden="true"></span>
              </a>
              <?php if(isset(($_SESSION["email"]))): ?>
                <?php $nNotifications = $db->getNumeroNotificheNonLette($_SESSION["email"]); ?>
                <?php if($nNotifications[0]["COUNT(ID_NOTIFICA)"] !== 0): ?>
                  <p class="text-light" id="notification-count-d"> <?php echo $nNotifications[0]["COUNT(ID_NOTIFICA)"]?></p>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </nav>
      <!-- Menu di navigazione (solo desktop) -->
      <div class="container-fluid d-none d-md-flex justify-content-center border border-dark">
        <ul class="nav-links d-flex gap-3 list-unstyled">
          <li><a href="listaprodotti.php" class="text-dark"><?php echo $linguaAttuale == "en" ? "ALL" : "TUTTI" ?></a></li>
          <li><a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#map-modal"><?php echo $linguaAttuale == "en" ? "REGION" : "REGIONE" ?></a></li>
          <li><a href="listaprodotti.php?tona=rosso" class="text-dark"><?php echo $linguaAttuale == "en" ? "RED" : "ROSSI" ?></a></li>
          <li><a href="listaprodotti.php?tona=bianco" class="text-dark"><?php echo $linguaAttuale == "en" ? "WHITE" : "BIANCHI" ?></a></li>
          <li><a href="listaprodotti.php?tona=rosè" class="text-dark"><?php echo $linguaAttuale == "en" ? "ROSÈ" : "ROSATI" ?></a></li>
          <li><a href="listaprodotti.php?friz=fermo" class="text-dark"><?php echo $linguaAttuale == "en" ? "STILL" : "FERMI" ?></a></li>
          <li><a href="listaprodotti.php?friz=frizzante" class="text-dark"><?php echo $linguaAttuale == "en" ? "SPARKLING" : "FRIZZANTI" ?></a></li>
        </ul>
      </div>
      <!-- OFFCANVAS MENU -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="menuLaterale" aria-labelledby="menuLateraleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="menuLateraleLabel"><?php echo $linguaAttuale == "en" ? "Categories" : "Categorie" ?></h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Chiudi menù"></button>
        </div>
        <div class="offcanvas-body">
          <!-- LISTA PRINCIPALE -->
          <ul class="list-group">
            <li class="list-group-item"><a href="listaprodotti.php"><?php echo $linguaAttuale == "en" ? "All" : "Tutti" ?></a></li>
            <li class="list-group-item"><a href="listaprodotti.php?tona=rosso"><?php echo $linguaAttuale == "en" ? "Red" : "Rossi" ?></a></li>
            <li class="list-group-item"><a href="listaprodotti.php?tona=bianco"><?php echo $linguaAttuale == "en" ? "White" : "Bianchi" ?></a></li>
            <li class="list-group-item"><a href="listaprodotti.php?tona=rosè"><?php echo $linguaAttuale == "en" ? "Rosè" : "Rosati" ?></a></li>
            <li class="list-group-item"><a href="listaprodotti.php?friz=fermo"><?php echo $linguaAttuale == "en" ? "Still" : "Fermi" ?></a></li>
            <li class="list-group-item"><a href="listaprodotti.php?friz=frizzante"><?php echo $linguaAttuale == "en" ? "Sparkling" : "Frizzanti" ?></a></li>
            <!-- REGIONE CON SUB-MENU -->
            <li class="list-group-item">
              <a class="d-flex justify-content-between align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#menuRegioni" aria-expanded="false" aria-controls="menuRegioni">
                <?php echo $linguaAttuale == "en" ? "Regions" : "Regioni" ?>
                <span class="bi bi-chevron-down" role="img" aria-hidden="true"></span>
              </a>
              <!-- SUBMENU -->
              <ul class="list-group collapse mt-2" id="menuRegioni">
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#map-modal"><?php echo $linguaAttuale == "en" ? "Go to the maps" : "Vai alla mappa" ?></a></li>
              </ul>
            </li>
            <li class="list-group-item">  <?php echo $linguaAttuale == "en" ? "Language" : "Lingua" ?>
            <div class="dropdown pe-1">
                <a class="btn text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="resources/icons/<?php echo $linguaAttuale == "en" ? "english.png" : "italy.png" ?>" alt="<?php echo $linguaAttuale == "en" ? "Bandiera Inghilterra" : "Bandiera Italia" ?>" />
                  <?php echo $linguaAttuale == "en" ? "EN" : "IT" ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li
                    ><a class="dropdown-item" href="?lang=en"><img src="resources/icons/english.png" alt="Bandiera Inghilterra" /> EN</a></li
                  >
                  <li
                    ><a class="dropdown-item" href="?lang=it"><img src="resources/icons/italy.png" alt="Bandiera Italia" /> IT</a></li
                  >
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <!-- MAIN SECTION -->
    <main class="<?php echo $templateParams['mainClasses']; ?>">
      <?php
      if (!isset($_COOKIE['cookiesAccepted'])) {
        require('cookie.php');  
      }
      ?>
      <?php require("modale-mappa.php"); ?>
      <?php require($templateParams["nome"]); ?>
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-4 custom-footer mt-auto">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <span class="bi bi-lock fs-1 me-3" role="img" aria-label="icona lucchetto"></span>
            <div>
              <h5
                ><strong><?php echo $linguaAttuale == "en" ? "SAFE SHOPPING" : "SHOPPING SICURO" ?></strong></h5
              >
              <p><?php echo $linguaAttuale == "en" ? "Your <strong>online payments</strong> are secure, and we also accept <strong>cash on delivery</strong>." : "I tuoi <strong>pagamenti online</strong> sono protetti e accettiamo anche il <strong>pagamento alla consegna</strong>" ?></p>
            </div>
          </div>
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <span class="bi bi-truck fs-1 me-3" role="img" aria-label="icona camion"></span>
            <div>
              <h5><strong><?php echo $linguaAttuale == "en" ? "SHIPPING COST" : "COSTI SPEDIZIONE" ?></strong></h5>
              <p><?php echo $linguaAttuale == "en" ? "<strong>Free</strong> for orders over <strong>€69</strong>, otherwise shipping costs €7.75." : "<strong>Gratis</strong> per gli ordini sopra i <strong>69€</strong>, altrimenti la spedizione è di 7.75€" ?></p>
            </div>
          </div>
          <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
            <span class="bi bi-telephone fs-1 me-3" role="img" aria-label="icona telefono"></span>
            <div>
              <h5><strong><?php echo $linguaAttuale == "en" ? "CONTACT US" : "CONTATTACI" ?></strong></h5>
              <p><?php echo $linguaAttuale == "en" ? "Check <strong>our guide</strong> or contact our <strong>customer service</strong> for more information and assistance" : "Consulta la <strong>nostra guida</strong> o contatta il nostro <strong>servizio clienti</strong> per ottenere maggiori informazioni e ricevere assistenza" ?></p>
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
