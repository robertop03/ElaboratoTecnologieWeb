document.addEventListener("DOMContentLoaded", () => {
  // Elementi del DOM
  const addressList = document.querySelector("#address-list")
  const addressModal = new bootstrap.Modal(document.querySelector("#addressModal"))

  const cardList = document.querySelector("#credit-card-list")
  const cardModal = new bootstrap.Modal(document.querySelector("#creditCardModal"))

  // Carica indirizzi salvati
  fetch("./db/database.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ action: "getUserAddresses" }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Errore HTTP: ${response.status}`)
      }
      return response.json()
    })
    .then((data) => {
      if (data.error) {
        console.error("Errore:", data.error)
      } else if (data.length > 0) {
        mostraIndirizzi(data) // Popola il modale
      } else {
        console.log("Nessun indirizzo salvato.")
      }
    })
    .catch((error) => console.error("Errore nel caricamento degli indirizzi:", error))

  // Carica carte salvate
  fetch("./db/database.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ action: "getUserPaymentMethods" }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Errore HTTP: ${response.status}`)
      }
      return response.json()
    })
    .then((data) => {
      if (data.error) {
        console.error("Errore:", data.error)
      } else if (data.length > 0) {
        mostraCarte(data) // Popola il modale
      } else {
        console.log("Nessuna carta salvata.")
      }
    })
    .catch((error) => console.error("Errore nel caricamento delle carte:", error))

  // Funzione per mostrare indirizzi
  function mostraIndirizzi(indirizzi) {
    addressList.innerHTML = ""
    indirizzi.forEach((indirizzo) => {
      const card = document.createElement("div")
      card.className = "card p-3 selectable-address"
      card.innerHTML = `
        <p>${indirizzo.Via} ${indirizzo.Numero_Civico}<br />
        ${indirizzo.CAP} ${indirizzo.Citta}<br />
        ${indirizzo.Paese}</p>`
      card.addEventListener("click", () => selezionaIndirizzo(indirizzo))
      addressList.appendChild(card)
    })
  }

  // Funzione per mostrare carte
  function mostraCarte(carte) {
    cardList.innerHTML = ""
    carte.forEach((carta) => {
      const card = document.createElement("div")
      card.className = "card p-3 selectable-card"
      card.innerHTML = `
        <p>**** **** **** ${carta.Numero_Carta.slice(-4)}<br />
        Scadenza: ${carta.mese_scadenza}/${carta.anno_scadenza}</p>`
      card.addEventListener("click", () => selezionaCarta(carta))
      cardList.appendChild(card)
    })
  }

  // Funzione per selezionare un indirizzo
  function selezionaIndirizzo(indirizzo) {
    document.querySelector("#nomeCognome").value = indirizzo.Nome || ""
    document.querySelector("#indirizzo").value = `${indirizzo.Via} ${indirizzo.Numero_Civico}`
    document.querySelector("#cap").value = indirizzo.CAP
    document.querySelector("#comune").value = indirizzo.Citta
    document.querySelector("#provincia").value = indirizzo.Provincia || ""
    document.querySelector("#telefono").value = indirizzo.Telefono || ""

    addressModal.hide() // Chiudi il modale
  }

  // Funzione per selezionare una carta
  function selezionaCarta(carta) {
    document.querySelector("#numeroCarta").value = carta.Numero_Carta
    document.querySelector("#meseScadenza").value = carta.mese_scadenza
    document.querySelector("#annoScadenza").value = carta.anno_scadenza
    document.querySelector("#cvv").value = carta.CVV

    cardModal.hide() // Chiudi il modale
  }

  // Event Listener per aprire il modale degli indirizzi
  document.querySelector(".custom-link[data-bs-target='#addressModal']").addEventListener("click", () => {
    addressModal.show()
  })

  // Event Listener per aprire il modale delle carte
  document.querySelector(".custom-link[data-bs-target='#creditCardModal']").addEventListener("click", () => {
    cardModal.show()
  })
})
