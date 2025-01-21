<!-- MOBILE PAGE -->
<div id="mainMobileContent" class="container mt-4 mb-5 d-md-none">
  <!-- Sezione profilo -->
  <div class="d-flex align-items-center mb-4">
    <div>
      <h5 class="mb-2 ms-3"><?php echo $_SESSION["nome"] . " " . $_SESSION["cognome"]; ?></h5>
      <p class="text-muted ms-3"><?php echo $_SESSION["email"]; ?></p>
    </div>
  </div>

  <!-- Sezioni menu -->
  <ul class="list-group list-group-flush">
    <!-- Ordini -->
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold" data-bs-toggle="modal" data-bs-target="#ordersModal"><?php echo $linguaAttuale == "en" ? "My orders" : "I miei ordini"; ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You have placed 3 orders" : "Hai effettuato 3 ordini"; ?></span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#ordersModal"></span>
    </li>

    <!-- Indirizzi di spedizione -->
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold" data-bs-toggle="modal" data-bs-target="#addressModal"><?php echo $linguaAttuale == "en" ? "Delivery Addresses" : "Indirizzi di spedizione"; ?></span>
          <span class="text-muted small">
            <?php echo $linguaAttuale == "en" ? count($templateParams["addresses"]) . " addresses" : count($templateParams["addresses"]) . " indirizzi"; ?>
          </span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#addressModal"></span>
    </li>

    <!-- Sezione metodi di pagamento -->
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100" data-bs-toggle="modal" data-bs-target="#paymentModal">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Payment Methods" : "Metodi di pagamento"; ?></span>
          <span class="text-muted small">
            <?php echo count($templateParams["paymentMethods"]) . ($linguaAttuale == "en" ? " cards saved" : " carte salvate"); ?>
          </span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#paymentModal"></span>
    </li>

    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="notifiche.php" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Notifications" : "Notifiche" ?></span>
          <?php $nNotifications = $db->getNumeroNotificheNonLette($_SESSION["email"]);
            if($nNotifications[0]["COUNT(ID_NOTIFICA)"] === 0): ?>
            <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You currently have no notifications" : "Al momento non hai notifiche" ?></span>
          <?php else: ?>
            <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You have " . $nNotifications[0]["COUNT(ID_NOTIFICA)"] . " unread notifications" : "Hai " . $nNotifications[0]["COUNT(ID_NOTIFICA)"] . " non lette" ?></span>
          <?php endif; ?>
        </div>
      </a>
      <a href="notifiche.php" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true" ></span></a>
    </li>

    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100" data-bs-toggle="modal" data-bs-target="#impostazioniModal">
        <div class="d-flex flex-column">
          <span class="fw-bold" data-bs-toggle="modal" data-bs-target="#impostazioniModal"><?php echo $linguaAttuale == "en" ? "Settings" : "Impostazioni" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "Manage notifications and password" : "Gestisci notifiche e password" ?></span>
        </div>
      </a>
      <a href="#" data-bs-toggle="modal" data-bs-target="#impostazioniModal" aria-label="icona freccia a destra">
        <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#impostazioniModal"></span>
      </a>
    </li>

  </ul>

  <!-- Modale Impostazioni -->
  <div class="modal fade" id="impostazioniModal" tabindex="-1" aria-labelledby="impostazioniModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="impostazioniModalLabel"><?php echo $linguaAttuale == "en" ? "Settings" : "Impostazioni" ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi impostazioni"></button>
        </div>
        <div class="modal-body">
          <!-- Sezione Impostazioni -->
          <div class="row">
            <div class="col-md-6">
              <h4><?php echo $linguaAttuale == "en" ? "Personal information" : "Informazioni personali" ?></h4>
              <form method="POST" action="utente.php">
                <div class="mb-3">
                  <label for="nome-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "Name" : "Nome" ?><span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nome-modal" name="nome" value="<?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : ''; ?>" required />
                </div>
                <div class="mb-3">
                  <label for="cognome-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "Surname" : "Cognome" ?><span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="cognome-modal" name="cognome" value="<?php echo isset($_SESSION['cognome']) ? htmlspecialchars($_SESSION['cognome']) : ''; ?>" required />
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notifiche-modal" />
                  <label class="form-check-label" for="notifiche-modal"><?php echo $linguaAttuale == "en" ? "I want to receive notifications for delivery status updates" : "Voglio ricevere notifiche per il cambio di stato consegna" ?></label>
                </div>
                <div class="d-grid w-50 mx-auto">
                  <button type="submit" class="btn btn-lg btn-primary mt-3" name="submit_form" value="formDati"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
                </div>
              </form>
            </div>
            <div class="col-md-6">
              <h4 class="py-3"><?php echo $linguaAttuale == "en" ? "Change Password" : "Cambia Password" ?></h4>
              <form method="POST" action="utente.php">
                <div class="mb-3">
                  <label for="current-password-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "Actual password" : "Password attuale" ?><span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="current-password-modal" name="current-password" required />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="new-password-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "New password" : "Nuova password" ?><span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="new-password-modal" name="new-password" required />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="confirm-password-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "Confirm new password" : "Conferma nuova password" ?><span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="confirm-password-modal" name="confirm-password" required />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="d-grid w-50 mx-auto">
                  <button type="submit" class="btn btn-lg btn-primary mt-3" name="submit_form" value="formPw"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-grid mt-4">
    <button class="btn btn-dark btn-lg" onclick="window.location.href='logout.php'">Logout</button>
  </div>
