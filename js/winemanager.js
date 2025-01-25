document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-quantita").forEach(button => {
        button.addEventListener("click", function () {
            const vinoId = this.dataset.id;
            document.querySelector("#vinoId").value = vinoId;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-prodotto").forEach(button => {
        button.addEventListener("click", function () {
            const vinoId = this.dataset.id;

            // Esegui una chiamata AJAX per ottenere i dettagli del vino
            fetch(`api/get-wine-details.php?id=${vinoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector("#modificaVinoId").value = vinoId;
                        document.querySelector("#modificaPrezzo").value = data.vino.Prezzo;
                        document.querySelector("#modificaQuantitaMagazzino").value = data.vino.Quantita_Magazzino;
                        document.querySelector("#modificaFoto").value = data.vino.Foto;
                        document.querySelector("#modificaTitoloIT").value = data.vino.Titolo_IT;
                        document.querySelector("#modificaSottotitoloIT").value = data.vino.Sottotitolo_IT;
                        document.querySelector("#modificaDescrizioneIT").value = data.vino.Descrizione_IT;
                        document.querySelector("#modificaTitoloEN").value = data.vino.Titolo_EN;
                        document.querySelector("#modificaSottotitoloEN").value = data.vino.Sottotitolo_EN;
                        document.querySelector("#modificaDescrizioneEN").value = data.vino.Descrizione_EN;
                    } else {
                        console.error("Errore: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Errore nella richiesta:", data.message);
                });
        });
    });
});