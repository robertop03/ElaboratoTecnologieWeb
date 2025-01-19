document.addEventListener("DOMContentLoaded", () => {
  const cartEmpty = document.querySelector("#cart-empty");
  const cartFull = document.querySelector("#cart-full");
  const cartItemsList = document.querySelector("#cart-items");
  const checkoutButton = document.querySelector("#checkout-button");
  const shippingMessageElement = document.querySelector(".shipping-message #message-content");
  const clearCartButton = document.querySelector("#clear-cart");

  const freeShippingThreshold = 69;

  // Funzioni per gestire i cookies
  function getCartFromCookie() {
    const cookie = document.cookie
      .split("; ")
      .find((row) => row.startsWith("cart="));
    return cookie ? JSON.parse(cookie.split("=")[1]) : [];
  }

  function saveCartToCookie(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400`;
  }

  // Funzione per chiamare l'API e ottenere i dettagli dei prodotti
  async function fetchProductDetails(cart) {
    const ids = cart.map((item) => item.id); // Estrai gli ID dal carrello

    const response = await fetch("/api/getProductDetails.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ ids }),
    });

    if (!response.ok) {
      console.error("Errore durante il recupero dei dettagli dei prodotti");
      return [];
    }

    return await response.json();
  }

  // Funzione per aggiornare la pagina
  async function refreshCart() {
    const cart = getCartFromCookie();
  
    if (cart.length === 0) {
      // Mostra il carrello vuoto
      updateCartState([]);
      return;
    }
  
    // Renderizza gli elementi del carrello
    renderCartItems(cart);
  
    // Aggiorna lo stato del carrello (empty/full) e il riassunto ordine
    updateCartState(cart);
    updateOrderSummary(cart);
  }

  function updateCartState(cart) {
    if (cart.length === 0) {
      cartEmpty.classList.add("active");
      cartFull.classList.remove("active");
      checkoutButton.disabled = true;
    } else {
      cartEmpty.classList.remove("active");
      cartFull.classList.add("active");
      checkoutButton.disabled = false;
    }
  }

  function renderCartItems(cart) {
    cartItemsList.innerHTML = ""; // Svuota la lista
  
    cart.forEach((item) => {
      const li = document.createElement("li");
      li.innerHTML = `
        <img src="${item.image}" alt="${item.name}" />
        <div>
          <h4>${item.name}</h4>
          <p>Prezzo: €${item.price.toFixed(2)}</p>
          <p>Quantità: 
            <button class="btn btn-sm btn-outline-secondary" data-action="decrease" data-id="${item.id}">-</button>
            <span>${item.quantity}</span>
            <button class="btn btn-sm btn-outline-secondary" data-action="increase" data-id="${item.id}">+</button>
          </p>
        </div>
        <button class="btn btn-sm btn-danger" data-action="remove" data-id="${item.id}">Rimuovi</button>
      `;
      cartItemsList.appendChild(li);
    });
  }

  function updateOrderSummary(cart, products) {
    const subtotal = cart.reduce((total, item) => {
      const productDetails = products.find((prod) => prod.ID_Prodotto == item.id);
      if (!productDetails) return total;

      return total + productDetails.Prezzo * item.quantity;
    }, 0);

    const shippingCost = subtotal >= freeShippingThreshold ? 0 : 7.75;

    document.querySelector("#subtotal-price").textContent = `€${subtotal.toFixed(2)}`;
    document.querySelector("#shipping-price").textContent =
      shippingCost === 0 ? "Gratuita" : `€${shippingCost.toFixed(2)}`;
    document.querySelector("#total-price").textContent = `€${(subtotal + shippingCost).toFixed(2)}`;

    shippingMessageElement.innerHTML =
      subtotal >= freeShippingThreshold
        ? '<span class="bi bi-check"></span> Complimenti, hai ottenuto la spedizione gratuita!'
        : `<span class="bi bi-x"></span> Aggiungi ancora €${(freeShippingThreshold - subtotal).toFixed(2)} per ottenere la spedizione gratuita.`;
  }

  cartItemsList.addEventListener("click", (e) => {
    const id = parseInt(e.target.dataset.id, 10);
    const action = e.target.dataset.action;

    if (action === "increase") addToCart(id, 1);
    if (action === "decrease") updateProductQuantity(id, "decrease");
    if (action === "remove") removeFromCart(id);
    refreshCart();
  });

  function clearCart() {
    // Rimuove i dati relativi al carrello (esempio: cookie o localStorage)
    document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";

    // Aggiorna la visualizzazione della pagina
    console.log("Carrello svuotato");
    refreshCart(); // Chiama la funzione per aggiornare la vista del carrello
  }

  clearCartButton.addEventListener("click", clearCart);

  refreshCart();

  function logCartContents() {
    const cart = getCartFromCookie(); // Usa la funzione che legge i cookies
    if (cart.length === 0) {
      console.log("Il carrello è vuoto.");
      return;
    }
    console.log("Contenuto del carrello:", cart);
  }
  
  logCartContents();

});
