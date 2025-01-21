<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$perPage = 5;
$offset = ($page - 1) * $perPage;

$totalWines = $db->getTotalWineCount();
$totalPages = ceil($totalWines / $perPage);

$vini = $db->getWinesPaginated($perPage, $offset);
?>

<div class="container my-4">
  <h2 class="mt-3">Lista Vini</h2>
  <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiVinoModal">Aggiungi Vino</button>
  <?php if ($totalWines > 0): ?>
    <p>Vini trovati: <?php echo $totalWines; ?></p>

    <!-- Tabella vini -->
    <div class="table-responsive">
      <table class="table table-bordered" id="wine-table">
        <thead>
          <tr>
            <th>ID Prodotto</th>
            <th>Quantità Magazzino</th>
            <th>Titolo Prodotto</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($vini as $vino): ?>
            <tr id="vino-<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>">
                <td><?php echo htmlspecialchars($vino['ID_Prodotto']); ?></td>
                <td><?php echo htmlspecialchars($vino['Quantita_Magazzino']); ?></td>
                <td><?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?></td>
                <td class="text-end">
                <div class="d-inline-flex gap-2">
                    <!-- Bottone modifica quantità -->
                    <button class="btn btn-warning btn-modifica-quantita" data-id="<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>" data-bs-toggle="modal" data-bs-target="#modificaQuantitaModal">
                      Modifica quantità
                    </button>
                    <!-- Bottone modifica prodotto -->
                    <button class="btn btn-primary btn-modifica-prodotto" 
                            data-id="<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>" 
                            data-bs-toggle="modal" 
                        data-bs-target="#modificaProdottoModal">
                        Modifica prodotto
                    </button>
                </div>
            </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Paginazione -->
    <nav>
      <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <?php $active = ($i === $page) ? 'active' : ''; ?>
          <li class="page-item <?php echo $active; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php else: ?>
    <p>Nessun vino trovato.</p>
  <?php endif; ?>
</div>

<!-- Modale per modificare la quantità -->
<div class="modal fade" id="modificaQuantitaModal" tabindex="-1" aria-labelledby="modificaQuantitaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modificaQuantitaModalLabel">Modifica Quantità</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="modificaQuantitaForm" action="api/modifica-quantita-vino.php" method="POST">
        <div class="modal-body">
          <input type="hidden" id="vinoId" name="vinoId">
          <div class="mb-3">
            <label for="nuovaQuantita" class="form-label">Nuova Quantità</label>
            <input type="number" class="form-control" id="nuovaQuantita" name="nuovaQuantita" min="0" step="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modale per modificare prodotto -->
<div class="modal fade" id="modificaProdottoModal" tabindex="-1" aria-labelledby="modificaProdottoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modificaProdottoModalLabel">Modifica Prodotto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="modificaProdottoForm" action="api/update-product.php" method="POST">
        <div class="modal-body">
          <input type="hidden" id="modificaVinoId" name="vinoId">
          <div class="mb-3">
            <label for="modificaPrezzo" class="form-label">Prezzo</label>
            <input type="number" class="form-control" id="modificaPrezzo" name="prezzo" min="0" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="modificaQuantitaMagazzino" class="form-label">Quantità Magazzino</label>
            <input type="number" class="form-control" id="modificaQuantitaMagazzino" name="quantitaMagazzino" min="0" step="1" required>
          </div>
          <div class="mb-3">
            <label for="modificaFoto" class="form-label">Nome Foto</label>
            <input type="text" class="form-control" id="modificaFoto" name="foto" required>
          </div>
          <hr>
          <h6>Testo Italiano</h6>
          <div class="mb-3">
            <label for="modificaTitoloIT" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="modificaTitoloIT" name="titoloIT" required>
          </div>
          <div class="mb-3">
            <label for="modificaSottotitoloIT" class="form-label">Sottotitolo</label>
            <input type="text" class="form-control" id="modificaSottotitoloIT" name="sottotitoloIT" required>
          </div>
          <div class="mb-3">
            <label for="modificaDescrizioneIT" class="form-label">Descrizione</label>
            <textarea class="form-control" id="modificaDescrizioneIT" name="descrizioneIT" rows="3" required></textarea>
          </div>
          <hr>
          <h6>Testo Inglese</h6>
          <div class="mb-3">
            <label for="modificaTitoloEN" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="modificaTitoloEN" name="titoloEN" required>
          </div>
          <div class="mb-3">
            <label for="modificaSottotitoloEN" class="form-label">Sottotitolo</label>
            <input type="text" class="form-control" id="modificaSottotitoloEN" name="sottotitoloEN" required>
          </div>
          <div class="mb-3">
            <label for="modificaDescrizioneEN" class="form-label">Descrizione</label>
            <textarea class="form-control" id="modificaDescrizioneEN" name="descrizioneEN" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modale per aggiungere prodotto -->
