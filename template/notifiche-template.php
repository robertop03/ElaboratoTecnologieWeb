<div class="d-flex flex-column flex-lg-row">
  <!-- Notification List -->
  <div class="list-group flex-lg-shrink-0">
    <a href="#" class="list-group-item list-group-item-action" onclick="showNotification(event)">
      <span class="bi bi-truck me-3" role="img" aria-hidden="true"></span>
      <span class="h5">Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">La spedizione è arrivata con successo!</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action" onclick="showNotification(event)">
      <span class="bi bi-truck me-3" role="img" aria-hidden="true"></span>
      <span class="h5">Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">L'ordine IT2320P è in arrivo domani!</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action" onclick="showNotification(event)">
      <span class="bi bi-truck me-3" role="img" aria-hidden="true"></span>
      <span class="h5">Aggiornamento spedizione</span>
      <p class="mb-0 text-muted">La spedizione contenente l'ordine IT2320P è stata effettuata</p>
    </a>
    <a href="#" class="list-group-item list-group-item-action" onclick="showNotification(event)">
      <span class="bi bi-truck me-3" role="img" aria-hidden="true"></span>
      <span class="h5">Ordine effettuato</span>
      <p class="mb-0 text-muted">Ordine IT2320P effettuato con successo</p>
    </a>
  </div>

  <!-- Notification Details -->
  <div class="flex-grow-1 ms-lg-3 d-none d-lg-block">
    <div class="card min-vh-25">
      <div class="card-body">
        <span class="card-title h5">Seleziona una notifica</span>
        <p class="card-text">I dettagli della notifica selezionata appariranno qui.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Mobile -->
<div class="modal fade" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="notificationModalLabel">Titolo Notifica</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi notifica"></button>
      </div>
      <div class="modal-body"> Contenuto della notifica. </div>
    </div>
  </div>
</div>
