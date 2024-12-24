document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".toggle-password").forEach((button) => {
    button.addEventListener("click", function () {
      const input = this.parentElement.querySelector("input")
      if (input.type === "password") {
        input.type = "text"
        this.innerHTML = '<i class="bi bi-eye-slash"></i>'
      } else {
        input.type = "password"
        this.innerHTML = '<i class="bi bi-eye"></i>'
      }
    })
  })

  const dropdownMenu = document.getElementById("dropdownMenuLink")
  if (!dropdownMenu) {
    console.error("Elemento con id 'dropdownMenuLink' non trovato!")
    return
  }
  const dropdownItems = document.querySelectorAll(".dropdown-item")
  dropdownItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault() // Evita il comportamento predefinito del link

      // Ottieni l'immagine e il testo dell'elemento cliccato
      const selectedImage = this.querySelector("img").src
      const selectedText = this.textContent.trim()

      // Aggiorna il pulsante principale
      const dropdownImg = dropdownMenu.querySelector("img")
      dropdownImg.src = selectedImage
      dropdownMenu.textContent = "" // Pulisci il contenuto del pulsante
      dropdownMenu.appendChild(dropdownImg) // Aggiungi l'immagine
      dropdownMenu.append(" " + selectedText) // Aggiungi il testo
    })
  })
})