</div>

<!-- DESKTOP PAGE -->
<div class="container mt-4 mb-5 d-none d-md-block">
  
  <!-- Sezione I miei ordini -->
  <div class="row mb-4">
    
    <div class="col-12">
      <h3><?php echo $linguaAttuale == "en" ? "My orders" : "I miei ordini" ?></h3>
    </div>

    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: AT325D</p>
        <p>Creato il: 27/01/2024</p>
        <p>Totale: 45€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: PO124R</p>
        <p>Creato il: 17/01/2024</p>
        <p>Totale: 25€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: RE642E</p>
        <p>Creato il: 12/01/2024</p>
        <p>Totale: 35€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>

    <a href="#" class="mt-3 text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target="#ordersModal"><?php echo $linguaAttuale == "en" ? "see all" : "vedi tutti" ?></a>
  
  </div>

  <!-- Sezione Indirizzi di spedizione e Metodi di pagamento -->
  <div class="row mb-4">
    
    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Delivery addresses" : "Indirizzi di spedizione" ?></h4>
      <div class="card p-3 bg-light">
        <p>Italia<br />Via esempio 123, 47039</p>
        <a href="#" class="text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target=".address-modal"><?php echo $linguaAttuale == "en" ? "See all your addresses" : "Vedi tutti gli indirizzi salvati" ?></a>
      </div>
    </div>

    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Payment methods" : "Metodi di pagamento" ?></h4>
      <div class="card p-3 bg-light">
        <p><?php echo $linguaAttuale == "en" ? "Default Payment Method" : "Metodo di pagamento predefinito" ?><br />Visa **34</p>
        <a href="#" class="text-decoration-none border-bottom pb-1" data-bs-toggle="modal" data-bs-target=".card-modal"><?php echo $linguaAttuale == "en" ? "See all your credit cards" : "Vedi tutte le carte salvate" ?></a>
      </div>
    </div>

  </div>

  <!-- MODALE PER CARTE -->
  <div class="modal fade" id="viewCreditCard" tabindex="-1" aria-labelledby="viewCreditCardLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewCreditCardLabel"><?php echo $linguaAttuale == "en" ? "Choose a credit card" : "Scegli una carta di credito" ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body-viewCards">
          <!-- Lista delle carte salvate -->
          <div class="row g-2" id="creditCard-list">
            <div class="col-12">
              <div class="card p-3 selectable-card" data-card="VISA|1234123412341234|01/25|123">
                <p class="mb-0">VISA<br />**** **** **** 1234<br />Scadenza: 01/25</p>
              </div>
            </div>
            <div class="col-12">
              <div class="card p-3 selectable-card" data-card="MasterCard|5678567856785678|02/26|456">
                <p class="mb-0">MasterCard<br />**** **** **** 5678<br />Scadenza: 02/26</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sezione Preferiti -->
  <div class="row mb-4">
    <div class="col-12">
      <h4><?php echo $linguaAttuale == "en" ? "Favourites" : "Preferiti" ?></h4>
      <div class="d-flex overflow-auto gap-3">
      <?php if($_SESSION["nPrefs"] != 0): ?>
        <?php for ($i = 0; $i < min(3, count($prefs)); $i++): ?>
          <?php $vino = $prefs[$i]; ?>
          <div class="flex-shrink-0">
            <a href="prodotto.php?id=<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>" class="text-decoration-none">
              <div class="card h-100 text-center">
                <img src="<?php echo "resources/img/".htmlspecialchars($vino['Foto'] ?? 'vino_generic.jpg'); ?>" alt="<?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?>" />
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?>
                  </h5>
                  <p class="fs-6 mb-0">
                    <?php echo htmlspecialchars($vino['Provenienza'])." - ".htmlspecialchars($vino['Tonalita']); ?>
                  </p>
                  <p class="fs-6">
                    <?php echo htmlspecialchars($vino['Capacita_Bottiglia']); ?>
                  </p>
                  <p class="card-text fw-bold">
                    <?php echo number_format($vino['Prezzo'], 2, ',', '.')."€"; ?>
                  </p>
                </div>
              </div>
            </a>
          </div>
        <?php endfor; ?>
          <?php else: ?>
            <p><?php echo $linguaAttuale == "en" ? "currently, you have no favorites" : "attualmente non hai preferiti" ?></p>
        <?php endif; ?>
      </div>
    </div>
    <a href="listaprodotti.php?prefs" class="mt-3 text-decoration-none border-bottom pb-1">
      <?php echo $linguaAttuale == "en" ? "see all" : "vedi tutti" ?>
    </a>
  </div>


  <!-- Sezione Notifiche -->
  <div class="row mb-4">
    <div class="col-12">
      <h4><?php echo $linguaAttuale == "en" ? "Notification" : "Notifiche" ?></h4>
      <ul class="notifications-list">
      <?php if(!empty($lastNotifications)): ?>
      <?php foreach ($lastNotifications as $notifica): ?>
        <li>
          <span class="bi bi-bell text-primary me-2" role="img" aria-label="icona campanella"></span>
          <?php echo $notifica["Titolo"] ?> - <small class="text-muted"><?php echo $notifica["Data"] ?></small>
        </li>
        <?php endforeach; ?>
        <?php else: ?>
          <p> <?php echo $linguaAttuale == "en" ? "Currently, you have no notifications to read" : "Attualmente non hai notifiche da leggere" ?> </p>
        <?php endif; ?>
      </ul>
    </div>
    <a href="notifiche.php" class="mt-3 text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "see all" : "vedi tutte" ?></a>
  </div>

  <div class="section-separator"></div>

  <!-- Sezione Impostazioni -->
  <div class="row">
    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Personal information" : "Informazioni personali" ?></h4>
      <form method="POST" action="utente.php">
        <div class="mb-3">
          <label for="nome" class="form-label"><?php echo $linguaAttuale == "en" ? "Name" : "Nome" ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : ''; ?>" required />
        </div>
        <div class="mb-3">
          <label for="cognome" class="form-label"><?php echo $linguaAttuale == "en" ? "Surname" : "Cognome" ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo isset($_SESSION['cognome']) ? htmlspecialchars($_SESSION['cognome']) : ''; ?>" required />
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="notifiche" />
          <label class="form-check-label" for="notifiche"><?php echo $linguaAttuale == "en" ? "I want to receive notifications for delivery status updates" : "Voglio ricevere notifiche per il cambio di stato consegna" ?></label>
        </div>
        <div class="d-grid w-50 mx-auto">
            <button type="submit" class="btn btn-lg btn-primary mt-3" name="submit_form" value="formDati"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Change password" : "Cambia password" ?></h4>
      <?php if(isset($templateParams["risultatoCambioPw"])): ?>
      <p class="text-center"><?php echo $templateParams["risultatoCambioPw"]; ?></p>
      <?php endif; ?>
      <form method="POST" action="utente.php">
        <div class="mb-3">
          <label for="current-password" class="form-label"><?php echo $linguaAttuale == "en" ? "Actual password" : "Password attuale" ?><span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control" id="current-password" name="current-password" required />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label for="new-password" class="form-label"><?php echo $linguaAttuale == "en" ? "New password" : "Nuova password" ?><span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control" id="new-password" name="new-password" required />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label for="confirm-password" class="form-label"><?php echo $linguaAttuale == "en" ? "Confirm new password" : "Conferma nuova password" ?><span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="d-grid w-50 mx-auto">
          <button type="submit" class="btn btn-lg btn-primary mt-3" name="submit_form" value="formPw"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
        </div>
      </form>
    </div>
  </div>
  <div class="d-grid mt-4 mx-auto">
    <button class="btn btn-dark btn-lg" onclick="window.location.href='logout.php'">Logout</button>
  </div>
