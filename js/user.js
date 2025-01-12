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
        document.getElementById("address").value = address.trim();
        document.getElementById("city").value = city.trim();
        document.getElementById("province").value = province.trim();
        document.getElementById("postalCode").value = postalCode.trim();
  
        // Cambia il titolo del modale e il testo del pulsante
        document.getElementById("addNewAddressLabel").textContent = "Modifica indirizzo";
        const formButton = document.querySelector("#addNewAddressModal .btn-primary");
        formButton.textContent = "Conferma modifiche";
  
        // Aggiungi un attributo data-id al pulsante per identificare quale indirizzo stai modificando (opzionale)
        formButton.dataset.id = addressCard.dataset.id;
  
        // Mostra il modale
        const addNewAddressModal = new bootstrap.Modal(document.getElementById("addNewAddressModal"));
        addNewAddressModal.show();
      });
    });
  
    // Pulsante per confermare modifiche
    const formButton = document.querySelector("#addNewAddressModal .btn-primary");
    formButton.addEventListener("click", function (event) {
      event.preventDefault();
  
      // Ottieni i dati aggiornati dai campi del modale
      const updatedAddress = document.getElementById("address").value;
      const updatedCity = document.getElementById("city").value;
      const updatedProvince = document.getElementById("province").value;
      const updatedPostalCode = document.getElementById("postalCode").value;
  
      // Trova la scheda corrispondente e aggiorna i dati
      const addressCard = document.querySelector(`.address-card[data-id="${this.dataset.id}"]`);
      if (addressCard) {
        addressCard.querySelector(".address-text").innerHTML = `
          ${updatedAddress}, ${updatedCity} ${updatedProvince}<br />
          ${updatedPostalCode}
        `;
      }
  
      // Chiudi il modale
      const addNewAddressModal = bootstrap.Modal.getInstance(document.getElementById("addNewAddressModal"));
      addNewAddressModal.hide();
    });
  });
      