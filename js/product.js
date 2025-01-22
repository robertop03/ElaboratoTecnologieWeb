document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get("id");

  if (!productId) {
    console.error("Nessun ID prodotto trovato nell'URL.");
    return;
  }

  const quantityInput = document.querySelector("#quantity");
  const addToCartButton = document.querySelector("#add-to-cart");
  const increaseQuantityButton = document.querySelector("#increase-quantity");
  const decreaseQuantityButton = document.querySelector("#decrease-quantity");

  let stockAvailable = 0; // Variabile per salvare la quantità disponibile in magazzino

  // Ottieni la quantità disponibile in magazzino al caricamento della pagina
  fetch("prodotto.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "getStock",
      productId: productId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        stockAvailable = data.stock; // Salva la quantità disponibile
        console.log(`Quantità disponibile per il prodotto ${productId}: ${stockAvailable}`);

        // Controlla se il pulsante di incremento deve essere disabilitato inizialmente
        updateButtonsState();
      } else {
        alert("Errore nel recupero della quantità disponibile: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Errore:", error);
    });

  // Incrementa la quantità
  increaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity < stockAvailable) {
      quantityInput.value = currentQuantity;
      updateButtonsState();
    }
  });

  // Decrementa la quantità
  decreaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity > 1) {
      quantityInput.value = currentQuantity;
      updateButtonsState();
    }
  });

  // Aggiungi il prodotto al carrello
  addToCartButton.addEventListener("click", () => {
    const quantity = parseInt(quantityInput.value, 10);

    // Controllo bloccante sulla quantità in magazzino
    if (quantity > stockAvailable) {
      alert("La quantità richiesta supera la disponibilità in magazzino!");
      return; // Blocca l'operazione
    }

    // Procedi con l'aggiunta al carrello
    addToCart(productId, quantity);

    // Mostra un alert di conferma
    alert("Prodotto aggiunto al carrello!");
  });

  // Funzione per abilitare/disabilitare i pulsanti di incremento/decremento
  function updateButtonsState() {
    const currentQuantity = parseInt(quantityInput.value, 10);

    // Disabilita il pulsante di incremento se si raggiunge il limite di stock
    if (currentQuantity >= stockAvailable) {
      increaseQuantityButton.disabled = true;
    } else {
      increaseQuantityButton.disabled = false;
    }

    // Disabilita il pulsante di decremento se si raggiunge 1
    if (currentQuantity <= 1) {
      decreaseQuantityButton.disabled = true;
    } else {
      decreaseQuantityButton.disabled = false;
    }
  }

  // Funzione per aggiungere un prodotto al carrello
  function addToCart(productId, quantity) {
    const cart = getCartFromCookie();

    // Cerca il prodotto nel carrello
    const existingProduct = cart.find((item) => item.id === productId);
    if (existingProduct) {
      existingProduct.quantity += quantity; // Aumenta la quantità
    } else {
      // Aggiungi un nuovo prodotto al carrello
      cart.push({ id: productId, quantity });
    }

    // Salva il carrello nei cookie
    saveCartToCookie(cart);
    console.log("Carrello aggiornato:", cart);
  }

  // Funzioni per gestire i cookie
  function getCartFromCookie() {
    const cookie = document.cookie.split("; ").find((row) => row.startsWith("cart="));
    return cookie ? JSON.parse(cookie.split("=")[1]) : [];
  }

  function saveCartToCookie(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400`; // 1 giorno
  }
});