</div>

<!-- SEZIONE MODALI -->
<!-- Modale per visualizzare tutti gli ordini -->
<div class="modal fade orders-modal" id="ordersModal" tabindex="-1" aria-labelledby="ordersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ordersModalLabel"><?php echo $linguaAttuale == "en" ? "All orders" : "Tutti gli ordini" ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Lista degli ordini -->
        <div class="orders-list">
          <!-- Ordine 1 -->
          <div class="order-item" data-order-id="AT325D">
            <p class="fw-bold ms-2">N. ordine: AT325D</p>
            <hr>
            <p class="ms-2">Creato il: 27/01/2024</p>
            <p class="ms-2">Totale: 45€</p>
            <a href="#" class="text-decoration-none details-link ms-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
          </div>

          <!-- Ordine 2 -->
          <div class="order-item" data-order-id="PO124R">
            <p class="fw-bold ms-2">N. ordine: PO124R</p>
            <hr>
            <p class="ms-2">Creato il: 17/01/2024</p>
            <p class="ms-2">Totale: 25€</p>
            <a href="#" class="text-decoration-none details-link ms-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
          </div>

          <!-- Ordine 3 -->
          <div class="order-item" data-order-id="RE642E">
            <p class="fw-bold ms-2">N. ordine: RE642E</p>
            <hr>
            <p class="ms-2">Creato il: 12/01/2024</p>
            <p class="ms-2">Totale: 35€</p>
            <a href="#" class="text-decoration-none details-link ms-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $linguaAttuale == "en" ? "Close" : "Chiudi" ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modale per i dettagli dell'ordine -->
