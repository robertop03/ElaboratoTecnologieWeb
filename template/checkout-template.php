<div class="container checkout my-4">
  <div class="indirizzo">
    <div class="row mb-4">
      <div class="col-md-6">
        <h4><?php echo $linguaAttuale == "en" ? "Shipping addresses" : "Indirizzi di spedizione"; ?></h4>
        <div class="card p-3 bg-light">
          <?php if (!empty($templateParams["addresses"])): ?>
            <?php 
                $firstAddress = $templateParams["addresses"][0];
                echo "<p>{$firstAddress["Via"]} {$firstAddress["Numero_Civico"]}<br />
                      {$firstAddress["CAP"]} {$firstAddress["Citta"]}<br />
                      {$firstAddress["Paese"]}</p>";
            ?>
            <a href="#" class="custom-link" id="use-address">
                <?php echo $linguaAttuale == "en" ? "Use this address" : "Usa questo indirizzo"; ?>
            </a>
            <a href="#" class="custom-link" data-bs-toggle="modal" data-bs-target="#addressModal">
                <?php echo $linguaAttuale == "en" ? "Choose which address to use" : "Scegli quale indirizzo usare"; ?>
            </a>
          <?php else: ?>
            <p><?php echo $linguaAttuale == "en" ? "No saved address" : "Nessun indirizzo salvato"; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="checkout-box p-4">
      <h4><?php echo $linguaAttuale == "en" ? "Shipping details" : "Dettagli della spedizione" ?></h4>
      <!-- Modulo di Checkout -->
      <form>
        <div class="mb-3 nome">
          <label for="nomeCognome" class="form-label"><?php echo $linguaAttuale == "en" ? "Name and surname" : "Nome e cognome" ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="nomeCognome" placeholder="Mario Rossi" required />
        </div>
        <div class="mb-3 indirizzo">
          <label for="indirizzo" class="form-label"><?php echo $linguaAttuale == "en" ? "Address" : "Indirizzo" ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="indirizzo" placeholder="Via Chiossetto 1" required />
        </div>
        <div class="mb-3 presso">
          <label for="presso" class="form-label"><?php echo $linguaAttuale == "en" ? "At" : "Presso" ?></label>
          <input type="text" class="form-control" id="presso" placeholder="Studio Associato Rossi" />
        </div>
        <div class="row">
          <div class="col-md-4 mb-3 cap">
            <label for="cap" class="form-label"><?php echo $linguaAttuale == "en" ? "ZIP code" : "CAP" ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cap" placeholder="20121" required />
          </div>
          <div class="col-md-8 mb-3 comune">
            <label for="comune" class="form-label"><?php echo $linguaAttuale == "en" ? "Municipality" : "Comune" ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="comune" placeholder="Milano" required />
          </div>
        </div>
        <div class="row">
        <div class="col-md-6 mb-3 provincia">
          <label for="provincia" class="form-label">
            <?php echo $linguaAttuale == "en" ? "Province" : "Provincia"; ?>
            <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="provincia" required>
            <option selected disabled>
              <?php echo $linguaAttuale == "en" ? "Select the province" : "Seleziona la provincia"; ?>
            </option>
            <?php foreach ($province as $sigla => $nome): ?>
              <option value="<?php echo htmlspecialchars($sigla); ?>">
                <?php echo htmlspecialchars($nome); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6 mb-3 telefono">
          <label for="telefono" class="form-label"><?php echo $linguaAttuale == "en" ? "Telephone number" : "Numero di telefono" ?><span class="text-danger">*</span></label>
          <input type="tel" class="form-control" id="telefono" placeholder="333 1234567" required />
        </div>
      </form>
    </div>
  </div>

  <!-- Modale indirizzi -->
  <div class="modal fade address-modal" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $linguaAttuale == "en" ? "Select Delivery Address" : "Seleziona un indirizzo di spedizione"; ?></h5>
          <button type="button" class="btn-close close-modal-class" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if (!empty($templateParams["addresses"])): ?>
            <?php foreach ($templateParams["addresses"] as $address): ?>
              <div 
                class="card p-3 selectable-address card-class"
                data-info="<?php echo htmlspecialchars("{$address['Via']} {$address['Numero_Civico']}, {$address['CAP']} {$address['Citta']}, {$address['Paese']}"); ?>"
              >
                <p>
                  <?php echo "{$address['Via']} {$address['Numero_Civico']}<br />{$address['CAP']} {$address['Citta']}<br />{$address['Paese']}"; ?>
                </p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p><?php echo $linguaAttuale == "en" ? "No addresses available." : "Nessun indirizzo disponibile."; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <hr class="mt-4" />

  <!-- SEZIONE DETTAGLI PAGAMENTO CARTA -->
  <div class="carte">
    <div class="row mb-4">
      <div class="col-md-6">
        <h4><?php echo $linguaAttuale == "en" ? "Credit cards" : "Carte di credito" ?></h4>
        <div class="card p-3 bg-light">
          <?php if (!empty($templateParams["paymentMethods"])): ?>
            <?php 
                $firstCard = $templateParams["paymentMethods"][0];
                echo "<p>**** **** **** " . substr($firstCard["Numero_Carta"], -4) . "<br />
                      Scadenza: {$firstCard["mese_scadenza"]}/{$firstCard["anno_scadenza"]}</p>";
            ?>
            <a href="#" class="custom-link" id="use-credit-card">
                <?php echo $linguaAttuale == "en" ? "Use this credit card" : "Usa questa carta"; ?>
            </a>
            <a href="#" class="custom-link" data-bs-toggle="modal" data-bs-target="#creditCardModal">
                <?php echo $linguaAttuale == "en" ? "Choose which credit card to use" : "Scegli quale carta di credito usare"; ?>
            </a>
          <?php else: ?>
            <p><?php echo $linguaAttuale == "en" ? "No saved credit card" : "Nessuna carta di credito salvata"; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="checkout-box p-4">
      <h4><?php echo $linguaAttuale == "en" ? "Credit card details" : "Dettagli della carta di credito"; ?></h4>
      <form>
        <div class="mb-3 numero-carta">
          <label for="numeroCarta" class="form-label">
            <?php echo $linguaAttuale == "en" ? "Credit card number" : "Numero della carta di credito"; ?>
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" id="numeroCarta" placeholder="0000 0000 0000 0000" required />
        </div>
        <div class="row">
          <div class="col-md-6 mb-3 scadenza">
            <label for="meseScadenza" class="form-label"><?php echo $linguaAttuale == "en" ? "Expiration month" : "Mese di scadenza"; ?><span class="text-danger">*</span></label>
            <select class="form-select" id="meseScadenza" required>
              <option selected disabled>MM</option>
              <?php foreach (range(1, 12) as $month): ?>
                <option><?php echo str_pad($month, 2, "0", STR_PAD_LEFT); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 mb-3 scadenza">
            <label for="annoScadenza" class="form-label"><?php echo $linguaAttuale == "en" ? "Expiration year" : "Anno di scadenza"; ?><span class="text-danger">*</span></label>
            <select class="form-select" id="annoScadenza" required>
              <option selected disabled>YY</option>
              <?php foreach (range(date("Y"), date("Y") + 15) as $year): ?>
                <option><?php echo $year; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="mb-3 cvv">
          <label for="cvv" class="form-label"><?php echo $linguaAttuale == "en" ? "CVC" : "CVV"; ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="cvv" placeholder="000" required />
        </div>
      </form>
    </div>
  </div>

  <!-- Modale Carte -->
  <div class="modal fade card-modal" id="creditCardModal" tabindex="-1" aria-labelledby="creditCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $linguaAttuale == "en" ? "Select Credit Card" : "Seleziona una carta di credito"; ?></h5>
          <button type="button" class="btn-close close-modal-class" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if (!empty($templateParams["paymentMethods"])): ?>
            <?php foreach ($templateParams["paymentMethods"] as $card): ?>
              <div 
                class="card-item card-spacing selectable-card" 
                data-card-number="<?php echo htmlspecialchars($card['Numero_Carta']); ?>" 
                data-card-expiry="<?php echo htmlspecialchars($card['mese_scadenza']) . '/' . htmlspecialchars($card['anno_scadenza']); ?>" 
                data-card-cvv="<?php echo htmlspecialchars($card['CVV'] ?? ''); ?>">
                <p class="card-text">
                  **** **** **** <?php echo substr(htmlspecialchars($card["Numero_Carta"]), -4); ?><br />
                  <?php echo $linguaAttuale == "en" ? "Expiry:" : "Scadenza:"; ?> <?php echo htmlspecialchars($card["mese_scadenza"]) . "/" . htmlspecialchars($card["anno_scadenza"]); ?>
                </p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p><?php echo $linguaAttuale == "en" ? "No saved credit cards." : "Nessuna carta di credito salvata."; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <!-- JSON per gli indirizzi -->
  <script id="indirizzi-json" type="application/json">
      <?php echo json_encode($templateParams["addresses"]); ?>
  </script>

  <!-- JSON per le carte -->
  <script id="carte-json" type="application/json">
      <?php echo json_encode($templateParams["paymentMethods"]); ?>
  </script>

</div>

<script src="./js/checkout.js"></script>
