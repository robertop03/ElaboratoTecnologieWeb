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

    // Compila i campi corrispondenti
    if (indirizzoField) indirizzoField.value = indirizzo || "";
    if (capField) capField.value = capCitta.split(" ")[0] || ""; // CAP
    if (comuneField) comuneField.value = capCitta.split(" ")[1] || ""; // Comune

    // Aggiorna l'ID dell'indirizzo selezionato
    selectedAddressId = card.dataset.id;
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

    // Popola i campi del form
    if (numeroCartaField) numeroCartaField.value = numeroCarta;
    if (meseScadenzaField) meseScadenzaField.value = meseScadenza;
    if (annoScadenzaField) annoScadenzaField.value = annoScadenza;

    // Aggiorna l'ID del metodo di pagamento selezionato
    selectedPaymentMethodId = carta.dataset.id;
  }

  // Aggiungi listener alle card degli indirizzi
  const addressCards = document.querySelectorAll(".selectable-address");
  addressCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaIndirizzo(card);
      const addressModalElement = document.querySelector("#addressModal");
      const addressModal = addressModalElement
        ? bootstrap.Modal.getInstance(addressModalElement)
        : null;
      if (addressModal) addressModal.hide();
    });
  });

  // Aggiungi listener alle card delle carte di credito
  const creditCardCards = document.querySelectorAll(".selectable-card");
  creditCardCards.forEach((card) => {
    card.addEventListener("click", () => {
      selezionaCarta(card);
      const cardModalElement = document.querySelector("#creditCardModal");
      const cardModal = cardModalElement
        ? bootstrap.Modal.getInstance(cardModalElement)
        : null;
      if (cardModal) cardModal.hide();
    });
  });

  // Funzione per confermare l'ordine
  const confirmOrderButton = document.querySelector("#confirmOrder");
  const orderModal = new bootstrap.Modal(document.querySelector("#orderModal"));
  const orderModalTitle = document.querySelector("#orderModalLabel");
  const orderModalBody = document.querySelector("#orderModal .modal-body");

  confirmOrderButton.addEventListener("click", async () => {
    try {
      // Recupera il carrello dal cookie
      const cartCookie = getCookie("cart");
      const cart = cartCookie ? JSON.parse(cartCookie) : [];

      // Verifica che i dati obbligatori siano presenti
      if (!cart.length) {
        orderModalTitle.textContent = "Errore";
        orderModalBody.innerHTML = "<p class='text-danger'>Il carrello è vuoto. Aggiungi prodotti per completare l'ordine.</p>";
        orderModal.show();
        return;
      }
      if (!selectedPaymentMethodId) {
        orderModalTitle.textContent = "Errore";
        orderModalBody.innerHTML = "<p class='text-danger'>Seleziona un metodo di pagamento valido.</p>";
        orderModal.show();
        return;
      }
      if (!selectedAddressId) {
        orderModalTitle.textContent = "Errore";
        orderModalBody.innerHTML = "<p class='text-danger'>Seleziona un indirizzo valido.</p>";
        orderModal.show();
        return;
      }

      confirmOrderButton.textContent = "Elaborazione...";
      confirmOrderButton.disabled = true;

      const response = await fetch("checkout.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          action: "confirmOrder",
          cart: cart,
          paymentMethodId: selectedPaymentMethodId,
          addressId: selectedAddressId,
        }),
      });

      const result = await response.json();

      if (result.success) {
        orderModalTitle.textContent = "Ordine completato";
        orderModalBody.innerHTML = "<p class='text-success'>Il tuo ordine è stato preso in carico con successo. Grazie per il tuo acquisto!</p>";
        document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      } else {
        orderModalTitle.textContent = "Errore";
        orderModalBody.innerHTML = `<p class='text-danger'>Errore durante la creazione dell'ordine: ${result.message}</p>`;
      }
      orderModal.show();
    } catch (error) {
      console.error("Errore:", error);
      orderModalTitle.textContent = "Errore";
      orderModalBody.innerHTML = "<p class='text-danger'>Si è verificato un errore inatteso durante il completamento dell'ordine.</p>";
      orderModal.show();
    } finally {
      confirmOrderButton.textContent = "Conferma l'ordine";
      confirmOrderButton.disabled = false;
    }
  });
});