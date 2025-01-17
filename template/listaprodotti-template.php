<?php
/*************************************************
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

$wines = $db->getAllVini( $lingua, $pmin, $pmax, $prov, $friz, $tona, $dime, $ordine ); ?>

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
        <h5 class="modal-title" id="filterModalLabel"><?php echo $linguaAttuale == "en" ? "Filter" : "Filtra" ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi modale filtraggio"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label"><?php echo $linguaAttuale == "en" ? "Price" : "Prezzo" ?></label>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-warning text-dark" id="priceMin">0€</span>
            <span class="badge bg-danger" id="priceMax">1000€</span>
          </div>
          <div class="position-relative">
            <!-- Singolo slider -->
            <div class="range-slider">
              <label for="sliderMin" class="visually-hidden">Slider prezzo minimo</label>
              <input type="range" class="form-range" min="0" max="1000" step="1" value="0" id="sliderMin" />
              <label for="sliderMax" class="visually-hidden">Slider prezzo massimo</label>
              <input type="range" class="form-range" min="0" max="1000" step="1" value="1000" id="sliderMax" />
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="categories" class="form-label"><?php echo $linguaAttuale == "en" ? "Categories" : "Categorie" ?></label>
          <select multiple class="form-select" id="categories">
            <option><?php echo $linguaAttuale == "en" ? "Red" : "Rossi" ?></option>
            <option><?php echo $linguaAttuale == "en" ? "White" : "Bianchi" ?></option>
            <option><?php echo $linguaAttuale == "en" ? "Rosè" : "Rosati" ?></option>
            <option><?php echo $linguaAttuale == "en" ? "Still" : "Fermi" ?></option>
            <option><?php echo $linguaAttuale == "en" ? "Sparkling" : "Frizzanti" ?></option>
          </select>
        </div>
        <div class="mb-3">
          <label for="regions" class="form-label"><?php echo $linguaAttuale == "en" ? "Regions" : "Regioni" ?></label>
          <select multiple class="form-select" id="regions">
            <option>Abruzzo</option>
            <option>Basilicata</option>
            <option>Calabria</option>
            <option>Campania</option>
            <option>Emilia-Romagna</option>
            <option>Friuli-Venezia Giulia</option>
            <option>Lazio</option>
            <option>Liguria</option>
            <option>Lombardia</option>
            <option>Marche</option>
            <option>Molise</option>
            <option>Piemonte</option>
            <option>Puglia</option>
            <option>Sardegna</option>
            <option>Sicilia</option>
            <option>Toscana</option>
            <option>Trentino-Alto Adige</option>
            <option>Umbria</option>
            <option>Valle d'Aosta</option>
            <option>Veneto</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="formato" class="form-label"><?php echo $linguaAttuale == "en" ? "Bottle size" : "Formato" ?></label>
          <select multiple class="form-select" id="formato">
            <option>0.375L</option>
            <option>0.5L</option>
            <option>0.75L</option>
            <option>1L</option>
            <option>1.5L</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"><?php echo $linguaAttuale == "en" ? "Apply filter" : "Applica filtro" ?></button>
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
          <?php echo $linguaAttuale == "en" ? "Order" : "Ordina"; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi Modale ordinamento"></button>
      </div>
      
      <form method="GET" action="">
        <div class="modal-body">
          <h6><?php echo $linguaAttuale == "en" ? "Price" : "Prezzo"; ?></h6>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sort" id="priceAsc" value="ascPrice"
              <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ascPrice') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="priceAsc">
              <?php echo $linguaAttuale == "en" ? "Ascending" : "Crescente"; ?>
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sort" id="priceDesc" value="descPrice"
              <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'descPrice') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="priceDesc">
              <?php echo $linguaAttuale == "en" ? "Descending" : "Decrescente"; ?>
            </label>
          </div>
        </div>

        <div class="modal-body">
          <h6><?php echo $linguaAttuale == "en" ? "Bottle size" : "Formato"; ?></h6>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sort" id="FormatAsc" value="ascFormato"
              <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ascFormato') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="FormatAsc">
              <?php echo $linguaAttuale == "en" ? "Ascending" : "Crescente"; ?>
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sort" id="FormatDesc" value="descFormato"
              <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'descFormato') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="FormatDesc">
              <?php echo $linguaAttuale == "en" ? "Descending" : "Decrescente"; ?>
            </label>
          </div>
        </div>

        <div class="modal-footer">
          <a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="btn btn-danger me-auto">
            <?php echo $linguaAttuale == "en" ? "Reset sorting" : "Resetta ordinamento"; ?>
          </a>
          <button type="submit" class="btn btn-primary">
            <?php echo $linguaAttuale == "en" ? "Apply sorting" : "Applica ordinamento"; ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Sezione dei prodotti / vini -->
<div class="row row-cols-2 row-cols-md-4 g-3">
  <?php if (!empty($wines)): ?>
  <?php foreach ($wines as $vino): ?>
  <div class="col">
    <a href="prodotto.php?id=<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>">
    <div class="card h-100 text-center">
      <img src="<?php echo "resources/img/".htmlspecialchars($vino['Foto'] ?? 'vino_generic.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?>" />
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
    </a>
  </div>
  <?php endforeach; ?>
  <?php else: ?>
  <!-- Se non ci sono vini da mostrare -->
  <p class="text-center">
    <?php echo $linguaAttuale == "en" ? "No products found." : "Nessun prodotto trovato."; ?>
  </p>
  <?php endif; ?>
</div>