<div class="modal fade order-details-modal" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderDetailsModalLabel"><?php echo $linguaAttuale == "en" ? "Order details" : "Dettagli dell'ordine" ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Dettagli dell'ordine -->
        <img src="#" alt="Immagine prodotto" class="img-fluid product-image">
        <div class="order-info">
          <p class="fw-bold product-quantity">Quantità: 1</p>
          <p class="product-unit-price">Prezzo unitario: 15€</p>
          <p class="order-status">Stato: In elaborazione</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?php echo $linguaAttuale == "en" ? "Close" : "Chiudi" ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modale Indirizzi -->
<div class="modal fade address-modal" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php echo $linguaAttuale == "en" ? "Delivery Addresses" : "Indirizzi di spedizione"; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php if (!empty($templateParams["addresses"])): ?>
              <?php foreach ($templateParams["addresses"] as $address): ?>
                <div class="address-card">
                  <p class="address-text">
                    <?php echo htmlspecialchars($address["Via"]) . ", " . htmlspecialchars($address["Numero_Civico"]); ?><br />
                    <?php echo htmlspecialchars($address["CAP"]) . " " . htmlspecialchars($address["Citta"]); ?><br />
                    <?php echo htmlspecialchars($address["Paese"]); ?>
                  </p>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p><?php echo $linguaAttuale == "en" ? "No addresses available." : "Nessun indirizzo disponibile."; ?></p>
            <?php endif; ?>
            <div class="text-center mt-3">
              <div class="address-card add-address-card" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
                <span class="bi bi-plus fs-5"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </ul>
