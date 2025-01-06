<!-- MOBILE PAGE -->
<div class="container mt-4 mb-5 d-md-none">
  <!-- Sezione profilo -->
  <div class="d-flex align-items-center mb-4">
    <img src="resources/img/persona.jpg" alt="Profilo utente" class="rounded-circle me-3 w-25" />
    <div>
      <h5 class="mb-1">Matilda Brown</h5>
      <p class="text-muted mb-0">matildabrown@mail.com</p>
    </div>
  </div>

  <!-- Sezioni menu -->
  <ul class="list-group list-group-flush">
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold">I miei ordini</span>
          <span class="text-muted small">Hai effettuato 3 ordini</span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold">Indirizzi di spedizione</span>
          <span class="text-muted small">1 indirizzo</span>
        </div>
      </a>
      <span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold">Metodi di pagamento</span>
          <span class="text-muted small">Visa **34</span>
        </div>
      </a>
      <a href="" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold">Preferiti</span>
          <span class="text-muted small">Non hai preferiti</span>
        </div>
      </a>
      <a href="" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="notifiche.html" class="text-decoration-none text-dark w-100">
        <div class="d-flex flex-column">
          <span class="fw-bold">Notifiche</span>
          <span class="text-muted small">Al momento non hai notifiche</span>
        </div>
      </a>
      <a href="notifiche.html" aria-label="icona freccia a destra"><span class="bi bi-chevron-right text-muted" role="img" aria-hidden="true"></span></a>
    </li>
    <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
      <a href="#" class="text-decoration-none text-dark w-100" data-bs-toggle="modal" data-bs-target="#impostazioniModal">
        <div class="d-flex flex-column">
          <span class="fw-bold">Impostazioni</span>
          <span class="text-muted small">Gestisci notifiche e password</span>
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
          <h5 class="modal-title" id="impostazioniModalLabel">Impostazioni</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi impostazioni"></button>
        </div>
        <div class="modal-body">
          <!-- Sezione Impostazioni -->
          <div class="row">
            <div class="col-md-6">
              <h4>Informazioni Personali</h4>
              <form>
                <div class="mb-3">
                  <label for="nome-modal" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="nome-modal" />
                </div>
                <div class="mb-3">
                  <label for="cognome-modal" class="form-label">Cognome</label>
                  <input type="text" class="form-control" id="cognome-modal" />
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notifiche-modal" />
                  <label class="form-check-label" for="notifiche-modal">Voglio ricevere notifiche per gli stati delle consegne</label>
                </div>
              </form>
            </div>
            <div class="col-md-6">
              <h4 class="py-3">Cambia Password</h4>
              <form>
                <div class="mb-3">
                  <label for="current-password-modal" class="form-label">Password attuale</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="current-password-modal" />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="new-password-modal" class="form-label">Nuova Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="new-password-modal" />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="confirm-password-modal" class="form-label">Conferma Nuova Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="confirm-password-modal" />
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
                    </button>
                  </div>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-lg btn-primary mt-3">Salva</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- DESKTOP PAGE -->
<div class="container mt-4 mb-5 d-none d-md-block">
  <!-- Sezione I miei ordini -->
  <div class="row mb-4">
    <div class="col-12">
      <h3>I miei ordini</h3>
    </div>
    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: AT325D</p>
        <p>Creato il: 27/01/2024</p>
        <p>Totale: 45€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1">Vedi dettagli</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: PO124R</p>
        <p>Creato il: 17/01/2024</p>
        <p>Totale: 25€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1">Vedi dettagli</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 bg-light">
        <p class="fw-bold">N. ordine: RE642E</p>
        <p>Creato il: 12/01/2024</p>
        <p>Totale: 35€</p>
        <a href="#" class="text-decoration-none border-bottom pb-1">Vedi dettagli</a>
      </div>
    </div>
    <a href="#" class="mt-3 text-decoration-none border-bottom pb-1">vedi tutti</a>
  </div>

  <!-- Sezione Indirizzi di spedizione e Metodi di pagamento -->
  <div class="row mb-4">
    <div class="col-md-6">
      <h4>Indirizzi di spedizione</h4>
      <div class="card p-3 bg-light">
        <p>Italia<br />Via esempio 123, 47039</p>
        <a href="#" class="text-decoration-none border-bottom pb-1">Aggiungi un nuovo indirizzo</a>
        <a href="#" class="text-decoration-none border-bottom pb-1">Modifica</a>
      </div>
    </div>
    <div class="col-md-6">
      <h4>Metodi di pagamento</h4>
      <div class="card p-3 bg-light">
        <p>Metodo di pagamento predefinito<br />Visa **34</p>
        <a href="#" class="text-decoration-none border-bottom pb-1">Aggiungi un nuovo metodo</a>
        <a href="#" class="text-decoration-none border-bottom pb-1">Modifica</a>
      </div>
    </div>
  </div>

  <!-- Sezione Preferiti -->
  <div class="row mb-4">
    <div class="col-12">
      <h4>Preferiti</h4>
      <div class="d-flex overflow-auto">
        <div class="col-md-4">
          <div class="card me-3">
            <img src="resources/img/vino1.jpg" alt="Château Fleur Haut Gaussens" />
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
            <img src="resources/img/vino2.jpg" alt="Sottimano" />
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
            <img src="resources/img/vino3.jpg" alt="Mazoni Campi" />
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
    <a href="" class="mt-3 text-decoration-none border-bottom pb-1">vedi tutti</a>
  </div>

  <!-- Sezione Notifiche -->
  <div class="row mb-4">
    <div class="col-12">
      <h4>Notifiche</h4>
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
    <a href="notifiche.html" class="mt-3 text-decoration-none border-bottom pb-1">vedi tutte</a>
  </div>

  <div class="section-separator"></div>

  <!-- Sezione Impostazioni -->
  <div class="row">
    <div class="col-md-6">
      <h4>Informazioni Personali</h4>
      <form>
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" />
        </div>
        <div class="mb-3">
          <label for="cognome" class="form-label">Cognome</label>
          <input type="text" class="form-control" id="cognome" />
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="notifiche" />
          <label class="form-check-label" for="notifiche">Voglio ricevere notifiche per gli stati delle consegne</label>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <h4>Cambia Password</h4>
      <form>
        <div class="mb-3">
          <label for="current-password" class="form-label">Password attuale</label>
          <div class="input-group">
            <input type="password" class="form-control" id="current-password" />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label for="new-password" class="form-label">Nuova Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="new-password" />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label for="confirm-password" class="form-label">Conferma Nuova Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="confirm-password" />
            <button class="btn btn-outline-secondary toggle-password" type="button">
              <span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>
            </button>
          </div>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-lg btn-primary mt-3">Salva</button>
        </div>
      </form>
    </div>
  </div>
</div>
