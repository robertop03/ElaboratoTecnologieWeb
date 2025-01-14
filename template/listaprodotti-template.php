<?php
/*************************************************
 * Pagina vini.php
 * Legge i filtri di GET per:
 *  - pmin, pmax
 *  - prov (Provenienza)
 *  - friz (Frizzantezza)
 *  - tona (Tonalità)
 *  - dime (Capacita_Bottiglia)
 *  - sort (ascPrice, descPrice, ascFormato, descFormato)
 * e mostra i vini usando il template fornito.
 *************************************************/

// 1. Lettura dei parametri GET con fallback ai default
$pmin  = isset($_GET['pmin'])  ? (float) $_GET['pmin']  : 0; // Prezzo minimo
$pmax  = isset($_GET['pmax'])  ? (float) $_GET['pmax']  : 10000; // Prezzo massimo
$prov  = isset($_GET['prov'])  ? $_GET['prov']         : '%'; // Provenienza
$friz  = isset($_GET['friz'])  ? $_GET['friz']         : '%'; // Frizzantezza
$tona  = isset($_GET['tona'])  ? $_GET['tona']         : '%'; // Tonalità
$dime  = isset($_GET['dime'])  ? $_GET['dime']         : '%'; // Capacità bottiglia
$sort  = isset($_GET['sort'])  ? $_GET['sort']         : ''; // Ordinamento

// 1 = italiano, 2 = inglese
$lingua = ($linguaAttuale === "en") ? 2 : 1;


switch ($sort) {
  case 'ascPrice':
    $ordine = "price_asc";           
    break;
  case 'descPrice':
    $ordine = "price_desc";
    break;
  case 'ascFormato':
    $ordine = "cap_asc";
    break;
  case 'descFormato':
    $ordine = "cap_desc";
    break;
  default:
    $ordine = ""; // Nessun ordinamento
    break;
}

$wines = $db->getAllVini(
  $lingua,
  $pmin,
  $pmax,
  $prov,
  $friz,
  $tona,
  $dime,
  $ordine
);

?>

<div class="d-flex justify-content-center gap-3">
  <button class="btn btn-dark text-white mb-3 btn-lg w-100" data-bs-toggle="modal" data-bs-target="#filterModal">
    <?php echo $linguaAttuale == "en" ? "Filter" : "Filtra" ?>
  </button>
  <button class="btn btn-dark text-white mb-3 btn-lg w-100" data-bs-toggle="modal" data-bs-target="#sortModal">
    <?php echo $linguaAttuale == "en" ? "Order" : "Ordina" ?>
  </button>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">
          <?php echo $linguaAttuale == "en" ? "Filter" : "Filtra" ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi modale filtraggio"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">
            <?php echo $linguaAttuale == "en" ? "Price" : "Prezzo" ?>
          </label>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-warning text-dark" id="priceMin">0€</span>
            <span class="badge bg-danger" id="priceMax">1000€</span>
          </div>
          <div class="position-relative">
            <div class="range-slider">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <?php echo $linguaAttuale == "en" ? "Close" : "Chiudi" ?>
        </button>
        <button type="button" class="btn btn-primary">
          <?php echo $linguaAttuale == "en" ? "Apply filter" : "Applica filtro" ?>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Sort Modal -->
<div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sortModalLabel">
          <?php echo $linguaAttuale == "en" ? "Order" : "Ordina" ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi Modale ordinamento"></button>
      </div>
      <div class="modal-body">
        <h6><?php echo $linguaAttuale == "en" ? "Price" : "Prezzo" ?></h6>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sortOptions" id="priceAsc" value="ascPrice" />
          <label class="form-check-label" for="priceAsc">
            <?php echo $linguaAttuale == "en" ? "Ascending" : "Crescente" ?>
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sortOptions" id="priceDesc" value="descPrice" />
          <label class="form-check-label" for="priceDesc">
            <?php echo $linguaAttuale == "en" ? "Descending" : "Decrescente" ?>
          </label>
        </div>
      </div>
      <div class="modal-body">
        <h6><?php echo $linguaAttuale == "en" ? "Bottle size" : "Formato" ?></h6>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sortOptions" id="FormatAsc" value="ascFormato" />
          <label class="form-check-label" for="FormatAsc">
            <?php echo $linguaAttuale == "en" ? "Ascending" : "Crescente" ?>
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sortOptions" id="FormatDesc" value="descFormato" />
          <label class="form-check-label" for="FormatDesc">
            <?php echo $linguaAttuale == "en" ? "Descending" : "Decrescente" ?>
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <?php echo $linguaAttuale == "en" ? "Close" : "Chiudi" ?>
        </button>
        <button type="button" class="btn btn-primary">
          <?php echo $linguaAttuale == "en" ? "Apply sorting" : "Applica ordinamento" ?>
        </button>
      </div>
    </div>
  </div>
</div>

<!--Sezione dei prodotti / vini -->
<div class="row row-cols-2 row-cols-md-4 g-3">
  <?php if (!empty($wines)): ?>
    <?php foreach ($wines as $vino): ?>
      <div class="col">
        <div class="card h-100 text-center">
          <img 
            src="<?php echo "resources/img/".htmlspecialchars($vino['Foto'] ?? 'vino_generic.jpg'); ?>"
            class="card-img-top"
            alt="<?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?>"
          />
          <div class="card-body">
            <h5 class="card-title">
              <?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?>
            </h5>
            <p class="fs-6 mb-0">
              <?php echo htmlspecialchars($vino['Provenienza'])." - ".htmlspecialchars($vino['Tonalita']);?>
            </p>
            <p class="fs-6">
              <?php echo htmlspecialchars($vino['Capacita_Bottiglia']); ?> 
            </p>
            <p class="card-text fw-bold">
              <?php 
                echo number_format($vino['Prezzo'], 2, ',', '.')."€"; 
              ?>
            </p>
          </div>
          <div class="card-footer bg-white border-0">
            <button class="btn-custom me-2">
              <span class="bi bi-cart text-dark" role="img" aria-label="icona carrello"></span>
            </button>
            <button class="btn-custom">
              <span class="bi bi-heart text-dark" role="img" aria-label="icona cuore"></span>
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <!-- Se non ci sono vini da mostrare -->
    <p class="text-center">
      <?php echo ($linguaAttuale == "en") ? "No products found." : "Nessun prodotto trovato."; ?>
    </p>
  <?php endif; ?>
</div>
