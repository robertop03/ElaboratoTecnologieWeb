document.addEventListener("DOMContentLoaded", () => {
  const cartEmpty = document.querySelector("#cart-empty")
  const cartFull = document.querySelector("#cart-full")
  const cartItemsList = document.querySelector("#cart-items")
  const checkoutButton = document.querySelector("#checkout-button")
  const shippingMessageElement = document.querySelector(".shipping-message #message-content")
  const clearCartButton = document.querySelector("#clear-cart")

  const freeShippingThreshold = 69

  // Usa il carrello completo passato da PHP
  const cart = typeof completeCart !== "undefined" ? completeCart : []

  // Funzione per aggiornare la vista del carrello
  function refreshCart() {
    if (cart.length === 0) {
      cartEmpty.classList.add("active")
      cartFull.classList.remove("active")
      checkoutButton.disabled = true
    } else {
      cartEmpty.classList.remove("active")
      cartFull.classList.add("active")
      checkoutButton.disabled = false
    }
    renderCartItems(cart)
    updateOrderSummary(cart)
  }

  // Funzione per renderizzare gli elementi del carrello
  function renderCartItems(cart) {
    cartItemsList.innerHTML = "" // Svuota la lista

    cart.forEach((item) => {
      const li = document.createElement("li")
      const price = parseFloat(item.price)
      li.innerHTML = `
        <img src="resources/img/${item.image}" alt="${item.title}" />
        <div>
          <h4>${item.title}</h4>
          
          <p>Prezzo: €${price.toFixed(2)}</p>
          <p>Quantità: 
            <button class="btn btn-sm btn-outline-secondary decrease" data-id="${item.id}">-</button>
            <span>${item.quantity}</span>
            <button class="btn btn-sm btn-outline-secondary increase" data-id="${item.id}">+</button>
          </p>
        </div>
        <button class="btn btn-sm btn-danger remove" data-id="${item.id}">Rimuovi</button>
      `
      cartItemsList.appendChild(li)
    })

    attachEventListeners() // Associa i listener ai nuovi elementi
  }

  // Funzione per aggiornare il riepilogo dell'ordine
  function updateOrderSummary(cart) {
    const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0)
    const shippingCost = subtotal >= freeShippingThreshold ? 0 : 7.75

    document.querySelector("#subtotal-price").textContent = `€${subtotal.toFixed(2)}`
    document.querySelector("#shipping-price").textContent = shippingCost === 0 ? "Gratuita" : `€${shippingCost.toFixed(2)}`
    document.querySelector("#total-price").textContent = `€${(subtotal + shippingCost).toFixed(2)}`

    shippingMessageElement.innerHTML = subtotal >= freeShippingThreshold ? '<span class="bi bi-check"></span> Complimenti, hai ottenuto la spedizione gratuita!' : `<span class="bi bi-x"></span> Aggiungi ancora €${(freeShippingThreshold - subtotal).toFixed(2)} per ottenere la spedizione gratuita.`
  }

  // Gestione dei pulsanti per aumentare/diminuire quantità
  function attachEventListeners() {
    document.querySelectorAll(".increase").forEach((button) => {
      button.removeEventListener("click", handleIncrease)
      button.addEventListener("click", handleIncrease)
    })

    document.querySelectorAll(".decrease").forEach((button) => {
      button.removeEventListener("click", handleDecrease)
      button.addEventListener("click", handleDecrease)
    })

    document.querySelectorAll(".remove").forEach((button) => {
      button.removeEventListener("click", handleRemove)
      button.addEventListener("click", handleRemove)
    })
  }

  function handleIncrease(event) {
    const id = event.target.dataset.id
    updateQuantity(id, 1)
  }

  function handleDecrease(event) {
    const id = event.target.dataset.id
    updateQuantity(id, -1)
  }

  function handleRemove(event) {
    const id = event.target.dataset.id
    removeProduct(id)
  }

  // Funzione per aggiornare la quantità di un prodotto
  function updateQuantity(id, change) {
    const product = cart.find((item) => item.id === id)
    if (product) {
      product.quantity += change

      if (product.quantity < 1) {
        product.quantity = 1 // Evita quantità negative
      }

      saveCartToCookie(cart)
      refreshCart()
    }
  }

  // Funzione per rimuovere un prodotto
  function removeProduct(id) {
    const index = cart.findIndex((item) => item.id === id)
    if (index !== -1) {
      cart.splice(index, 1) // Rimuovi il prodotto
      saveCartToCookie(cart)
      refreshCart()
    }
  }

  // Funzione per svuotare il carrello
  clearCartButton.addEventListener("click", () => {
    document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC"
    location.reload() // Ricarica la pagina
  })

  function saveCartToCookie(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=86400` // 1 giorno
  }

  refreshCart()
})
