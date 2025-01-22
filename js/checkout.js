document.addEventListener("DOMContentLoaded", () => {
  // Dati indirizzi salvati
  const indirizzi = [
    { nome: "Mario Rossi", indirizzo: "Via delle Rose, 10", cap: "10100", città: "Torino", telefono: "3331234567" },
    { nome: "Luigi Verdi", indirizzo: "Via Roma, 20", cap: "20100", città: "Milano", telefono: "3397654321" },
    { nome: "Anna Bianchi", indirizzo: "Via Garibaldi, 5", cap: "30100", città: "Venezia", telefono: "3274567890" }
  ];

  // Dati carte di credito salvate
  const carteCredito = [
    { nome: "VISA", numero: "4111111111111111", scadenzaMese: "12", scadenzaAnno: "2025", cvv: "123" },
    { nome: "MasterCard", numero: "4222222222222222", scadenzaMese: "01", scadenzaAnno: "2026", cvv: "456" },
    { nome: "PostePay", numero: "4333333333333333", scadenzaMese: "06", scadenzaAnno: "2027", cvv: "789" }
  ];

  const addressList = document.querySelector("#address-list");
  const addressModal = new bootstrap.Modal(document.querySelector("#addressModal"));

  const cardList = document.querySelector("#credit-card-list");
  const cardModal = new bootstrap.Modal(document.querySelector("#creditCardModal"));

  const orderCompletionModal = document.querySelector("#orderModal");

  // Funzione per creare le card degli indirizzi
  function mostraIndirizzi() {
    addressList.innerHTML = ""; // Pulisce prima di popolare
    indirizzi.forEach((indirizzo, index) => {
      const card = document.createElement("div");
      card.className = "selectable-address";
      card.dataset.index = index;
      card.innerHTML = `
        <h6>${indirizzo.nome}</h6>
        <hr>
        ${indirizzo.indirizzo}<br />
        ${indirizzo.cap} ${indirizzo.città}<br />
        Tel: ${indirizzo.telefono}
      `;
      card.addEventListener("click", () => selezionaIndirizzo(indirizzo, card));
      addressList.appendChild(card);
    });
  }

  // Funzione per creare le card delle carte
  function mostraCarte() {
    cardList.innerHTML = ""; // Pulisce prima di popolare
    carteCredito.forEach((carta, index) => {
      const card = document.createElement("div");
      card.className = "selectable-card";
      card.dataset.index = index;
      card.innerHTML = `
        <h6>${carta.nome}</h6>
        <hr>
        <p>**** **** **** ${carta.numero.slice(-4)}</p>
        Scadenza: ${carta.scadenzaMese}/${carta.scadenzaAnno}
      `;
      card.addEventListener("click", () => selezionaCarta(carta, card));
      cardList.appendChild(card);
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

  // Funzione per gestire la selezione di una carta
  function selezionaCarta(carta, card) {
    document.querySelectorAll(".selectable-card").forEach(c => c.classList.remove("active"));
    card.classList.add("active");

    document.querySelector("#numeroCarta").value = carta.numero;
    document.querySelector("#meseScadenza").value = carta.scadenzaMese;
    document.querySelector("#annoScadenza").value = carta.scadenzaAnno;
    document.querySelector("#cvv").value = carta.cvv;

    cardModal.hide(); // Chiude il modale
  }

  // Event Listener per aprire il modale degli indirizzi
  document.querySelector(".custom-link[data-bs-target='#addressModal']").addEventListener("click", () => {
    mostraIndirizzi();
    addressModal.show();
  });

  // Event Listener per aprire il modale delle carte
  document.querySelector(".custom-link[data-bs-target='#creditCardModal']").addEventListener("click", () => {
    mostraCarte();
    cardModal.show();
  });

  // Event Listener per "Usa questo indirizzo"
  document.querySelector("#use-address").addEventListener("click", () => {
    const primoIndirizzo = indirizzi[0];
    selezionaIndirizzo(primoIndirizzo, document.querySelectorAll(".selectable-address")[0]);
  });

  // Event Listener per "Usa questa carta"
  document.querySelector("#use-credit-card").addEventListener("click", () => {
    const primaCarta = carteCredito[0];
    selezionaCarta(primaCarta, document.querySelectorAll(".selectable-card")[0]);
  });

  // Listener per il redirect alla chiusura del modale di completamento ordine
  orderCompletionModal.addEventListener("hidden.bs.modal", () => {
    window.location.href = "./utente.php";
  });

  // Chiamate iniziali
  mostraIndirizzi();
  mostraCarte();
});
