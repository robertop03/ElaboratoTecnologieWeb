<div class="d-flex flex-column flex-lg-row">
  <!-- Notification List -->
  <?php if(!empty($notifiche)):?>
  <div class="list-group flex-lg-shrink-0">
  <?php foreach ($notifiche as $notifica): ?>
    <a href="javascript:void(0)" 
       class="list-group-item list-group-item-action 
              <?php echo $notifica["Visualizzato"] === 'Y' ? 'bg-white fw-normal opacity-50' : 'bg-light fw-bold'; ?>" 
       data-id="<?php echo $notifica['ID_NOTIFICA']; ?>"
       onclick="setNotificaLetta(this, event)">
      <span class="bi bi-truck me-3" role="img"></span>
      <span class="pe-5"><?php echo htmlspecialchars($notifica["Titolo"]); ?></span>
      <span class="ps-5 ms-5"><?php echo htmlspecialchars($notifica["Data"]); ?></span>
      <p class="mb-0 text-muted"><?php echo htmlspecialchars($notifica["Testo"]); ?></p>
      <button class="btn btn-danger btn-sm float-end" 
              onclick="eliminaNotifica(event, '<?php echo $notifica['ID_NOTIFICA']; ?>')">
            X
      </button>
    </a>
   <?php endforeach; ?>
  </div>

  <!-- Notification Details -->
  <div class="flex-grow-1 ms-lg-3 d-none d-lg-block">
    <div class="card min-vh-25">
      <div class="card-body">
        <h5 class="card-title"><?php echo $linguaAttuale == "en" ? "Select a notification" : "Seleziona una notifica" ?></h5>
        <p class="card-text"><?php echo $linguaAttuale == "en" ? "The notification details will appear here" : "I dettagli della notifica appariranno qui" ?></p>
      </div>
    </div>
  </div>
  <!-- Modal for Mobile -->
  <div class="modal fade" id="notification-modal" tabindex="-1" aria-labelledby="notificationModalLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationModalLabel"></h5>
        </div>
        <div class="modal-body"> </div>
        <div class="modal-footer">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
    <p class="ms-3 ps-3 pt-2"><?php echo $linguaAttuale == "en" ? "Currently, you have no notifications" : "Attualmente non hai notifiche" ?></p>
  <?php endif; ?>
</div>
