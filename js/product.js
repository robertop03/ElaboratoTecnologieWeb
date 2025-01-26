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
  const messageBox = document.querySelector("#message-box"); // Elemento per i messaggi dinamici

  let stockAvailable = 0; // Quantità disponibile in magazzino

  // Recupera la quantità disponibile in magazzino al caricamento
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
        stockAvailable = data.stock;
        console.log(`Quantità disponibile: ${stockAvailable}`);
        updateButtonsState();
      } else {
        showMessage("Errore nel recupero della disponibilità in magazzino.", "red");
      }
    })
    .catch((error) => {
      console.error("Errore:", error);
      showMessage("Errore di comunicazione con il server.", "red");
    });

  // Incrementa la quantità
  increaseQuantityButton.onclick = () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity < stockAvailable) {
      quantityInput.value = currentQuantity + 1;
      updateButtonsState();
    }
  };

  // Decrementa la quantità
  decreaseQuantityButton.onclick = () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity > 1) {
      quantityInput.value = currentQuantity - 1;
      updateButtonsState();
    }
  };

  // Aggiungi al carrello
  addToCartButton.onclick = () => {
    const quantity = parseInt(quantityInput.value, 10);

    if (quantity > stockAvailable) {
      showMessage("La quantità richiesta supera la disponibilità in magazzino!", "orange");
      return;
    }

    // Simula l'aggiunta al carrello
    addToCart(productId, quantity);
    showMessage("Prodotto aggiunto al carrello!", "green");
  };

  // Funzione per aggiornare i pulsanti
  function updateButtonsState() {
    const currentQuantity = parseInt(quantityInput.value, 10);

    increaseQuantityButton.disabled = currentQuantity >= stockAvailable;
    decreaseQuantityButton.disabled = currentQuantity <= 1;
  }

  // Funzione per mostrare un messaggio
  function showMessage(message, color) {
    messageBox.textContent = message;
    messageBox.style.color = color;
  }

  // Funzione per aggiungere un prodotto al carrello
  function addToCart(productId, quantity) {
    const cart = getCartFromCookie();

    // Cerca il prodotto nel carrello
    const existingProduct = cart.find((item) => item.id === productId);
    if (existingProduct) {
      existingProduct.quantity = quantity; // Sovrascrivi la quantità specificata
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