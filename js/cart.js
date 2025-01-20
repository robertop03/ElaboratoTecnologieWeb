document.addEventListener("DOMContentLoaded", () => {
  console.log("Dati ricevuti dal server:", completeCart);

  const cartEmpty = document.querySelector("#cart-empty");
  const cartFull = document.querySelector("#cart-full");
  const cartItemsList = document.querySelector("#cart-items");
  const checkoutButton = document.querySelector("#checkout-button");
  const shippingMessageElement = document.querySelector(".shipping-message #message-content");
  const clearCartButton = document.querySelector("#clear-cart");

  const freeShippingThreshold = 69;

  // Usa il carrello completo passato da PHP
  const cart = typeof completeCart !== "undefined" ? completeCart : [];
  console.log("Carrello inizializzato:", cart); // Debug

  function refreshCart() {
    console.log("Aggiornamento carrello:", cart); // Debug
    if (cart.length === 0) {
      cartEmpty.classList.add("active");
      cartFull.classList.remove("active");
      checkoutButton.disabled = true;
    } else {
      cartEmpty.classList.remove("active");
      cartFull.classList.add("active");
      checkoutButton.disabled = false;
    }
    renderCartItems(cart);
    updateOrderSummary(cart);
  }

  function renderCartItems(cart) {
    console.log("Renderizzazione elementi carrello:", cart); // Debug
    cartItemsList.innerHTML = ""; // Svuota la lista

    cart.forEach((item) => {
      const li = document.createElement("li");
      li.innerHTML = `
        <img src="${item.image}" alt="${item.title}" />
        <div>
          <h4>${item.title}</h4>
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

    // Aggiungi eventi per i pulsanti
    cartItemsList.addEventListener("click", (e) => {
      const id = e.target.dataset.id;
      const action = e.target.dataset.action;

      if (!id || !action) return;

      if (action === "increase") {
        modifyQuantity(id, 1);
      } else if (action === "decrease") {
        modifyQuantity(id, -1);
      } else if (action === "remove") {
        removeFromCart(id);
      }
      refreshCart();
    });
  }

  function updateOrderSummary(cart) {
    const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
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

  function modifyQuantity(id, delta) {
    const item = cart.find((product) => product.id === id);
    if (!item) return;

    item.quantity = Math.max(1, item.quantity + delta);
    saveCartToCookie(cart);
  }

  function removeFromCart(id) {
    const index = cart.findIndex((product) => product.id === id);
    if (index === -1) return;

    cart.splice(index, 1);
    saveCartToCookie(cart);
  }

  function saveCartToCookie(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400`; // 1 giorno
  }

  clearCartButton.addEventListener("click", () => {
    document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";
    location.reload(); // Ricarica la pagina
  });

  refreshCart();
});
