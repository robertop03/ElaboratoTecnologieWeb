document.addEventListener("DOMContentLoaded", () => {
  // Intercetta il click su un link "Modifica"
  document.querySelectorAll(".edit-link").forEach(link => {
    link.addEventListener("click", function (event) {
      event.preventDefault(); // Evita il comportamento predefinito del link

      // Trova l'elemento della scheda associata
      const addressCard = this.closest(".address-card");
      if (!addressCard) {
        console.error("Errore: Impossibile trovare la scheda associata.");
        return;
      }

      // Estrai i dati dalla scheda
      const addressText = addressCard.querySelector(".address-text").textContent.trim();
      const [addressLine, postalCity] = addressText.split("\n");
      const [address, cityProvince] = addressLine.split(", ");
      const [city, province] = cityProvince.split(" ");
      const postalCode = postalCity.trim();

      // Compila i campi del modale
      document.querySelector("#address").value = address.trim();
      document.querySelector("#city").value = city.trim();
      document.querySelector("#province").value = province.trim();
      document.querySelector("#postalCode").value = postalCode.trim();

      // Cambia il titolo del modale e il testo del pulsante
      document.querySelector("#addNewAddressLabel").textContent = "Modifica indirizzo";
      const formButton = document.querySelector("#addNewAddressModal .btn-primary");
      formButton.textContent = "Conferma modifiche";

      // Aggiungi un attributo data-id al pulsante per identificare quale indirizzo stai modificando (opzionale)
      formButton.dataset.id = addressCard.dataset.id;

      // Mostra il modale
      const addNewAddressModal = new bootstrap.Modal(document.querySelector("#addNewAddressModal"));
      addNewAddressModal.show();
    });
  });

  // Pulsante per confermare modifiche
  const formButton = document.querySelector("#addNewAddressModal .btn-primary");
  formButton.addEventListener("click", function (event) {
    event.preventDefault();

    // Ottieni i dati aggiornati dai campi del modale
    const updatedAddress = document.querySelector("#address").value;
    const updatedCity = document.querySelector("#city").value;
    const updatedProvince = document.querySelector("#province").value;
    const updatedPostalCode = document.querySelector("#postalCode").value;

    // Trova la scheda corrispondente e aggiorna i dati
    const addressCard = document.querySelector(`.address-card[data-id="${this.dataset.id}"]`);
    if (addressCard) {
      addressCard.querySelector(".address-text").innerHTML = `
        ${updatedAddress}, ${updatedCity} ${updatedProvince}<br />
        ${updatedPostalCode}
      `;
    }

    // Chiudi il modale
    const addNewAddressModal = bootstrap.Modal.getInstance(document.querySelector("#addNewAddressModal"));
    addNewAddressModal.hide();
  });

  // ==============================
  // Modali per gli ordini
  // ==============================

  const orders = {
    AT325D: {
      image: "../resources/img/vino1.jpg", // Immagine prodotto
      quantity: 2,
      unitPrice: "22€",
      status: "Spedito",
    },
    PO124R: {
      image: "https://via.placeholder.com/150",
      quantity: 1,
      unitPrice: "25€",
      status: "In consegna",
    },
    RE642E: {
      image: "https://via.placeholder.com/150",
      quantity: 3,
      unitPrice: "12€",
      status: "In elaborazione",
    },
  };

  // Assegna l'evento di clic e doppio clic alle schede degli ordini
  document.querySelectorAll(".order-item").forEach((item) => {
    item.addEventListener("dblclick", function () {
      openOrderDetailsModal(item.dataset.orderId);
    });

    item.querySelector(".details-link").addEventListener("click", function (e) {
      e.preventDefault();
      openOrderDetailsModal(item.closest(".order-item").dataset.orderId);
    });
  });

  // Funzione per aprire il modale dei dettagli dell'ordine
  function openOrderDetailsModal(orderId) {
    const orderDetails = orders[orderId];

    if (orderDetails) {
      document.querySelector(".product-image").src = orderDetails.image;
      document.querySelector(".product-quantity").textContent = `Quantità: ${orderDetails.quantity}`;
      document.querySelector(".product-unit-price").textContent = `Prezzo unitario: ${orderDetails.unitPrice}`;
      document.querySelector(".order-status").textContent = `Stato: ${orderDetails.status}`;
    }

    const orderDetailsModal = new bootstrap.Modal(document.querySelector("#orderDetailsModal"));
    orderDetailsModal.show();

    // Evento per assicurarsi che la pagina venga ripristinata correttamente al termine
    const modalElement = document.querySelector("#orderDetailsModal");
    modalElement.addEventListener("hidden.bs.modal", removeBackdrop);
  }

  // Funzione per rimuovere manualmente il backdrop
  function removeBackdrop() {
    const backdrop = document.querySelector(".modal-backdrop");
    if (backdrop) {
      backdrop.remove();
    }
    document.body.classList.remove("modal-open");
    document.body.style.paddingRight = ""; // Ripristina lo stato del body
  }
});
