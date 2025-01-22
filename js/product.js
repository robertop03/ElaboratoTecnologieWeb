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

  // Incrementa la quantità
  increaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    quantityInput.value = currentQuantity + 1;
  });

  // Decrementa la quantità
  decreaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity > 1) {
      quantityInput.value = currentQuantity - 1;
    }
  });

  // Aggiungi il prodotto al carrello
  addToCartButton.addEventListener("click", () => {
    const quantity = parseInt(quantityInput.value, 10);

    // Effettua il controllo sulla quantità in magazzino
    fetch("prodotto.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        action: "checkStock",
        productId: productId,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          const availableStock = data.stock;

          if (quantity > availableStock) {
            // Mostra un alert se la quantità supera la disponibilità
            alert(
              `Quantità richiesta (${quantity}) non disponibile. In magazzino ci sono ${availableStock} unità.`
            );
          } else {
            // Salva l'ID del prodotto e la quantità nel cookie del carrello
            addToCart(productId, quantity);
            alert("Prodotto aggiunto al carrello!");
          }
        } else {
          alert("Errore durante il controllo della quantità in magazzino.");
        }
      })
      .catch((error) => {
        console.error("Errore:", error);
        alert("Si è verificato un errore. Riprova più tardi.");
      });
  });

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
