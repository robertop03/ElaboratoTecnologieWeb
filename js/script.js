document.addEventListener("DOMContentLoaded", function () {
  // Codice per mostrare o nascondere le password nei vari form
  document.querySelectorAll(".toggle-password").forEach((button) => {
    button.onclick = function () {
      const input = this.parentElement.querySelector("input")
      if (input.type === "password") {
        input.type = "text"
        this.innerHTML = '<span class="bi bi-eye-slash" role="img" aria-label="icona occhio mostra password"></span>'
      } else {
        input.type = "password"
        this.innerHTML = '<span class="bi bi-eye" role="img" aria-label="icona occhio mostra password"></span>'
      }
    }
  })

  // Codice per il cambio di lingua nella navbar
  const dropdownMenu = document.querySelector(".dropdown .dropdown-toggle")
  const dropdownItems = document.querySelectorAll(".dropdown-menu .dropdown-item")
  dropdownItems.forEach((item) => {
    item.onclick = function () {
      const selectedImage = this.querySelector("img").src
      const selectedText = this.textContent.trim()

      const dropdownImg = dropdownMenu.querySelector("img")
      dropdownImg.src = selectedImage // Cambia immagine
      dropdownMenu.textContent = "" // Pulisci il contenuto del pulsante
      dropdownMenu.appendChild(dropdownImg) // Aggiungi l'immagine
      dropdownMenu.append(" " + selectedText) // Aggiungi il testo
    }
  })

  // Codice per i pulsanti quantità nella pagina prodotto
  const quantityInput = document.querySelector('input[type="number"]')
  const buttons = document.querySelectorAll(".btn-outline-secondary")
  if (quantityInput && buttons.length >= 2) {
    buttons[0].onclick = function () {
      const currentValue = parseInt(quantityInput.value, 10)
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1
      }
    }

    buttons[1].onclick = function () {
      const currentValue = parseInt(quantityInput.value, 10)
      if (currentValue < 1000) {
        quantityInput.value = currentValue + 1
      }
    }
  }

  // CODICE PER I MODALI DELLE NOTIFICHE
  const notificationModal = document.querySelector("#notification-modal")
  const modalTitle = notificationModal?.querySelector(".modal-title")
  const modalBody = notificationModal?.querySelector(".modal-body")
  const cardTitle = document.querySelector(".card-title")
  const cardText = document.querySelector(".card-text")

  const detailedContent = {
    "La spedizione è arrivata con successo!": "La spedizione è arrivata con successo! Questo aggiornamento indica che il tuo ordine è stato consegnato correttamente. Se hai ulteriori domande o hai bisogno di assistenza, contatta il nostro supporto clienti.",
    "L'ordine IT2320P è in arrivo domani!": "L'ordine IT2320P è in arrivo domani! Il corriere ha confermato la data di consegna e ti invitiamo a tenere il telefono a portata di mano per eventuali aggiornamenti o richieste di firma alla consegna.",
    "La spedizione contenente l'ordine IT2320P è stata effettuata": "La spedizione contenente l'ordine IT2320P è stata effettuata. Il pacco è ora in viaggio verso la tua destinazione e ti aggiorneremo a breve con il tracking completo.",
    "Ordine IT2320P effettuato con successo": "Ordine IT2320P effettuato con successo. Il nostro team ha ricevuto il tuo ordine e lo sta processando. Riceverai una notifica appena la spedizione sarà pronta.",
  }

  function showNotification(event) {
    const clickedItem = event.currentTarget.closest(".list-group-item")
    if (!clickedItem) return

    const shortContentElement = clickedItem.querySelector("p")
    const titleElement = clickedItem.querySelectorAll("span")[1]

    if (shortContentElement != null) {
      const shortContent = shortContentElement.textContent.trim()
      const titleText = titleElement.textContent.trim()

      if (window.innerWidth >= 992) {
        // Modalità Desktop: aggiorna la sidebar
        cardTitle.textContent = titleText
        cardText.textContent = shortContent
      } else {
        // Modalità Mobile: aggiorna e mostra il modale
        modalTitle.textContent = titleText
        modalBody.textContent = shortContent
        const modalInstance = new bootstrap.Modal(notificationModal, { backdrop: true, keyboard: true })
        modalInstance.show()
      }
    }
  }

  document.querySelectorAll(".list-group-item").forEach((item) => {
    item.addEventListener("click", showNotification)
  })

  window.showNotification = showNotification

  // CODICE PER CHIUDERE ALTRI EVENTUALI MODALI APERTI
  const modalTriggers = document.querySelectorAll("[data-bs-toggle='modal']")
  modalTriggers.forEach((trigger) => {
    const targetModalId = trigger.getAttribute("data-bs-target")
    const targetModal = document.querySelector(targetModalId)

    if (targetModal) {
      trigger.onclick = function (event) {
        event.preventDefault() // Per evitare che il link href="#" scorra verso l'alto
      }
      targetModal.onhide = function () {
        // Rimuovi il focus dall'elemento attivo
        if (document.activeElement) {
          document.activeElement.blur()
        }
      }
    }
  })

  // CODICE PER IL RANGE PREZZO NEL FILTRAGGIO
  const sliders = document.querySelectorAll(".form-range")
  const badges = document.querySelectorAll(".badge")
  if (sliders.length >= 2 && badges.length >= 2) {
    const minSlider = sliders[0]
    const maxSlider = sliders[1]

    sliders.forEach((slider) => {
      slider.oninput = function () {
        const minValue = parseInt(minSlider.value, 10)
        const maxValue = parseInt(maxSlider.value, 10)

        // Sincronizza il valore del badge
        badges[0].textContent = `Min: ${minValue}€`
        badges[1].textContent = `Max: ${maxValue}€`

        // Impedisce la sovrapposizione dei pallini
        if (minValue >= maxValue) minSlider.value = maxValue - 1
        if (maxValue <= minValue) maxSlider.value = minValue + 1
      }
    })
  }

  // CODICE PER INTERATTIVITA' MAPPA
  const tooltip = document.createElement("div")
  tooltip.style.position = "absolute"
  tooltip.style.backgroundColor = "rgba(206, 196, 228, 0.8)"
  tooltip.style.color = "black"
  tooltip.style.padding = "5px 10px"
  tooltip.style.borderRadius = "5px"
  tooltip.style.fontSize = "12px"
  tooltip.style.display = "none"
  tooltip.style.pointerEvents = "none"
  document.body.appendChild(tooltip)

  // CODICE PER CARICARE I PERCORSI NELLA MAPPA SVG
  async function loadPaths() {
    try {
      const { paths } = await import("../js/path.js?v=1")

      paths.forEach((pathString) => {
        svgElement.innerHTML += pathString
      })

      // Seleziona i path o elementi interattivi solo dopo averli caricati
      const regions = svgElement.querySelectorAll("path, g")

      if (regions.length === 0) {
        console.warn("Nessun elemento trovato nell'SVG!")
        return
      }

      regions.forEach((region) => {
        // Evento click per selezionare una regione
        region.onclick = function () {
          const regionName = region.getAttribute("title") || region.getAttribute("data-name") || region.id || "Regione non definita"
          const url = `listaprodotti.php?prov=${encodeURIComponent(regionName)}`
          window.location.href = url
        }
      })
    } catch (error) {
      console.error("Errore durante il caricamento dei path:", error)
    }
  }

  const modalElement = document.querySelector("main .modal")
  const svgElement = modalElement.querySelector("svg")
  // Carica i path quando il modal viene mostrato
  if (modalElement) {
    modalElement.addEventListener("show.bs.modal", () => {
      if (!svgElement.innerHTML.trim()) {
        loadPaths()
      }
    })
  }

  modalElement.addEventListener("hide.bs.modal", () => {
    if (document.activeElement) {
      document.activeElement.blur()
    }
  })
})

