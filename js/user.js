document.addEventListener("DOMContentLoaded", () => {
  // ==============================
  // Gestione delle carte di credito
  // ==============================
  const addNewCardModal = document.querySelector("#addNewPaymentMethodModal");

  // Resetta il form quando si apre il modale per aggiungere una carta
  addNewCardModal.addEventListener("show.bs.modal", () => {
    document.querySelector("#cardNumber").value = "";
    document.querySelector("#expiryMonth").value = "";
    document.querySelector("#expiryYear").value = "";

    const saveButton = document.querySelector("#addNewPaymentMethodModal .btn-primary");
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

      const saveButton = document.querySelector("#addNewPaymentMethodModal .btn-primary");
      saveButton.textContent = "Modifica Carta";
      saveButton.dataset.id = this.dataset.id;
    });
  });

  // Salva una nuova carta o aggiorna una esistente
  document.querySelector("#addNewPaymentMethodModal .btn-primary").addEventListener("click", function (event) {
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
  // Gestione degli indirizzi
  // ==============================
  const addNewAddressModal = document.querySelector("#addNewAddressModal");

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
            newAddressItem.dataset.id = data.id;
            newAddressItem.innerHTML = `
              <p class="address-text">
                ${address}, ${numeroCivico}<br />
                ${postalCode} ${city}<br />
                ${country}
              </p>
            `;
            addressList.insertBefore(newAddressItem, document.querySelector(".add-address-card"));
          }

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
  // Gestione ordini
  // ==============================
  const ordersModal = document.querySelector("#ordersModal");
  const ordersList = document.querySelector(".orders-list");

  document.querySelectorAll("[data-bs-target='#ordersModal']").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      if (ordersList && ordersList.children.length === 0) {
        fetch("utente.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({ action: "getOrders" }),
        })
          .then((response) => response.json())
          .then((orders) => {
            ordersList.innerHTML = "";
            if (orders.length > 0) {
              orders.forEach((order) => {
                const orderItem = document.createElement("div");
                orderItem.classList.add("order-item");
                orderItem.dataset.orderId = order.ID_Ordine;

                orderItem.innerHTML = `
                  <p class="fw-bold ms-2">
                    ${order.ID_Ordine}
                  </p>
                  <hr>
                  <p class="ms-2">Creato il: ${order.Data_Creazione}</p>
                  <p class="ms-2">Totale: ${parseFloat(order.Totale).toFixed(2)}€</p>
                  <p class="ms-2">Stato: ${order.Stato}</p>
                `;
                ordersList.appendChild(orderItem);
              });
            } else {
              ordersList.innerHTML = `<p class="text-muted">Nessun ordine trovato.</p>`;
            }
          })
          .catch((error) => {
            console.error("Errore durante il caricamento degli ordini:", error);
          });
      }
    });
  });

  // ==============================
  // Gestione dei dettagli ordine
  // ==============================
  document.querySelectorAll(".details-link").forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();

      const orderId = link.closest(".order-item").dataset.orderId;

      const modalBody = document.querySelector("#orderDetailsModal .modal-body");
      modalBody.innerHTML = `
        <div class="d-flex justify-content-center my-3">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      `;

      // Richiesta al server per ottenere i dettagli dell'ordine
      fetch("utente.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "getOrderDetails",
          orderId: orderId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          modalBody.innerHTML = ""; // Reset del contenuto del modale

          if (data.success) {
            data.details.forEach((product, index) => {
              modalBody.innerHTML += `
                <div class="product-details">
                  <img src="resources/img/${product.Foto}" class="img-fluid product-image" alt="${product.Nome}">
                  <div class="order-info">
                    <p class="fw-bold">Nome: ${product.Nome}</p>
                    <p>Quantità: ${product.Quantità}</p>
                    <p>Prezzo: ${product.Prezzo.toFixed(2)}€</p>
                  </div>
                </div>
              `;
              if (index < data.details.length - 1) {
                modalBody.innerHTML += "<hr>"; // Linea orizzontale tra i prodotti
              }
            });            
          } else {
            modalBody.innerHTML = "<p>Nessun dettaglio disponibile.</p>";
          }
        })
        .catch(() => {
          modalBody.innerHTML = "<p>Errore nel caricamento dei dettagli.</p>";
        });
    });
  });
});
