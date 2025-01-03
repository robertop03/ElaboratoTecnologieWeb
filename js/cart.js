document.addEventListener("DOMContentLoaded", () => {
  // Elementi del DOM
  const cartEmpty = document.getElementById("cart-empty");
  const cartFull = document.getElementById("cart-full");
  const cartItemsList = document.getElementById("cart-items");

  // Dati iniziali del carrello
  let cartItems = [
    {
      id: 1,
      name: "Chianti Classico DOCG",
      price: 19.99,
      quantity: 2,
      image: "../resources/img/vino1.jpg",
    },
    {
      id: 2,
      name: "Barolo Riserva",
      price: 29.99,
      quantity: 1,
      image: "../resources/img/vino3.jpg",
    },
  ];

  // Funzione per aggiornare il riassunto dell'ordine
function updateOrderSummary() {
  const subtotal = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
  let shippingCost = 0;

  const shippingPriceElement = document.getElementById('shipping-price');
  const subtotalPriceElement = document.getElementById('subtotal-price');
  const totalPriceElement = document.getElementById('total-price');

  if (cartItems.length === 0) {
    // Se il carrello è vuoto
    subtotalPriceElement.textContent = `€0,00`;
    shippingPriceElement.textContent = `€0,00`;
    totalPriceElement.textContent = `€0,00`;

    // Nascondi la riga della spedizione
    shippingPriceElement.parentElement.style.display = 'none';
  } else {
    // Calcolo costo spedizione
    if (subtotal >= 69) {
      shippingCost = 0;
      shippingPriceElement.textContent = 'Gratuita';
    } else {
      shippingCost = 7.75;
      shippingPriceElement.textContent = `€${shippingCost.toFixed(2)}`;
    }

    // Mostra la riga della spedizione
    shippingPriceElement.parentElement.style.display = 'flex';

    // Aggiorna i valori nel DOM
    subtotalPriceElement.textContent = `€${subtotal.toFixed(2)}`;
    totalPriceElement.textContent = `€${(subtotal + shippingCost).toFixed(2)}`;
  }
}


  // Funzione: Aggiorna lo stato del carrello (vuoto/pieno)
  function updateCartState() {
    if (cartItems.length === 0) {
      cartEmpty.classList.add("active");
      cartFull.classList.remove("active");
    } else {
      cartEmpty.classList.remove("active");
      cartFull.classList.add("active");
    }
  }

  // Funzione: Renderizza gli elementi nel carrello
  function renderCartItems() {
    cartItemsList.innerHTML = ""; // Svuota la lista
    cartItems.forEach((item) => {
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

  // Funzione: Aggiorna quantità di un prodotto
  function updateQuantity(id, action) {
    cartItems = cartItems
      .map((item) => {
        if (item.id === id) {
          if (action === "increase") item.quantity += 1;
          if (action === "decrease" && item.quantity > 1) item.quantity -= 1;
        }
        return item;
      })
      .filter((item) => item.quantity > 0); // Rimuove elementi con quantità 0
    refreshCart();
  }

  // Funzione: Rimuove un elemento dal carrello
  function removeItem(id) {
    cartItems = cartItems.filter((item) => item.id !== id);
    refreshCart();
  }

  // Funzione: Aggiorna carrello e riassunto
  function refreshCart() {
    renderCartItems();
    updateCartState();
    updateOrderSummary();
  }

  // Gestione eventi
  cartItemsList.addEventListener("click", (e) => {
    const id = parseInt(e.target.dataset.id, 10);
    const action = e.target.dataset.action;

    if (action === "increase") updateQuantity(id, "increase");
    if (action === "decrease") updateQuantity(id, "decrease");
    if (action === "remove") removeItem(id);
  });

  // Inizializza il carrello
  refreshCart();
});
