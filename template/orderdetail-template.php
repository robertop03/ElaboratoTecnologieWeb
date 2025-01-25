<?php
// dettagli_ordine.php

$idOrdine = isset($_GET['id']) ? $_GET['id'] : '';

if ($idOrdine === '') {
    die("ID Ordine non valido (manca o è vuoto).");
}

// 2. Recupera i dati dell'ordine dal database
$orderInfo  = $db->getOrderInfo($idOrdine);  // es.: ID, Data, Stato, Email, Totale, Indirizzo, Metodo di pagamento
$orderItems = $db->getOrderItems($idOrdine); // es.: ID_Prodotto, Titolo, Prezzo, Quantità

// 3. Se l'ordine non esiste, mostra errore
if (!$orderInfo) {
    die("Ordine non trovato.");
}

// 4. Mappa lo stato numerico -> testo
$stato = '';
switch ($orderInfo['Stato']) {
    case '0':
        $stato = 'ordine confermato';
        break;
    case '1':
        $stato = 'ordine spedito';
        break;
    case '2':
        $stato = 'ordine consegnato';
        break;
    default:
        $stato = 'sconosciuto';
}

?>
<div class="container my-4">
  <a href="javascript:history.back()" class="btn btn-secondary btn-lg">
    <span class="bi bi-arrow-left text-light">Back</span>
  </a>
  <h4>Dettagli Ordine</h4>

  <div class="row">
    <!-- Riquadro sinistra: Indirizzo di consegna -->
    <div class="col-md-4">
      <div class="border p-3 mb-3">
        <h5>Indirizzo di consegna</h5>
        <?php if (!empty($orderInfo['Via'])): ?>
          <p>
            <?php echo htmlspecialchars($orderInfo['Via'] . ' ' . $orderInfo['Numero_Civico']); ?><br>
            <?php echo htmlspecialchars($orderInfo['CAP'] . ' ' . $orderInfo['Citta']); ?><br>
            <?php echo htmlspecialchars($orderInfo['Paese']); ?>
          </p>
        <?php else: ?>
          <p>Nessun indirizzo associato.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Riquadro centro: Metodo di pagamento -->
    <div class="col-md-4">
      <div class="border p-3 mb-3">
        <h5>Metodo di pagamento</h5>
        <?php if (!empty($orderInfo['Numero_Carta'])): ?>
          <p>
            Carta n. <?php echo htmlspecialchars($orderInfo['Numero_Carta']); ?><br>
            Scadenza:
            <?php echo htmlspecialchars($orderInfo['mese_scadenza'] . '/' . $orderInfo['anno_scadenza']); ?>
          </p>
        <?php else: ?>
          <p>Nessun metodo di pagamento associato.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Riquadro destra: Dettagli ordine (ID, Email, Data, Stato) -->
    <div class="col-md-4">
      <div class="border p-3 mb-3">
        <h5>Dettagli ordine</h5>
        <p>
          <strong>ID Ordine:</strong> <?php echo htmlspecialchars($orderInfo['ID_Ordine']); ?><br>
          <strong>Email:</strong> <?php echo htmlspecialchars($orderInfo['Email']); ?><br>
          <strong>Data:</strong> <?php echo htmlspecialchars($orderInfo['Data']); ?><br>
          <strong>Stato:</strong> <?php echo htmlspecialchars($stato); ?><br>
        </p>
      </div>
    </div>
  </div>

  <!-- In basso: Tabella prodotti -->
  <div class="row">
    <div class="col-12">
      <div class="border p-3">
        <h5>Prodotti nell'ordine</h5>
        <?php if (!empty($orderItems)): ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID Prodotto</th>
                  <th>Titolo</th>
                  <th>Prezzo</th>
                  <th>Quantità</th>
                  <th>Subtotale</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $totProdotti = 0;
                foreach ($orderItems as $item):
                    $sub = $item['Prezzo'] * $item['Quantità'];
                    $totProdotti += $sub;
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($item['ID_Prodotto']); ?></td>
                    <td><?php echo htmlspecialchars($item['Titolo']); ?></td>
                    <td><?php echo number_format($item['Prezzo'], 2, ',', '.')." €"; ?></td>
                    <td><?php echo htmlspecialchars($item['Quantità']); ?></td>
                    <td><?php echo number_format($sub, 2, ',', '.')." €"; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <?php 
            // Calcolo della spedizione
            $costoSpedizione = $totProdotti > 69 ? 0 : 7.75;
            $totaleOrdine = $totProdotti + $costoSpedizione;
          ?>

          <p><strong>Totale prodotti:</strong> <?php echo number_format($totProdotti, 2, ',', '.')." €"; ?></p>
          <p><strong>Spedizione:</strong> 
            <?php 
              echo $costoSpedizione == 0 
                ? "Gratis" 
                : number_format($costoSpedizione, 2, ',', '.')." €"; 
            ?>
          </p>
          <p><strong>Totale ordine:</strong> 
            <?php echo number_format($totaleOrdine, 2, ',', '.')." €"; ?>
          </p>

        <?php else: ?>
          <p>Nessun prodotto per questo ordine.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