</div>

<!-- Modale per aggiungere un indirizzo -->
<div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddressLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewAddressLabel"><?php echo $linguaAttuale === "en" ? "Add New Address" : "Aggiungi un nuovo indirizzo"; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="utente.php">
          <input type="hidden" name="submit_form" value="addAddress">
          <div class="mb-3">
            <label for="address" class="form-label"><?php echo $linguaAttuale === "en" ? "Street Address" : "Via"; ?></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Via delle Rose" required>
          </div>
          <div class="mb-3">
            <label for="numeroCivico" class="form-label"><?php echo $linguaAttuale === "en" ? "House Number" : "Numero Civico"; ?></label>
            <input type="text" class="form-control" id="numeroCivico" name="numeroCivico" placeholder="10" required>
          </div>
          <div class="mb-3">
            <label for="postalCode" class="form-label"><?php echo $linguaAttuale === "en" ? "ZIP Code" : "CAP"; ?></label>
            <input type="text" class="form-control" id="postalCode" name="cap" placeholder="10100" required>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label"><?php echo $linguaAttuale === "en" ? "City" : "Città"; ?></label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Torino" required>
          </div>
          <div class="mb-3">
            <label for="country" class="form-label"><?php echo $linguaAttuale === "en" ? "Country" : "Paese"; ?></label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Italia" required>
          </div>
          <button type="submit" class="btn btn-primary"><?php echo $linguaAttuale === "en" ? "Add Address" : "Aggiungi Indirizzo"; ?></button>
          <div class="text-center mt-3">
            <div class="address-card add-address-card" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
              <span class="bi bi-plus fs-5"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modale per i metodi di pagamento -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $linguaAttuale == "en" ? "Payment Methods" : "Metodi di pagamento"; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <?php foreach ($templateParams["paymentMethods"] as $method): ?>
          <li class="list-group-item">
            <p><?php echo "**** " . substr($method["Numero_Carta"], -4); ?></p>
            <small>
              <?php echo $linguaAttuale == "en" ? "Expires" : "Scadenza"; ?>: 
              <?php echo $method["mese_scadenza"] . "/" . $method["anno_scadenza"]; ?>
            </small>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="text-center mt-3">
          <div class="address-card add-address-card" data-bs-toggle="modal" data-bs-target="#addNewAddressModal">
            <span class="bi bi-plus fs-5"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modale per aggiungere un metodo di pagamento -->
<div class="modal fade" id="addNewPaymentMethodModal" tabindex="-1" aria-labelledby="addNewPaymentMethodLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $linguaAttuale == "en" ? "Add Payment Method" : "Aggiungi metodo di pagamento"; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="utente.php">
          <input type="hidden" name="submit_form" value="addPaymentMethod">
          <div class="mb-3">
            <label for="numeroCarta" class="form-label"><?php echo $linguaAttuale == "en" ? "Card Number" : "Numero carta"; ?></label>
            <input type="text" class="form-control" id="numeroCarta" name="numeroCarta" placeholder="4111 1111 1111 1111" required>
          </div>
          <div class="row">
            <div class="col-6 mb-3">
              <label for="meseScadenza" class="form-label"><?php echo $linguaAttuale == "en" ? "Expiration Month" : "Mese di scadenza"; ?></label>
              <input type="text" class="form-control" id="meseScadenza" name="meseScadenza" min="1" max="12" placeholder="MM" required>
            </div>
            <div class="col-6 mb-3">
              <label for="annoScadenza" class="form-label"><?php echo $linguaAttuale == "en" ? "Expiration Year" : "Anno di scadenza"; ?></label>
              <input type="text" class="form-control" id="annoScadenza" name="annoScadenza" min="<?php echo date('Y'); ?>" max="<?php echo date('Y') + 20; ?>" placeholder="YYYY" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary"><?php echo $linguaAttuale == "en" ? "Save Card" : "Salva carta"; ?></button>
        </form>
      </div>
    </div>
  </div>
</div>