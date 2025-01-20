document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search)
  const productId = urlParams.get("id")

  if (!productId) {
    console.error("Nessun ID prodotto trovato nell'URL.")
    return
  }

  const quantityInput = document.getElementById("quantity")
  const addToCartButton = document.getElementById("add-to-cart")
  const increaseQuantityButton = document.getElementById("increase-quantity")
  const decreaseQuantityButton = document.getElementById("decrease-quantity")

  // Incrementa la quantità
  increaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10)
    quantityInput.value = currentQuantity + 1
  })

  // Decrementa la quantità
  decreaseQuantityButton.addEventListener("click", () => {
    let currentQuantity = parseInt(quantityInput.value, 10)
    if (currentQuantity > 1) {
      quantityInput.value = currentQuantity - 1
    }
  })

  // Aggiungi il prodotto al carrello
  addToCartButton.addEventListener("click", () => {
    const quantity = parseInt(quantityInput.value, 10)

    // Salva l'ID del prodotto e la quantità nei cookie del carrello
    addToCart(productId, quantity)

    // Mostra un alert di conferma
    alert("Prodotto aggiunto al carrello!")
  })

  // Funzione per salvare un prodotto nel carrello
  function addToCart(productId, quantity) {
    const cart = getCartFromCookie()

    // Cerca il prodotto nel carrello
    const existingProduct = cart.find((item) => item.id === productId)
    if (existingProduct) {
      existingProduct.quantity += quantity // Aggiorna la quantità
    } else {
      // Aggiungi un nuovo prodotto al carrello
      cart.push({ id: productId, quantity })
    }

    // Salva il carrello nei cookie
    saveCartToCookie(cart)
    console.log("Carrello aggiornato:", cart)
  }

  // Funzioni per gestire i cookie
  function getCartFromCookie() {
    const cookie = document.cookie.split("; ").find((row) => row.startsWith("cart="))
    return cookie ? JSON.parse(cookie.split("=")[1]) : []
  }

  function saveCartToCookie(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400` // 1 giorno
  }
})
