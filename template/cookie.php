<!-- Banner Cookie -->
<script src="js/cookie.js"></script>
<div id="cookieConsent" class="alert alert-dark fixed-bottom text-center m-0" role="alert">
    <div class="container">
        <p class="mb-2">
            <?php echo $linguaAttuale == "en" ? "We use cookies to enhance your experience. For more information, visit our " : "Utilizziamo i cookie per migliorare la tua esperienza. Per maggiori informazioni, visita la nostra " ?>
            <a href="#" class="alert-link text-decoration-underline"><?php echo $linguaAttuale == "en" ? "Cookie policy" : "Politica sui cookie" ?></a>.
        </p>
        <button onclick="acceptCookies();" class="btn btn-success btn-sm"><?php echo $linguaAttuale == "en" ? "Accept" : "Accetto" ?></button>
    </div>
</div>

