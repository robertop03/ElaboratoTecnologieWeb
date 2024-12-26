document.addEventListener("DOMContentLoaded", function () {
  // Codice per mostrare o nascondere le password nei vari form
  document.querySelectorAll(".toggle-password").forEach((button) => {
    button.addEventListener("click", function () {
      const input = this.parentElement.querySelector("input")
      if (input.type === "password") {
        input.type = "text"
        this.innerHTML = '<i class="bi bi-eye-slash"></i>'
      } else {
        input.type = "password"
        this.innerHTML = '<i class="bi bi-eye"></i>'
      }
    })
  })

  // Codice per il cambio di lingua nella navbar
  const dropdownMenu = document.querySelector(".dropdown .dropdown-toggle")
  if (!dropdownMenu) {
    console.error("Dropdown toggle non trovato!")
    return
  }
  const dropdownItems = document.querySelectorAll(".dropdown-menu .dropdown-item")
  dropdownItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault() // Evita il comportamento predefinito del link

      const selectedImage = this.querySelector("img").src
      const selectedText = this.textContent.trim()

      const dropdownImg = dropdownMenu.querySelector("img")
      dropdownImg.src = selectedImage // Cambia immagine
      dropdownMenu.textContent = "" // Pulisci il contenuto del pulsante
      dropdownMenu.appendChild(dropdownImg) // Aggiungi l'immagine
      dropdownMenu.append(" " + selectedText) // Aggiungi il testo
    })
  })

  // Codice per i pulsanti quantità nella pagina prodotto
  const quantityInput = document.querySelector('input[type="number"]')
  const buttons = document.querySelectorAll(".btn-outline-secondary")
  if (quantityInput && buttons.length >= 2) {
    buttons[0].addEventListener("click", function () {
      const currentValue = parseInt(quantityInput.value, 10)
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1
      }
    })

    buttons[1].addEventListener("click", function () {
      const currentValue = parseInt(quantityInput.value, 10)
      if (currentValue < 1000) {
        quantityInput.value = currentValue + 1
      }
    })
  }
})
