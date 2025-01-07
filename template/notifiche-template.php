<div class="d-flex flex-column flex-lg-row">
  <!-- Notification List -->
  <div class="list-group flex-lg-shrink-0">
    <a href="#" class="list-group-item list-group-item-action">
      <span class="bi bi-truck me-3" role="img"></span>
      <span>Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">La spedizione è arrivata con successo!</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <span class="bi bi-truck me-3" role="img"></span>
      <span>Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">L'ordine IT2320P è in arrivo domani!</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <span class="bi bi-truck me-3" role="img"></span>
      <span>Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">La spedizione contenente l'ordine IT2320P è stata effettuata</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <span class="bi bi-truck me-3" role="img"></span>
      <span>Ordine effettuato</span>
      <p class="mb-0 text-muted">Ordine IT2320P effettuato con successo</p>
    </a>
  </div>

  <!-- Notification Details -->
  <div class="flex-grow-1 ms-lg-3 d-none d-lg-block">
    <div class="card min-vh-25">
      <div class="card-body">
        <h5 class="card-title">Seleziona una notifica</h5>
        <p class="card-text">I dettagli della notifica selezionata appariranno qui.</p>
      </div>
    </div>
  </div>
  <!-- Modal for Mobile -->
  <div class="modal fade" id="notification-modal" tabindex="-1" aria-labelledby="notificationModalLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationModalLabel">Titolo Notifica</h5>
        </div>
        <div class="modal-body"> Contenuto della notifica. </div>
        <div class="modal-footer">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
      </div>
    </div>
  </div>
</div>
