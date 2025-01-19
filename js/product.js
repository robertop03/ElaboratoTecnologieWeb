document.addEventListener("DOMContentLoaded", () => {
    const quantityInput = document.getElementById("quantity");
    const addToCartButton = document.getElementById("add-to-cart");
    const increaseQuantityButton = document.getElementById("increase-quantity");
    const decreaseQuantityButton = document.getElementById("decrease-quantity");
  
    // Funzione per incrementare la quantità
    increaseQuantityButton.addEventListener("click", () => {
      let currentQuantity = parseInt(quantityInput.value, 10);
      quantityInput.value = currentQuantity + 1;
    });
  
    // Funzione per decrementare la quantità
    decreaseQuantityButton.addEventListener("click", () => {
      let currentQuantity = parseInt(quantityInput.value, 10);
      if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
      }
    });
  
    // Funzione per aggiungere il prodotto al carrello
    addToCartButton.addEventListener("click", async () => {
        const productId = addToCartButton.dataset.id;
        const quantity = parseInt(quantityInput.value, 10);
      
        // Recupera i dettagli del prodotto dall'API
        const productDetails = await fetchProductDetails(productId);
      
        if (productDetails) {
          // Aggiungi il prodotto al carrello
          addToCart(productDetails, quantity);
      
          // Mostra un alert di conferma
          alert(`Il prodotto "${productDetails.Titolo}" è stato aggiunto al carrello!`);
        } else {
          alert("Errore durante l'aggiunta del prodotto al carrello.");
        }
      });      
  
    // Funzione per chiamare l'API e ottenere i dettagli del prodotto
    async function fetchProductDetails(productId) {
      try {
        const response = await fetch("api/dettagliProdotto.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ ids: [productId] }), // Invia l'ID come array
        });
  
        if (!response.ok) {
          throw new Error(`Errore API: ${response.status}`);
        }
  
        const [productDetails] = await response.json(); // L'API restituisce un array
        return productDetails; // Ritorna i dettagli del prodotto
      } catch (error) {
        console.error("Errore durante il recupero dei dettagli del prodotto:", error.message);
        return null;
      }
    }
  
    // Funzione per salvare il prodotto nel carrello
    function addToCart(productDetails, quantity) {
      const cart = getCartFromCookie();
  
      // Controlla se il prodotto è già nel carrello
      const existingProduct = cart.find((item) => item.id === productDetails.ID_Prodotto);
  
      if (existingProduct) {
        existingProduct.quantity += quantity; // Aggiungi la quantità
      } else {
        // Aggiungi un nuovo prodotto con i dettagli
        cart.push({
          id: productDetails.ID_Prodotto,
          name: productDetails.Titolo,
          price: productDetails.Prezzo,
          image: productDetails.Foto,
          quantity: quantity,
        });
      }
  
      // Salva il carrello nei cookies
      saveCartToCookie(cart);
    }
  
    // Funzioni per gestire i cookies
    function getCartFromCookie() {
      const cookie = document.cookie
        .split("; ")
        .find((row) => row.startsWith("cart="));
      return cookie ? JSON.parse(cookie.split("=")[1]) : [];
    }
  
    function saveCartToCookie(cart) {
      document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400`; // 1 giorno
    }

    console.log(document.cookie);
});
  