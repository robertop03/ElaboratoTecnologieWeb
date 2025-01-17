<!-- MOBILE PAGE -->
<div class="container mt-4 mb-5 d-md-none">
  <!-- Sezione profilo -->
  <div class="d-flex align-items-center mb-4">
    <div>
      <h5 class="mb-2 ms-3"><?php echo $_SESSION["nome"] . " " . $_SESSION["cognome"]; ?></h5>
      <p class="text-muted ms-3"><?php echo $_SESSION["email"] ?></p>
    </div>
  </div>

  <!-- Sezioni menu -->
  <ul class="list-group list-group-flush">
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "My orders" : "I miei ordini" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You have placed 3 orders" : "Hai effettuato 3 ordini" ?></span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Delivery Addresses" : "Indirizzi di spedizione" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "1 address" : "1 indirizzo" ?></span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Payment Methods" : "Metodi di pagamento" ?></span>
          <span class="text-muted small">Visa **34</span>
        </div>
      </a>
      <a href="" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Favourites" : "Preferiti" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You have no favourites" : "Non hai preferiti" ?></span>
        </div>
      </a>
      <a href="" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="notifiche.php" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Notifications" : "Notifiche" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "You currently have no notifications" : "Al momento non hai notifiche" ?></span>
        </div>
      </a>
      <a href="notifiche.php" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100" data-bs-toggle="modal" data-bs-target="#impostazioniModal">
        <div class="d-flex flex-column">
          <span class="fw-bold"><?php echo $linguaAttuale == "en" ? "Settings" : "Impostazioni" ?></span>
          <span class="text-muted small"><?php echo $linguaAttuale == "en" ? "Manage notifications and password" : "Gestisci notifiche e password" ?></span>
        </div>
      </a>
      <a href="#" data-bs-toggle="modal" data-bs-target="#impostazioniModal" aria-label="icona freccia a destra">
        <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span>
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
                  <button type="submit" class="btn btn-lg btn-primary mt-3" value="formDati"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
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
                    <input type="password" class="form-control" id="new-password-modal" required />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="confirm-password-modal" class="form-label"><?php echo $linguaAttuale == "en" ? "Confirm new password" : "Conferma nuova password" ?><span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="confirm-password-modal" required />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="d-grid w-50 mx-auto">
                  <button type="submit" class="btn btn-lg btn-primary mt-3" name="submit_form" name="submit_form" value="formPw"><?php echo $linguaAttuale == "en" ? "Save" : "Salva" ?></button>
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
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: PO124R</p>
        <p>Creato il: 17/01/2024</p>
        <p>Totale: 25€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: RE642E</p>
        <p>Creato il: 12/01/2024</p>
        <p>Totale: 35€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "See details" : "Vedi dettagli" ?></a>
      </div>
    </div>
    <a href="#" class="mt-3 text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "see all" : "vedi tutti" ?></a>
  </div>

  <!-- Sezione Indirizzi di spedizione e Metodi di pagamento -->
  <div class="row mb-4">
    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Delivery addresses" : "Indirizzi di spedizione" ?></h4>
      <div class="card p-3 bg-light">
        <p>Italia<br />Via esempio 123, 47039</p>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "Add a new address" : "Aggiungi un nuovo indirizzo" ?></a>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "Edit" : "Modifica" ?></a>
      </div>
    </div>
    <div class="col-md-6">
      <h4><?php echo $linguaAttuale == "en" ? "Payment methods" : "Metodi di pagamento" ?></h4>
      <div class="card p-3 bg-light">
        <p><?php echo $linguaAttuale == "en" ? "Default Payment Method" : "Metodo di pagamento predefinito" ?><br />Visa **34</p>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "Add a new payment method" : "Aggiungi un nuovo metodo di pagamento" ?></a>
        <a href="#" class="text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "Edit" : "Modifica" ?></a>
      </div>
    </div>
  </div>

  <!-- Sezione Preferiti -->
  <div class="row mb-4">
    <div class="col-12">
      <h4><?php echo $linguaAttuale == "en" ? "Favourites" : "Preferiti" ?></h4>
      <div class="d-flex overflow-auto">
        <div class="col-md-4">
          <div class="card me-3">
            <img src="resources/img/foto1.jpg" alt="Château Fleur Haut Gaussens" />
            <div class="card-body text-center">
              <p>Château Fleur Haut Gaussens</p>
              <p>12,90€</p>
              <span class="bi bi-cart-plus text-dark pe-2" role="img" aria-label="icona aggiungi al carrello"></span>
              <span class="bi bi-heart-fill text-dark ps-2" role="img" aria-label="icona cuore pieno"></span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card me-3">
            <img src="resources/img/foto2.jpg" alt="Sottimano" />
            <div class="card-body text-center">
              <p>Sottimano</p>
              <p>19,90€</p>
              <span class="bi bi-cart-plus text-dark pe-2" role="img" aria-label="icona aggiungi al carrello"></span>
              <span class="bi bi-heart-fill text-dark ps-2" role="img" aria-label="icona cuore pieno"></span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="resources/img/foto3.jpg" alt="Mazoni Campi" />
            <div class="card-body text-center">
              <p>Mazoni Campi</p>
              <p>14,90€</p>
              <span class="bi bi-cart-plus text-dark pe-2" role="img" aria-label="icona aggiungi al carrello"></span>
              <span class="bi bi-heart-fill text-dark ps-2" role="img" aria-label="icona cuore pieno"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="" class="mt-3 text-decoration-none border-bottom pb-1"><?php echo $linguaAttuale == "en" ? "see all" : "vedi tutti" ?></a>
  </div>

  <!-- Sezione Notifiche -->
  <div class="row mb-4">
    <div class="col-12">
      <h4><?php echo $linguaAttuale == "en" ? "Notification" : "Notifiche" ?></h4>
      <ul class="notifications-list">
        <li>
          <span class="bi bi-bell text-primary me-2" role="img" aria-label="icona campanella"></span>
          Aggiornamento spedizione - <small class="text-muted">12 Marzo 2024</small>
        </li>
        <li>
          <span class="bi bi-box-arrow-down text-success me-2" role="img" aria-label="icona freccia giù"></span>
          Ordine effettuato - <small class="text-muted">11 Marzo 2024</small>
        </li>
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
