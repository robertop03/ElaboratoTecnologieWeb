// JavaScript aggiornato

// Apri il modale
document.getElementById("choose-address").addEventListener("click", function () {
    document.getElementById("modal").classList.remove("hidden");
  });
  
  // Chiudi il modale
  document.getElementById("close-modal").addEventListener("click", function () {
    document.getElementById("modal").classList.add("hidden");
  });
  
  // Seleziona un indirizzo dal modale
  document.querySelectorAll(".address-card").forEach((card) => {
    card.addEventListener("click", function () {
      const addressDetails = this.dataset.address.split(", ");
      document.getElementById("address").value = addressDetails[0];
      document.getElementById("zip").value = addressDetails[1];
      document.getElementById("city").value = addressDetails[2];
      document.getElementById("modal").classList.add("hidden");
    });
  });
  
  // Usa l'indirizzo attuale
  document.getElementById("use-current-address").addEventListener("click", function () {
    document.getElementById("address").value = "Via esempio 123";
    document.getElementById("zip").value = "47039";
    document.getElementById("city").value = "Italia";
  });
  