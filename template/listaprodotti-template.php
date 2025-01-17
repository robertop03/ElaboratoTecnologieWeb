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
      <form method="GET" action="">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label"><?php echo $linguaAttuale == "en" ? "Price" : "Prezzo" ?></label>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge bg-warning text-dark" id="priceMin">0€</span>
              <span class="badge bg-danger" id="priceMax">100€</span>
            </div>
            <div class="position-relative">
              <!-- Singolo slider -->
              <div class="range-slider">
                <label for="sliderMin" class="visually-hidden">Slider prezzo minimo</label>
                <input type="range" class="form-range" min="0" max="100" step="" value="0" id="sliderMin" name="pmin" />
                <label for="sliderMax" class="visually-hidden">Slider prezzo massimo</label>
                <input type="range" class="form-range" min="0" max="100" step="1" value="100" id="sliderMax" name="pmax" />
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="tonalita" class="form-label"><?php echo $linguaAttuale == "en" ? "Hue" : "Tonalità" ?></label>
            <select multiple class="form-select" id="tonalita" name="tona">
              <option value="rosso"><?php echo $linguaAttuale == "en" ? "Red" : "Rossi" ?></option>
              <option value="bianco"><?php echo $linguaAttuale == "en" ? "White" : "Bianchi" ?></option>
              <option value="rosè"><?php echo $linguaAttuale == "en" ? "Rosè" : "Rosati" ?></option>
            </select>
          </div>
          <div class="mb-3">
            <label for="frizzantezza" class="form-label"><?php echo $linguaAttuale == "en" ? "Effervescence" : "Frizzantezza" ?></label>
            <select multiple class="form-select" id="frizzantezza" name="friz">
              <option value="fermo"><?php echo $linguaAttuale == "en" ? "Still" : "Fermi" ?></option>
              <option value="frizzante"><?php echo $linguaAttuale == "en" ? "Sparkling" : "Frizzanti" ?></option>
            </select>
          </div>
          <div class="mb-3">
            <label for="regions" class="form-label"><?php echo $linguaAttuale == "en" ? "Regions" : "Regioni" ?></label>
            <select multiple class="form-select" id="regions" name="prov">
              <option value="Abruzzo" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Abruzzo' ? 'selected' : ''; ?> >Abruzzo</option>
              <option value="Basilicata" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Basilicata' ? 'selected' : ''; ?> >Basilicata</option>
              <option value="Calabria" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Calabria' ? 'selected' : ''; ?> >Calabria</option>
              <option value="Campania" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Campania' ? 'selected' : ''; ?> >Campania</option>
              <option value="Emilia Romagna" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Emilia Romagna' ? 'selected' : ''; ?> >Emilia Romagna</option>
              <option value="Friuli Venezia Giulia" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Friuli Venezia Giulia' ? 'selected' : ''; ?> >Friuli Venezia Giulia</option>
              <option value="Lazio" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Lazio' ? 'selected' : ''; ?> >Lazio</option>
              <option value="Liguria" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Liguria' ? 'selected' : ''; ?> >Liguria</option>
              <option value="Lombardia" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Lombardia' ? 'selected' : ''; ?> >Lombardia</option>
              <option value="Marche" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Marche' ? 'selected' : ''; ?> >Marche</option>
              <option value="Molise" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Molise' ? 'selected' : ''; ?> >Molise</option>
              <option value="Piemonte" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Piemonte' ? 'selected' : ''; ?> >Piemonte</option>
              <option value="Puglia" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Puglia' ? 'selected' : ''; ?> >Puglia</option>
              <option value="Sardegna" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Sardegna' ? 'selected' : ''; ?> >Sardegna</option>
              <option value="Sicilia" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Sicilia' ? 'selected' : ''; ?> >Sicilia</option>
              <option value="Toscana" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Toscana' ? 'selected' : ''; ?> >Toscana</option>
              <option value="Trentino Alto Adige" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Trentino Alto Adige' ? 'selected' : ''; ?> >Trentino Alto Adige</option>
              <option value="Umbria" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Umbria' ? 'selected' : ''; ?> >Umbria</option>
              <option value="Valle d'Aosta" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Valle d\'Aosta' ? 'selected' : ''; ?> >Valle d'Aosta</option>
              <option value="Veneto" <?php echo isset($_GET['prov']) && $_GET['prov'] == 'Veneto' ? 'selected' : ''; ?> >Veneto</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="formato" class="form-label"><?php echo $linguaAttuale == "en" ? "Bottle size" : "Formato" ?></label>
            <select multiple class="form-select" id="formato" name="dime">
              <option value="Mezza 0.375l">0.375L</option>
              <option value="Bottiglia 0.75l">0.75L</option>
              <option value="Magnum 1.5l">1.5L</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><?php echo $linguaAttuale == "en" ? "Apply filter" : "Applica filtro" ?></button>
        </div>
      </form>
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
        <?php
        $queryParams = $_GET;
        unset($queryParams['sort']);
        foreach ($queryParams as $key => $value): ?>
            <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endforeach; ?>
        
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
        
        <?php
            // Ricostruisci l'URL senza il parametro 'sort'
            $queryParams = $_GET;
            unset($queryParams['sort']);
            $resetUrl = strtok($_SERVER["REQUEST_URI"], '?');
            if (!empty($queryParams)) {
                $resetUrl .= '?' . http_build_query($queryParams);
            }
        ?>
        <div class="modal-footer">
            <a href="<?php echo htmlspecialchars($resetUrl); ?>" class="btn btn-danger me-auto">
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
