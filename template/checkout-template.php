<div class="container checkout my-4">
        <div class="indirizzo">
          <div class="row mb-4">
            <div class="col-md-6">
              <h4>Indirizzi di spedizione</h4>
              <div class="card p-3 bg-light">
                <p>Italia<br />Via esempio 123, 47039</p>
                <a href="#" class="custom-link" id="use-address">Usa questo indirizzo</a>
                <a href="#" class="custom-link" data-bs-toggle="modal" data-bs-target="#addressModal">Scegli quale indirizzo usare</a>
              </div>
            </div>
          </div>

          <div class="checkout-box p-4">
            <h3>Dettagli della spedizione</h3>
            <!-- Modulo di Checkout -->
            <form>
              <div class="mb-3 nome">
                <label for="nomeCognome" class="form-label">Nome e Cognome<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomeCognome" placeholder="Mario Rossi" required />
              </div>
              <div class="mb-3 indirizzo">
                <label for="indirizzo" class="form-label">Indirizzo<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="indirizzo" placeholder="Via Chiossetto 1" required />
              </div>
              <div class="mb-3 presso">
                <label for="presso" class="form-label">Presso<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="presso" placeholder="Studio Associato Rossi" />
              </div>
              <div class="row">
                <div class="col-md-4 mb-3 cap">
                  <label for="cap" class="form-label">CAP<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="cap" placeholder="20121" required />
                </div>
                <div class="col-md-8 mb-3 comune">
                  <label for="comune" class="form-label">Comune<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="comune" placeholder="Milano" required />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 provincia">
                  <label for="provincia" class="form-label">Provincia<span class="text-danger">*</span></label>
                  <select class="form-select" id="provincia" required>
                    <option selected disabled>Seleziona la provincia</option>
                    <option>MI</option>
                    <option>RM</option>
                    <option>TO</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3 telefono">
                  <label for="telefono" class="form-label">Telefono<span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="telefono" placeholder="333 1234567" required />
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Modale per scegliere un indirizzo -->
        <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Scegli un indirizzo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body-address">
                <!-- Lista di indirizzi salvati -->
                <div class="row g-2" id="address-list">
                  <div class="col-12">
                    <div class="card p-3 selectable-address" data-address="Mario Rossi|Via delle Rose, 10|10100|Torino">
                      <p class="mb-0">Mario Rossi<br />Via delle Rose, 10<br />10100 Torino</p>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card p-3 selectable-address" data-address="Luigi Verdi|Via Roma, 20|20100|Milano">
                      <p class="mb-0">Luigi Verdi<br />Via Roma, 20<br />20100 Milano</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4" />

        <!-- SEZIONE DETTAGLI PAGAMENTO CARTA -->
        <div class="carte">
          <div class="row mb-4">
            <div class="col-md-6">
              <h4>Carte di credito</h4>
              <div class="card p-3 bg-light">
                <p>VISA<br />**** **** **** 1234</p>
                <a href="#" class="custom-link" id="use-credit-card">Usa questa carta</a>
                <a href="#" class="custom-link" data-bs-toggle="modal" data-bs-target="#creditCardModal">Scegli quale carta usare</a>
              </div>
            </div>
          </div>

          <div class="checkout-box p-4">
            <h3>Dettagli della carta di credito</h3>
            <!-- Modulo per i dati della carta -->
            <form>
              <div class="mb-3 numero-carta">
                <label for="numeroCarta" class="form-label">Numero carta<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="numeroCarta" placeholder="0000 0000 0000 0000" required />
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 scadenza">
                  <label for="meseScadenza" class="form-label">Mese di scadenza<span class="text-danger">*</span></label>
                  <select class="form-select" id="meseScadenza" required>
                    <option selected disabled>MM</option>
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3 scadenza">
                  <label for="annoScadenza" class="form-label">Anno di scadenza<span class="text-danger">*</span></label>
                  <select class="form-select" id="annoScadenza" required>
                    <option selected disabled>YY</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                    <option>2030</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 cvv">
                <label for="cvv" class="form-label">CVV<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="cvv" placeholder="000 " required />
              </div>
            </form>
          </div>
        </div>

        <!-- Modale per scegliere una carta -->
        <div class="modal fade" id="creditCardModal" tabindex="-1" aria-labelledby="creditCardModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="creditCardModalLabel">Scegli una carta di credito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body-card">
                <!-- Lista delle carte salvate -->
                <div class="row g-2" id="credit-card-list">
                  <div class="col-12">
                    <div class="card p-3 selectable-card" data-card="VISA|1234123412341234|01/25|123">
                      <p class="mb-0">VISA<br />**** **** **** 1234<br />Scadenza: 01/25</p>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card p-3 selectable-card" data-card="MasterCard|5678567856785678|02/26|456">
                      <p class="mb-0">MasterCard<br />**** **** **** 5678<br />Scadenza: 02/26</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="custom-btn" data-bs-toggle="modal" data-bs-target="#orderModal">Completa l'ordine</button>

      <!-- Modale per confermare l'ordine -->
      <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="orderModalLabel">Conferma ordine</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h4>Ordine completato!</h4>
              <p class="fs-6">Il tuo ordine è stato preso in carico. Grazie per averci scelto per l'acquisto!</p>
            </div>
          </div>
        </div>
      </div>