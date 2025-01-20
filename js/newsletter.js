document.addEventListener("DOMContentLoaded", () => {
  // Definizione della funzione per l'invio dei dati tramite fetch
  async function sendNewsletterRequest(url, data) {
    try {
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }

      const result = await response.json()
    } catch (error) {
      console.error("Errore nella richiesta:", error)
    }
  }

  // Selezione dei form e gestione degli eventi
  const subscribeForm = document.querySelector("#subscribe-form")
  if (subscribeForm) {
    subscribeForm.onsubmit = (event) => {
      const formData = new FormData(subscribeForm)
      const data = Object.fromEntries(formData.entries())
      sendNewsletterRequest("api/update-newsletter.php", data)
    }
  }

  const unsubscribeForm = document.querySelector("#unsubscribe-form")
  if (unsubscribeForm) {
    unsubscribeForm.onsubmit = (event) => {
      const formData = new FormData(unsubscribeForm)
      const data = Object.fromEntries(formData.entries())
      sendNewsletterRequest("api/update-newsletter.php", data)
    }
  }
})
