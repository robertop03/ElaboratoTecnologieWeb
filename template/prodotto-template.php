<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6 text-center position-relative">
      <img src="resources/img/<?php echo $vino[0]["Foto"] ?>" alt="<?php echo $vino[0]["Titolo_Prodotto"] ?>" class="img-fluid rounded shadow product"/>
      <button class="btn btn-light position-absolute top-0 end-0 m-2 border rounded-circle">
        <span class="bi bi-heart" role="img" aria-label="icona cuore"></span>
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
  </div>
</div>
