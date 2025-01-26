document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".btn-cambia-stato").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.dataset.id 

      // AJAX Request
      fetch("api/modifica-stato-ordine.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: id }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            console.log(`Azione completata per ID: ${id}`)
          } else {
            console.error(`Errore: ${data.message}`)
          }
          window.location.reload()
        })
        .catch((error) => {
          console.error("Errore nella richiesta:", error)
          window.location.reload()
        })
    })
  })
})
