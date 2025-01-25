<section class="shopping-bag-summary">
  <!-- Messaggio informativo sulla spedizione -->
  <aside class="shipping-message" aria-live="polite">
    <p class="message-content" id="message-content">
      <!-- Questo contenuto sarà dinamico con JS -->
    </p>
  </aside>

  <!-- Bottone per rimuovere tutti i prodotti -->
  <button id="clear-cart" class="clear-cart" aria-label="Elimina tutti i prodotti">
    <span class="bi bi-trash fs-5 ms-3 mb-3" aria-label="Elimina tutti i prodotti">
      <?php echo $linguaAttuale == "en" ? "Delete all products" : "Elimina tutti i prodotti" ?>
    </span>
  </button>
</section>

<div class="cart-container">
  <!-- CARRELLO VUOTO -->
  <div id="cart-empty" class="cart-state empty">
    <h2><?php echo $linguaAttuale == "en" ? "Your shopping bag is empty" : "La tua shopping bag è vuota" ?></h2>
    <img src="resources/img/emptyCart.svg" alt="Carrello vuoto" />
    <p><?php echo $linguaAttuale == "en" ? "You haven't added any products to your bag yet!" : "Non hai ancora aggiunto nessun prodotto alla tua bag!" ?></p>
    <button class="btn btn-dark mt-2" onclick="window.location.href='listaprodotti.php'">
      <?php echo $linguaAttuale == "en" ? "Start the shopping" : "Inizia lo shopping" ?>
    </button>
  </div>

  <!-- CARRELLO CON PRODOTTI -->
  <div id="cart-full" class="cart-state full">
    <h3><?php echo $linguaAttuale == "en" ? "Your shopping bag" : "La tua shopping bag" ?></h3>
    <ul id="cart-items">
      <!-- Gli elementi saranno caricati dinamicamente da cart.js -->
    </ul>
  </div>

  <!-- RIASSUNTO ORDINE -->
  <aside id="order-summary" class="order-summary">
    <h4><?php echo $linguaAttuale == "en" ? "Order summary" : "Riassunto dell'ordine" ?></h4>
    <div class="summary-item">
      <span><?php echo $linguaAttuale == "en" ? "Subtotal:" : "Subtotale:" ?></span>
      <strong id="subtotal-price">€0,00</strong>
    </div>
    <div class="summary-item">
      <span><?php echo $linguaAttuale == "en" ? "Shipping:" : "Spedizione:" ?></span>
      <strong id="shipping-price">€0,00</strong>
    </div>
    <div class="total">
      <?php echo $linguaAttuale == "en" ? "Total:" : "Totale:" ?>
      <strong id="total-price">€0,00</strong>
    </div>
    <button class="btn btn-dark w-100 mt-2" id="checkout-button" onclick="window.location.href='checkout.php'">
      <?php echo $linguaAttuale == "en" ? "Proceed to checkout" : "Procedi al checkout" ?>
    </button>
  </aside>
</div>
