document.addEventListener("DOMContentLoaded", () => {
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
  });

  // ==============================
  // Gestione delle carte di credito
  // ==============================
  const addNewCardModal = document.querySelector("#addNewCardModal");

  // Resetta il form quando si apre il modale per aggiungere una carta
  addNewCardModal.addEventListener("show.bs.modal", () => {
    document.querySelector("#cardNumber").value = "";
    document.querySelector("#expiryMonth").value = "";
    document.querySelector("#expiryYear").value = "";

    const saveButton = document.querySelector("#addNewCardModal .btn-primary");
    saveButton.textContent = "Aggiungi Carta";
    delete saveButton.dataset.id;
  });

  // Assegna eventi di modifica alle carte esistenti
  document.querySelectorAll(".selectable-card").forEach((card) => {
    card.addEventListener("click", function () {
      const cardText = this.querySelector(".card-text").textContent.trim();
      const [cardNumber, expiry] = cardText.split("\n");
      const [month, year] = expiry.split("/");

      document.querySelector("#cardNumber").value = cardNumber.trim();
      document.querySelector("#expiryMonth").value = month.trim();
      document.querySelector("#expiryYear").value = year.trim();

      const saveButton = document.querySelector("#addNewCardModal .btn-primary");
      saveButton.textContent = "Modifica Carta";
      saveButton.dataset.id = this.dataset.id;
    });
  });

  // Salva una nuova carta o aggiorna una esistente
  document.querySelector("#addNewCardModal .btn-primary").addEventListener("click", function (event) {
    event.preventDefault();

    const cardNumber = document.querySelector("#cardNumber").value.trim();
    const expiryMonth = document.querySelector("#expiryMonth").value.trim();
    const expiryYear = document.querySelector("#expiryYear").value.trim();
    const id = this.dataset.id || null;

    if (!cardNumber || !expiryMonth || !expiryYear) {
      alert("Tutti i campi sono obbligatori.");
      return;
    }

    // Invio dei dati al server per l'aggiunta o la modifica
    fetch("utente.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        submit_form: "addPaymentMethod",
        numeroCarta: cardNumber,
        meseScadenza: expiryMonth,
        annoScadenza: expiryYear,
        id: id || "",
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Aggiorna la lista delle carte
          if (id) {
            const cardItem = document.querySelector(`.card-item[data-id="${id}"]`);
            if (cardItem) {
              cardItem.querySelector(".card-text").innerHTML = `
                ${cardNumber}<br />
                ${expiryMonth}/${expiryYear}
              `;
            }
          } else {
            const cardList = document.querySelector(".card-list");
            const newCardItem = document.createElement("div");
            newCardItem.classList.add("card-item", "selectable-card");
            newCardItem.dataset.id = data.id; // ID ritornato dal server
            newCardItem.innerHTML = `
              <p class="card-text">
                ${cardNumber}<br />
                ${expiryMonth}/${expiryYear}
              </p>
            `;
            cardList.insertBefore(newCardItem, document.querySelector(".add-card-item"));
          }

          // Chiudi il modale
          const modalInstance = bootstrap.Modal.getInstance(addNewCardModal);
          modalInstance.hide();
        } else {
          alert("Errore durante il salvataggio. Riprova.");
        }
      })
      .catch((error) => {
        console.error("Errore:", error);
      });
  });

  // ==============================
  // Gestione ordini (lasciato invariato)
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

  document.querySelectorAll(".order-item").forEach((item) => {
    item.addEventListener("dblclick", function () {
      openOrderDetailsModal(item.dataset.orderId);
    });

    item.querySelector(".details-link").addEventListener("click", function (e) {
      e.preventDefault();
      openOrderDetailsModal(item.closest(".order-item").dataset.orderId);
    });
  });

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

    const modalElement = document.querySelector("#orderDetailsModal");
    modalElement.addEventListener("hidden.bs.modal", removeBackdrop);
  }

  function removeBackdrop() {
    const backdrop = document.querySelector(".modal-backdrop");
    if (backdrop) {
      backdrop.remove();
    }
    document.body.classList.remove("modal-open");
    document.body.style.paddingRight = ""; // Ripristina lo stato del body
  }
});
