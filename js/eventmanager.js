document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-evento").forEach(button => {
    button.addEventListener("click", function () {
        const eventoId = this.dataset.id;

        fetch(`api/get-event-details.php?id=${eventoId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const evento = data.evento;

                    // Popola i campi generali dell'evento
                    document.querySelector("#modificaEventoId").value = evento.ID_Evento;
                    document.querySelector("#modificaDataInizio").value = evento.Data_Inizio;
                    document.querySelector("#modificaDataFine").value = evento.Data_Fine;
                    document.querySelector("#modificaFoto").value = evento.Foto;

                    // Popola i campi per la lingua italiana
                    document.querySelector("#modificaTitoloIT").value = evento.Titolo_IT;
                    document.querySelector("#modificaSottotitoloIT").value = evento.Sottotitolo_IT;
                    document.querySelector("#modificaDescrizioneIT").value = evento.Descrizione_IT;

                    // Popola i campi per la lingua inglese
                    document.querySelector("#modificaTitoloEN").value = evento.Titolo_EN;
                    document.querySelector("#modificaSottotitoloEN").value = evento.Sottotitolo_EN;
                    document.querySelector("#modificaDescrizioneEN").value = evento.Descrizione_EN;

                    // Mostra il modale
                    const modificaModal = new bootstrap.Modal(document.querySelector("#modificaEventoModal"));

                    modificaModal.show();
                } else {
                    console.error("Errore: " + data.message);
                }
            })
            .catch(error => {
                console.error("Errore:", data.message);
            });
        });
    });




    document.querySelectorAll(".btn-elimina-evento").forEach(button => {
        button.addEventListener("click", function () {
            const eventoId = this.dataset.id;
            
            fetch("api/eliminaevento.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ idEvento: eventoId })
            })
            .then(response => response.json())
            .then(data => {
                    window.location.reload();
            })
            .catch(error => {
                console.error("Errore:", data.message);
            });
            
        });
    });

    // Forza la rimozione del backdrop <- risoluzione a bug di mancata chiusura corretta modale modifica evento
    document.querySelector("#modificaEventoModal").addEventListener("hidden.bs.modal", function () {
        const backdrops = document.querySelectorAll(".modal-backdrop");
        backdrops.forEach(backdrop => backdrop.remove());
    });
});