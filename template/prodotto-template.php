<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6 text-center position-relative">
      <img src="resources/img/<?php echo $vino[0]["Foto"] ?>" alt="<?php echo $vino[0]["Titolo_Prodotto"] ?>" class="img-fluid rounded shadow product"/>
      <button class="btn btn-light position-absolute top-0 end-0 m-2 border rounded-circle">
      <?php $isPref = $db->checkVinoPreferito(isset($_SESSION['email']) ? $_SESSION['email'] : "", $vino[0]['ID_Prodotto']); ?>
        <?php if ($isPref[0]["is_favorite"] != 0): ?>
          <span class="bi bi-heart-fill text-dark" role="img" aria-label="icona cuore pieno"
          onclick="removeFavorite('<?php echo $vino[0]['ID_Prodotto']; ?>', this)"></span>
        <?php else: ?>
          <?php if(isset($_SESSION['email'])): ?>
          <span class="bi bi-heart text-dark" role="img" aria-label="icona cuore"
          onclick="addFavorite('<?php echo $vino[0]['ID_Prodotto']; ?>', this)"></span>
          <?php else: ?>
            <span class="bi bi-heart text-dark" role="img" aria-label="icona cuore"
            onclick="window.location.href='login.php';"></span>
          <?php endif; ?>
        <?php endif; ?>
      </button>
    </div>
    <div class="col-12 col-md-6 mx-auto text-center">
      <h1 class="h4 mt-4"><?php echo $vino[0]["Titolo_Prodotto"] ?></h1>
      <p><?php echo $vino[0]["Sottotitolo"] ?></p>
      <p class="fw-bold fs-5"><?php  echo number_format($vino[0]["Prezzo"], 2, ',', '.')."€";  ?></p>
      <div class="row justify-content-center align-items-center mb-3">
        <div class="col-auto d-inline-flex align-items-center">
          <button class="btn btn-outline-secondary rounded-circle text-dark fw-bold">-</button>
          <label for="quantity" class="visually-hidden"><?php echo $linguaAttuale == "en" ? "Quantity to add to cart" : "Quantità da aggiungere al carrello" ?></label>
          <input type="number" value="2" min="1" class="form-control text-center fw-bold mx-2" id="quantity" name="quantity" readonly />
          <button class="btn btn-outline-secondary rounded-circle text-dark fw-bold">+</button>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-6 col-md-4 pt-2">
          <button class="btn btn-dark w-100"><?php echo $linguaAttuale == "en" ? "Add to cart" : "Aggiungi al carrello" ?></button>
        </div>
      </div>
      <h2 class="h5 mt-3 pt-2 mb-3 pb-2"><?php echo $linguaAttuale == "en" ? "Features" : "Caratteristiche" ?></h2>
      <p><?php echo $vino[0]["Descrizione"] ?></p>
    </div>
    <div class="modal fade" id="confirmRemoveModal" tabindex="-1" aria-labelledby="confirmRemoveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmRemoveLabel"><?php echo $linguaAttuale == "en" ? "Remove Favorite" : "Rimuovi Preferito"; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo $linguaAttuale == "en" ? "Are you sure you want to remove this product from your favorites?" : "Sei sicuro di voler rimuovere questo prodotto dai preferiti?"; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $linguaAttuale == "en" ? "Cancel" : "Annulla"; ?></button>
            <button type="button" class="btn btn-danger" id="confirmRemoveButton"><?php echo $linguaAttuale == "en" ? "Remove" : "Rimuovi"; ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
