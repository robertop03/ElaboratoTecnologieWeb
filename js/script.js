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

  // Codice per mostrare le notifiche selezionate nella pagina notifiche
  function showNotification(event) {
    const clickedItem = event.currentTarget

    // Clear active state from all items
    document.querySelectorAll(".list-group-item").forEach((item) => {
      item.style.backgroundColor = ""
      item.style.opacity = "1"
    })

    // Set active state on the clicked item
    clickedItem.style.backgroundColor = "#f8f9fa"
    clickedItem.style.opacity = "0.6"

    // Update desktop details
    const cardTitle = document.querySelector(".card-title")
    const cardText = document.querySelector(".card-text")
    cardTitle.textContent = clickedItem.querySelector("span").textContent
    cardText.textContent = clickedItem.querySelector("p").textContent

    const detailedContent = {
      "La spedizione è arrivata con successo!": "La spedizione è arrivata con successo! Questo aggiornamento indica che il tuo ordine è stato consegnato correttamente. Se hai ulteriori domande o hai bisogno di assistenza, contatta il nostro supporto clienti.",
      "L'ordine IT2320P è in arrivo domani!": "L'ordine IT2320P è in arrivo domani! Il corriere ha confermato la data di consegna e ti invitiamo a tenere il telefono a portata di mano per eventuali aggiornamenti o richieste di firma alla consegna.",
      "La spedizione contenente l'ordine IT2320P è stata effettuata": "La spedizione contenente l'ordine IT2320P è stata effettuata. Il pacco è ora in viaggio verso la tua destinazione e ti aggiorneremo a breve con il tracking completo.",
      "Ordine IT2320P effettuato con successo": "Ordine IT2320P effettuato con successo. Il nostro team ha ricevuto il tuo ordine e lo sta processando. Riceverai una notifica appena la spedizione sarà pronta.",
    }
    const shortContent = clickedItem.querySelector("p").textContent
    cardText.textContent = detailedContent[shortContent] || "I dettagli della notifica non sono disponibili."

    // Show modal on mobile
    if (window.innerWidth < 992) {
      const modal = new bootstrap.Modal(document.querySelector(".modal"))
      document.querySelector(".modal-title").textContent = clickedItem.querySelector("span").textContent
      document.querySelector(".modal-body").textContent = detailedContent[shortContent] || "I dettagli della notifica non sono disponibili."
      modal.show()
    }
  }

  // Attach the function to the global scope (optional, if required by inline events)
  window.showNotification = showNotification

  const modals = document.querySelectorAll(".modal")

  modals.forEach((modal) => {
    modal.addEventListener("hidden.bs.modal", function (event) {
      // Sposta il focus sul pulsante che ha aperto il modal
      const triggerButton = document.querySelector(`[data-bs-target="#${modal.id}"]`)
      if (triggerButton) {
        triggerButton.focus()
      }
    })
  })
})
