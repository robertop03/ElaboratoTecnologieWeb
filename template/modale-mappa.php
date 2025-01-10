<!-- Modale della Mappa -->
<div class="modal fade" id="map-modal" tabindex="-1" aria-labelledby="mapModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel"><?php echo $linguaAttuale == "en" ? "Select a region" : "Seleziona una regione" ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi mappa regioni"></button>
      </div>
      <div class="modal-body">
        <svg viewBox="0 0 3001 792.58575"></svg>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $linguaAttuale == "en" ? "Close" : "Chiudi" ?></button>
      </div>
    </div>
  </div>
</div>