
function acceptCookies() {
    document.cookie = "cookiesAccepted=true; max-age=86400; path=/"; // Cookie valido per 1 giorno
    document.getElementById('cookieConsent').style.display = 'none';
}
window.onload = function() {
    if (!document.cookie.split('; ').find(row => row.startsWith('cookiesAccepted'))) {
        document.getElementById('cookieConsent').style.display = 'block';
    }
}

  