<div class="modal fade" id="aggiungiVinoModal" tabindex="-1" aria-labelledby="aggiungiVinoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aggiungiVinoModalLabel">Aggiungi Nuovo Vino</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="aggiungiVinoForm" action="api/add-wine.php" method="POST">
        <div class="modal-body">
          <!-- Dati base del prodotto -->
          <div class="mb-3">
            <label for="prezzo" class="form-label">Prezzo</label>
            <input type="number" class="form-control" id="prezzo" name="prezzo" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="quantitaMagazzino" class="form-label">Quantità Magazzino</label>
            <input type="number" class="form-control" id="quantitaMagazzino" name="quantitaMagazzino" min="0" required>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Nome Foto</label>
            <input type="text" class="form-control" id="foto" name="foto" required>
          </div>
          <hr>
          <!-- Attributi -->
          <h6>Attributi</h6>
          <div class="mb-3">
            <label for="frizzantezza" class="form-label">Frizzantezza</label>
            <select class="form-select" id="frizzantezza" name="frizzantezza" required>
              <option value="A1">Frizzante</option>
              <option value="A2">Fermo</option>
              <option value="A3">Spumante</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tonalita" class="form-label">Tonalità</label>
            <select class="form-select" id="tonalita" name="tonalita" required>
              <option value="A4">Rosso</option>
              <option value="A5">Bianco</option>
              <option value="A6">Rosè</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="provenienza" class="form-label">Provenienza</label>
            <select class="form-select" id="provenienza" name="provenienza" required>
                <option value="A7">Abruzzo</option>
                <option value="A8">Basilicata</option>
                <option value="A9">Calabria</option>
                <option value="A10">Campania</option>
                <option value="A11">Emilia Romagna</option>
                <option value="A12">Friuli Venezia Giulia</option>
                <option value="A13">Lazio</option>
                <option value="A14">Liguria</option>
                <option value="A15">Lombardia</option>
                <option value="A16">Marche</option>
                <option value="A17">Molise</option>
                <option value="A18">Piemonte</option>
                <option value="A19">Puglia</option>
                <option value="A20">Sardegna</option>
                <option value="A21">Sicilia</option>
                <option value="A22">Toscana</option>
                <option value="A23">Trentino Alto Adige</option>
                <option value="A24">Umbria</option>
                <option value="A25">Valle d'Aosta</option>
                <option value="A26">Veneto</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="dimensioneBottiglia" class="form-label">Dimensione Bottiglia</label>
            <select class="form-select" id="dimensioneBottiglia" name="dimensioneBottiglia" required>
              <option value="A27">Bottiglia 0.75l</option>
              <option value="A28">Magnum 1.5l</option>
              <option value="A29">Mezza 0.375l</option>
            </select>
          </div>
          <hr>
          <!-- Testo Italiano -->
          <h6>Testo Italiano</h6>
          <div class="mb-3">
            <label for="titoloIT" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titoloIT" name="titoloIT" required>
          </div>
          <div class="mb-3">
            <label for="sottotitoloIT" class="form-label">Sottotitolo</label>
            <input type="text" class="form-control" id="sottotitoloIT" name="sottotitoloIT" required>
          </div>
          <div class="mb-3">
            <label for="descrizioneIT" class="form-label">Descrizione</label>
            <textarea class="form-control" id="descrizioneIT" name="descrizioneIT" rows="3" required></textarea>
          </div>
          <hr>
          <!-- Testo Inglese -->
          <h6>Testo Inglese</h6>
          <div class="mb-3">
            <label for="titoloEN" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titoloEN" name="titoloEN" required>
          </div>
          <div class="mb-3">
            <label for="sottotitoloEN" class="form-label">Sottotitolo</label>
            <input type="text" class="form-control" id="sottotitoloEN" name="sottotitoloEN" required>
          </div>
          <div class="mb-3">
            <label for="descrizioneEN" class="form-label">Descrizione</label>
            <textarea class="form-control" id="descrizioneEN" name="descrizioneEN" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <button type="submit" class="btn btn-primary">Aggiungi Vino</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-quantita").forEach(button => {
        button.addEventListener("click", function () {
            const vinoId = this.dataset.id;
            document.getElementById("vinoId").value = vinoId;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-prodotto").forEach(button => {
        button.addEventListener("click", function () {
            const vinoId = this.dataset.id;

            // Esegui una chiamata AJAX per ottenere i dettagli del vino
            fetch(`api/get-wine-details.php?id=${vinoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("modificaVinoId").value = vinoId;
                        document.getElementById("modificaPrezzo").value = data.vino.Prezzo;
                        document.getElementById("modificaQuantitaMagazzino").value = data.vino.Quantita_Magazzino;
                        document.getElementById("modificaFoto").value = data.vino.Foto;
                        document.getElementById("modificaTitoloIT").value = data.vino.Titolo_IT;
                        document.getElementById("modificaSottotitoloIT").value = data.vino.Sottotitolo_IT;
                        document.getElementById("modificaDescrizioneIT").value = data.vino.Descrizione_IT;
                        document.getElementById("modificaTitoloEN").value = data.vino.Titolo_EN;
                        document.getElementById("modificaSottotitoloEN").value = data.vino.Sottotitolo_EN;
                        document.getElementById("modificaDescrizioneEN").value = data.vino.Descrizione_EN;
                    } else {
                        alert("Errore: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Errore nella richiesta:", error);
                });
        });
    });
});

</script>
