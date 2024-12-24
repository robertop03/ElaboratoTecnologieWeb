document.addEventListener("DOMContentLoaded", () => {
    // Array che rappresenta il carrello (inizialmente vuoto)
    let cart = [];
  
    // Riferimenti agli elementi HTML
    const cartEmpty = document.getElementById("cart-empty");
    const cartFull = document.getElementById("cart-full");
    const cartItems = document.getElementById("cart-items");
  
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
            <img src="${product.image}" alt="${product.name}" style="width: 50px; height: 50px; margin-right: 10px;">
            ${product.name} - €${product.price}
          `;
          cartItems.appendChild(li);
        });
      }
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
  
    // Inizializza lo stato del carrello
    updateCartState();
  });
  