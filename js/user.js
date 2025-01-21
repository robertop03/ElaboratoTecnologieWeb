document.addEventListener("DOMContentLoaded", () => {
  // CODICE PER CHIUDERE ALTRI EVENTUALI MODALI APERTI
  const modalTriggers = document.querySelectorAll("[data-bs-toggle='modal']");
  modalTriggers.forEach((trigger) => {
    const targetModalId = trigger.getAttribute("data-bs-target");
    const targetModal = document.querySelector(targetModalId);

    if (targetModal) {
      trigger.onclick = function (event) {
        event.preventDefault(); // Per evitare che il link href="#" scorra verso l'alto
      };
      targetModal.onhide = function () {
        // Rimuovi il focus dall'elemento attivo
        if (document.activeElement) {
          document.activeElement.blur();
        }
      };
    }
  });

  // ==============================
  // Gestione degli indirizzi
  // ==============================
  const addNewAddressModal = document.querySelector("#addNewAddressModal");

  // Resetta il form quando si apre il modale per aggiungere un indirizzo
  addNewAddressModal.addEventListener("show.bs.modal", () => {
    document.querySelector("#address").value = "";
    document.querySelector("#numeroCivico").value = "";
    document.querySelector("#postalCode").value = "";
    document.querySelector("#city").value = "";
    document.querySelector("#country").value = "";

    const saveButton = document.querySelector("#addNewAddressModal .btn-primary");
    saveButton.textContent = "Aggiungi Indirizzo";
    delete saveButton.dataset.id;
  });

  // Assegna eventi di modifica agli indirizzi esistenti
  document.querySelectorAll(".selectable-address").forEach((address) => {
    address.addEventListener("click", function () {
      const addressText = this.querySelector(".address-text").textContent.trim();
      const [line1, capCity, country] = addressText.split("\n");
      const [via, numeroCivico] = line1.split(", ");
      const [cap, city] = capCity.split(" ");

      document.querySelector("#address").value = via.trim();
      document.querySelector("#numeroCivico").value = numeroCivico.trim();
      document.querySelector("#postalCode").value = cap.trim();
      document.querySelector("#city").value = city.trim();
      document.querySelector("#country").value = country.trim();

      const saveButton = document.querySelector("#addNewAddressModal .btn-primary");
      saveButton.textContent = "Modifica Indirizzo";
      saveButton.dataset.id = this.dataset.id;
    });
  });

  // Salva un nuovo indirizzo o aggiorna uno esistente
  document.querySelector("#addNewAddressModal .btn-primary").addEventListener("click", function (event) {
    event.preventDefault();

    const address = document.querySelector("#address").value.trim();
    const numeroCivico = document.querySelector("#numeroCivico").value.trim();
    const postalCode = document.querySelector("#postalCode").value.trim();
    const city = document.querySelector("#city").value.trim();
    const country = document.querySelector("#country").value.trim();
    const id = this.dataset.id || null;

    if (!address || !numeroCivico || !postalCode || !city || !country) {
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
        submit_form: "addAddress",
        address: address,
        numeroCivico: numeroCivico,
        cap: postalCode,
        city: city,
        country: country,
        id: id || "",
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Aggiorna la lista degli indirizzi
          if (id) {
            const addressItem = document.querySelector(`.address-card[data-id="${id}"]`);
            if (addressItem) {
              addressItem.querySelector(".address-text").innerHTML = `
                ${address}, ${numeroCivico}<br />
                ${postalCode} ${city}<br />
                ${country}
              `;
            }
          } else {
            const addressList = document.querySelector(".address-list");
            const newAddressItem = document.createElement("div");
            newAddressItem.classList.add("address-card", "selectable-address");
            newAddressItem.dataset.id = data.id; // ID ritornato dal server
            newAddressItem.innerHTML = `
              <p class="address-text">
                ${address}, ${numeroCivico}<br />
                ${postalCode} ${city}<br />
                ${country}
              </p>
            `;
            addressList.insertBefore(newAddressItem, document.querySelector(".add-address-card"));
          }

          // Chiudi il modale
          const modalInstance = bootstrap.Modal.getInstance(addNewAddressModal);
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
