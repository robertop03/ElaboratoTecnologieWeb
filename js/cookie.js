function acceptCookies() {
  document.cookie = "cookiesAccepted=true; max-age=86400; path=/" // Cookie valido per 1 giorno
  document.querySelector("#cookieConsent").style.display = "none"
}
window.onload = function () {
  if (!document.cookie.split("; ").find((row) => row.startsWith("cookiesAccepted"))) {
    document.querySelector("#cookieConsent").style.display = "block"
  }
}
