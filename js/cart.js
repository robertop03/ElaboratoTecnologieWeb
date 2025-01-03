document.addEventListener("DOMContentLoaded", () => {
  // Array che rappresenta il carrello (inizialmente vuoto)
  let cart = [];

  // Riferimenti agli elementi HTML
  const cartEmpty = document.getElementById("cart-empty");
  const cartFull = document.getElementById("cart-full");
  const cartItems = document.getElementById("cart-items");
  const orderSummarySection = document.querySelector("main > section");

  // Funzione per calcolare il totale dei prodotti
  function calculateTotal() {
    return cart.reduce((total, product) => total + product.price, 0);
  }

  // Funzione per aggiornare il riassunto dell'ordine
  function updateOrderSummary() {
    if (cart.length === 0) {
      // Se il carrello è vuoto, mostra il riassunto predefinito con €0,00
      orderSummarySection.innerHTML = `
        <div>
          <span>TOTALE ORDINE</span>
        </div>
        <div>
          <span>Totale ordine (IVA inclusa 22%)</span>
          <span>€0,00</span>
        </div>
      `;
    } else {
      const totalProducts = calculateTotal();
      const shippingCost = totalProducts > 69 ? 0 : 7.75;
      const totalWithShipping = totalProducts + shippingCost;

      // Aggiorna il contenuto della sezione con i dettagli dell'ordine
      orderSummarySection.innerHTML = `
        <div>
          <span>TOTALE ORDINE</span>
        </div>
        <div>
          <span>Totale prodotti</span>
          <span>€${totalProducts.toFixed(2)}</span>
        </div>
        <div>
          <span>Totale spedizione a domicilio</span>
          <span>${shippingCost === 0 ? "Gratuita" : `€${shippingCost.toFixed(2)}`}</span>
        </div>
        <hr />
        <div>
          <span>Totale ordine (IVA inclusa 22%)</span>
          <span>€${totalWithShipping.toFixed(2)}</span>
        </div>
      `;
    }
  }

  // Funzione per aggiornare lo stato del carrello
  function updateCartState() {
    if (cart.length === 0) {
      // Mostra il carrello vuoto
      cartEmpty.classList.add("active");
      cartFull.classList.remove("active");
    } else {
      // Mostra il carrello pieno
      cartEmpty.classList.remove("active");
      cartFull.classList.add("active");

      // Popola la lista dei prodotti nel carrello
      cartItems.innerHTML = ""; // Svuota la lista precedente
      cart.forEach(product => {
        const li = document.createElement("li");
        li.innerHTML = `
          <img src="${product.image}" alt="${product.name}">
          ${product.name} - €${product.price.toFixed(2)}
        `;
        cartItems.appendChild(li);
      });
    }

    // Aggiorna il riassunto dell'ordine
    updateOrderSummary();
  }

  // Simula l'aggiunta di un prodotto al carrello dopo 2 secondi
  setTimeout(() => {
    cart.push({
      id: 1,
      name: "Bottiglia di Vino",
      price: 19.99,
      image: "../resources/img/vino1.jpg",
    });
    updateCartState();
  }, 2000);

  setTimeout(() => {
    cart.push({
      id: 2,
      name: "Biscotti Artigianali",
      price: 15.5,
      image: "../resources/img/biscotti.jpg",
    });
    updateCartState();
  }, 4000);

  // Inizializza lo stato del carrello
  updateCartState();
});
