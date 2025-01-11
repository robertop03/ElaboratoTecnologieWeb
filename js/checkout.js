document.addEventListener("DOMContentLoaded", () => {
  const indirizzi = [
      { nome: "Mario Rossi", indirizzo: "Via delle Rose, 10", cap: "10100", città: "Torino", telefono: "3331234567" },
      { nome: "Luigi Verdi", indirizzo: "Via Roma, 20", cap: "20100", città: "Milano", telefono: "3397654321" },
      { nome: "Anna Bianchi", indirizzo: "Via Garibaldi, 5", cap: "30100", città: "Venezia", telefono: "3274567890" }
  ];

  const addressList = document.querySelector("#address-list");
  const addressModal = new bootstrap.Modal(document.querySelector("#addressModal"));

  // Funzione per creare le card
  function mostraIndirizzi() {
      addressList.innerHTML = ""; // Pulisce prima di popolare
      indirizzi.forEach((indirizzo, index) => {
          const card = document.createElement("div");
          card.className = "selectable-address";
          card.dataset.index = index;
          card.innerHTML = `
              <hr>
              <strong>${indirizzo.nome}</strong><br />
              ${indirizzo.indirizzo}<br />
              ${indirizzo.cap} ${indirizzo.città}<br />
              Tel: ${indirizzo.telefono}
          `;
          card.addEventListener("click", () => selezionaIndirizzo(indirizzo, card));
          addressList.appendChild(card);
      });
  }

  // Funzione per gestire la selezione di un indirizzo
  function selezionaIndirizzo(indirizzo, card) {
      document.querySelectorAll(".selectable-address").forEach(c => c.classList.remove("active"));
      card.classList.add("active");

      document.querySelector("#nomeCognome").value = indirizzo.nome;
      document.querySelector("#indirizzo").value = indirizzo.indirizzo;
      document.querySelector("#cap").value = indirizzo.cap;
      document.querySelector("#comune").value = indirizzo.città;
      document.querySelector("#telefono").value = indirizzo.telefono;

      addressModal.hide(); // Chiude il modale
  }

  // Mostra il modale
  document.querySelector(".custom-link[data-bs-target='#addressModal']").addEventListener("click", () => {
      mostraIndirizzi();
      addressModal.show();
  });

  // Popola i campi col primo indirizzo come esempio
  document.querySelector("#use-address").addEventListener("click", () => {
      const primoIndirizzo = indirizzi[0];
      document.querySelector("#nomeCognome").value = primoIndirizzo.nome;
      document.querySelector("#indirizzo").value = primoIndirizzo.indirizzo;
      document.querySelector("#cap").value = primoIndirizzo.cap;
      document.querySelector("#comune").value = primoIndirizzo.città;
      document.querySelector("#telefono").value = primoIndirizzo.telefono;
  });

  mostraIndirizzi(); // Chiamata iniziale
});