function addFavorite(wineId, element) {
  fetch("aggiorna-preferiti.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ wineId: wineId, action: "add" }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        element.classList.remove("bi-heart")
        element.classList.add("bi-heart-fill", "text-danger")
        element.setAttribute("onclick", `removeFavorite('${wineId}', this)`)
      } else {
        console.error("Error adding favorite:", data.message)
      }
    })
    .catch((error) => console.error("Error:", error))
}

function removeFavorite(wineId, element) {
  // Mostra il modale di conferma
  const confirmRemoveModal = new bootstrap.Modal(document.getElementById("confirmRemoveModal"))
  const confirmRemoveButton = document.getElementById("confirmRemoveButton")

  // Configura il pulsante del modale
  confirmRemoveButton.onclick = () => {
    fetch("aggiorna-preferiti.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ wineId: wineId, action: "remove" }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Aggiorna l'icona del cuore
          element.classList.remove("bi-heart-fill", "text-danger")
          element.classList.add("bi-heart")
          element.setAttribute("onclick", `addFavorite('${wineId}', this)`)
        } else {
          console.error("Error removing favorite:", data.message)
        }
      })
      .catch((error) => console.error("Error:", error))

    confirmRemoveModal.hide()
  }

  confirmRemoveModal.show()
}

function setNotificaLetta(element) {
  const idNotifica = element.getAttribute("data-id")
  if (idNotifica) {
    const url = `notifiche.php?action=update&id=${encodeURIComponent(idNotifica)}`

    fetch(url, {
      method: "GET",
    })
      .then((response) => {
        console.log(response)
        return response.json()
      })
      .then((data) => {
        if (data.success) {
          // Aggiorna lo stile della notifica come "letta"
          element.classList.remove("bg-light", "fw-bold")
          element.classList.add("bg-white", "fw-normal", "opacity-50")
          aggiornaNumeroNotifiche()
        } else {
          console.error("Errore:", data.error)
        }
      })
      .catch((error) => console.error("Errore:", error))
  }
}

function aggiornaNumeroNotifiche() {
  fetch("notifiche.php?action=count", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const notificationCountElements = document.querySelectorAll("#notification-count-mb, #notification-count-d")
      if (data.count !== undefined) {
        notificationCountElements.forEach((element) => {
          element.textContent = data.count // Aggiorna il conteggio su ogni elemento selezionato
        })
      } else {
        console.error("Errore: conteggio notifiche non trovato")
      }
    })
    .catch((error) => console.error("Errore nella richiesta di aggiornamento notifiche:", error))
}
