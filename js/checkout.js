document.addEventListener("DOMContentLoaded", () => {
  // Funzione per compilare i campi del form con i dati dell'indirizzo selezionato
  function selezionaIndirizzo(card) {
    const nomeCognomeField = document.querySelector("#nomeCognome")
    const indirizzoField = document.querySelector("#indirizzo")
    const capField = document.querySelector("#cap")
    const comuneField = document.querySelector("#comune")
    const provinciaField = document.querySelector("#provincia")
    const telefonoField = document.querySelector("#telefono")

    // Estrai i dati dalla card
    const info = card.dataset.info.split(", ")
    const indirizzo = info[0] // Via e numero civico
    const capCitta = info[1] // CAP e città
    const paese = info[2] // Paese

    // Compila i campi corrispondenti
    if (indirizzoField) indirizzoField.value = indirizzo || ""
    if (capField) capField.value = capCitta.split(" ")[0] || "" // CAP
    if (comuneField) comuneField.value = capCitta.split(" ")[1] || "" // Comune
    if (provinciaField) provinciaField.value = "" // Provincia (non disponibile nei dati)
    if (telefonoField) telefonoField.value = "" // Telefono (non disponibile nei dati)
  }

  // Funzione per compilare i campi del form con i dati della carta selezionata
  function selezionaCarta(carta) {
    // Verifica che i campi esistano
    const numeroCartaField = document.querySelector("#numeroCarta")
    const meseScadenzaField = document.querySelector("#meseScadenza")
    const annoScadenzaField = document.querySelector("#annoScadenza")
    const cvvField = document.querySelector("#cvv")

    if (!carta.dataset.cardNumber || !carta.dataset.cardExpiry) {
      console.error("Errore: dati della carta mancanti!")
      return
    }

    // Ottieni i dettagli della carta dal dataset
    const numeroCarta = carta.dataset.cardNumber
    const scadenza = carta.dataset.cardExpiry.split("/") // Assicurati che il formato sia "MM/YY"
    const meseScadenza = scadenza[0]
    const annoScadenza = scadenza[1]
    const cvv = carta.dataset.cardCvv || "" // Aggiungi CVV se presente

    // Popola i campi del form
    if (numeroCartaField) numeroCartaField.value = numeroCarta
    if (meseScadenzaField) meseScadenzaField.value = meseScadenza
    if (annoScadenzaField) annoScadenzaField.value = annoScadenza
    if (cvvField) cvvField.value = cvv

    // Chiudi il modale
    const cardModal = bootstrap.Modal.getInstance(document.querySelector("#creditCardModal"))
    if (cardModal) cardModal.hide()
  }

  // Aggiungi listener alle card degli indirizzi
  const addressCards = document.querySelectorAll(".selectable-address")
  addressCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaIndirizzo(card)

      // Chiudi il modale degli indirizzi
      const addressModalElement = document.querySelector("#addressModal")
      const addressModal = addressModalElement ? bootstrap.Modal.getInstance(addressModalElement) : null
      if (addressModal) addressModal.hide()
    })
  })

  // Aggiungi listener alle card delle carte di credito
  const creditCardCards = document.querySelectorAll(".selectable-card")
  creditCardCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaCarta(card)

      // Chiudi il modale delle carte
      const cardModalElement = document.querySelector("#creditCardModal")
      const cardModal = cardModalElement ? bootstrap.Modal.getInstance(cardModalElement) : null
      if (cardModal) cardModal.hide()
    })
  })
})
