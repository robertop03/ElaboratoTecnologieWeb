document.addEventListener("DOMContentLoaded", () => {
  let selectedAddressId = null; // Variabile per tracciare l'ID dell'indirizzo selezionato
  let selectedPaymentMethodId = null; // Variabile per tracciare l'ID del metodo di pagamento selezionato

  // Funzione per leggere il valore di un cookie
  function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
  }

  // Funzione per compilare i campi del form con i dati dell'indirizzo selezionato
  function selezionaIndirizzo(card) {
    const nomeCognomeField = document.querySelector("#nomeCognome");
    const indirizzoField = document.querySelector("#indirizzo");
    const capField = document.querySelector("#cap");
    const comuneField = document.querySelector("#comune");
    const provinciaField = document.querySelector("#provincia");
    const telefonoField = document.querySelector("#telefono");

    // Estrai i dati dalla card
    const info = card.dataset.info.split(", ");
    const indirizzo = info[0]; // Via e numero civico
    const capCitta = info[1]; // CAP e città
    const paese = info[2]; // Paese

    // Compila i campi corrispondenti
    if (indirizzoField) indirizzoField.value = indirizzo || "";
    if (capField) capField.value = capCitta.split(" ")[0] || ""; // CAP
    if (comuneField) comuneField.value = capCitta.split(" ")[1] || ""; // Comune
    if (provinciaField) provinciaField.value = ""; // Provincia (non disponibile nei dati)
    if (telefonoField) telefonoField.value = ""; // Telefono (non disponibile nei dati)

    // Aggiorna l'ID dell'indirizzo selezionato
    selectedAddressId = card.dataset.id;

    // Mostra un alert con l'ID dell'indirizzo
    alert(`ID Indirizzo selezionato: ${selectedAddressId}`);
  }

  // Funzione per compilare i campi del form con i dati della carta selezionata
  function selezionaCarta(carta) {
    const numeroCartaField = document.querySelector("#numeroCarta");
    const meseScadenzaField = document.querySelector("#meseScadenza");
    const annoScadenzaField = document.querySelector("#annoScadenza");
    const cvvField = document.querySelector("#cvv");

    if (!carta.dataset.cardNumber || !carta.dataset.cardExpiry) {
      console.error("Errore: dati della carta mancanti!");
      return;
    }

    // Ottieni i dettagli della carta dal dataset
    const numeroCarta = carta.dataset.cardNumber;
    const scadenza = carta.dataset.cardExpiry.split("/"); // Assicurati che il formato sia "MM/YY"
    const meseScadenza = scadenza[0];
    const annoScadenza = scadenza[1];
    const cvv = carta.dataset.cardCvv || ""; // Aggiungi CVV se presente

    // Popola i campi del form
    if (numeroCartaField) numeroCartaField.value = numeroCarta;
    if (meseScadenzaField) meseScadenzaField.value = meseScadenza;
    if (annoScadenzaField) annoScadenzaField.value = annoScadenza;
    if (cvvField) cvvField.value = cvv;

    // Aggiorna l'ID del metodo di pagamento selezionato
    selectedPaymentMethodId = carta.dataset.id;

    // Mostra un alert con l'ID del metodo di pagamento
    alert(`ID Metodo di pagamento selezionato: ${selectedPaymentMethodId}`);

    // Chiudi il modale
    const cardModal = bootstrap.Modal.getInstance(document.querySelector("#creditCardModal"));
    if (cardModal) cardModal.hide();
  }

  // Aggiungi listener alle card degli indirizzi
  const addressCards = document.querySelectorAll(".selectable-address");
  addressCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaIndirizzo(card);

      // Chiudi il modale degli indirizzi
      const addressModalElement = document.querySelector("#addressModal");
      const addressModal = addressModalElement ? bootstrap.Modal.getInstance(addressModalElement) : null;
      if (addressModal) addressModal.hide();
    });
  });

  // Aggiungi listener alle card delle carte di credito
  const creditCardCards = document.querySelectorAll(".selectable-card");
  creditCardCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaCarta(card);

      // Chiudi il modale delle carte
      const cardModalElement = document.querySelector("#creditCardModal");
      const cardModal = cardModalElement ? bootstrap.Modal.getInstance(cardModalElement) : null;
      if (cardModal) cardModal.hide();
    });
  });

  // Funzione per confermare l'ordine
  const confirmOrderButton = document.querySelector("#confirmOrder");
  confirmOrderButton.addEventListener("click", async () => {
    try {
      // Recupera il carrello dal cookie
      const cartCookie = getCookie("cart");
      const cart = cartCookie ? JSON.parse(cartCookie) : []; // Decodifica il valore JSON

      // Verifica che i dati obbligatori siano presenti
      if (!cart.length) {
        alert("Il carrello è vuoto. Aggiungi prodotti per completare l'ordine.");
        return;
      }
      if (!selectedPaymentMethodId) {
        alert("Seleziona un metodo di pagamento valido.");
        return;
      }
      if (!selectedAddressId) {
        alert("Seleziona un indirizzo valido.");
        return;
      }

      // Mostra stato di elaborazione
      confirmOrderButton.innerHTML = "Elaborazione...";
      confirmOrderButton.disabled = true;

      // Invio dati al backend
      const response = await fetch("checkout.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          action: "confirmOrder",
          cart: cart, // Dati del carrello
          paymentMethodId: selectedPaymentMethodId, // ID del metodo di pagamento
          addressId: selectedAddressId, // ID dell'indirizzo
        }),
      });

      const result = await response.json();

      if (result.success) {
        alert("Ordine completato con successo!");
        document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"; // Cancella il cookie del carrello
        window.location.href = "utente.php"; // Reindirizza alla pagina di conferma
      } else {
        alert("Errore durante la creazione dell'ordine: " + result.message);
      }
    } catch (error) {
      console.error("Errore:", error);
      alert("Si è verificato un errore inatteso durante il completamento dell'ordine.");
    } finally {
      // Ripristina il pulsante
      confirmOrderButton.innerHTML = "Conferma l'ordine";
      confirmOrderButton.disabled = false;
    }
  });
});
