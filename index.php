<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - &lt;/vino&gt;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar bg-light p-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <img src="resources/icons/menu.png" alt="Menu" class="mx-3" style="height: 30px;">
            <img src="resources/img/logoWeb.jpeg" alt="Logo" class="mx-auto" style="height: 40px;">
            <div class="d-flex">
                <img src="resources/icons/empty-cart.png" alt="Carrello" class="me-3" style="height: 30px;">
                <img src="resources/icons/user.png" alt="Utente" style="height: 30px;">
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- MAIN SECTION -->
    <main class="content-wrapper">
        <!-- Main content: caroselli -->
        <div class="content-main">
            <!-- CAROUSEL BEST SELLER PRODUCTS -->
            <div class="carousel slide mb-4" id="carouselBestSeller" data-bs-ride="carousel">
                <h2>I più venduti</h2>
                <p>Scopri i nostri prodotti più venduti, scelti dai nostri clienti. Unisciti a loro e prova anche tu queste fantastiche etichette!</p>
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <img src="../resources/img/vino1.jpg" alt="Vino 1" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../resources/img/vino2.jpg" alt="Vino 2" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../resources/img/vino3.jpg" alt="Vino 3" class="d-block w-100">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselBestSeller" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselBestSeller" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- END CAROUSEL BEST SELLER PRODUCTS -->

            <!-- CAROUSEL EVENTS -->
            <div class="carousel slide mb-4" id="carouselEvents" data-bs-ride="carousel">
                <h2>Eventi</h2>
                <p>Non perdere gli eventi più esclusivi organizzati da noi. Partecipa e vivi esperienze uniche nel mondo del vino!</p>
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <img src="../resources/img/evento1.png" alt="Evento 1" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../resources/img/evento2.png" alt="Evento 2" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../resources/img/evento3.png" alt="Evento 3" class="d-block w-100">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselEvents" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselEvents" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- END CAROUSEL EVENTS -->

        </div>

        <!-- ASIDE -->
        <aside>
            <div class="container">
                <h3 class="fw-bold">Dove siamo?</h3>
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <a href="https://maps.app.goo.gl/qrVCVyX85zjw7Xta6" target="_blank">
                            <img src="../resources/img/maps.png" alt="Mappa Cesena" class="img-fluid rounded shadow">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <p>Ci troviamo a Cesena, a 10 minuti dall'Ippodromo e a pochi minuti dall'ospedale Bufalini.</p>
                    </div>
                </div>
                <hr class="my-4">
                <h3 class="fw-bold">Newsletter</h3>
                <p>Rimani aggiornato sui nuovi arrivi e sui prossimi eventi!</p>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Indirizzo Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newArrivals">
                        <label class="form-check-label" for="newArrivals">
                            Voglio ricevere notizie riguardo ai nuovi arrivi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="events">
                        <label class="form-check-label" for="events">
                            Voglio ricevere notizie riguardo ai nuovi eventi
                        </label>
                    </div>
                    <button type="submit" class="btn mt-3 px-5 py-2">Invia</button>
                </form>
            </div>
        </aside>
        <!-- END ASIDE -->
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-4 custom-footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-lock fs-1 me-3"></i>
                    <div>
                        <h5><strong>SHOPPING SICURO</strong></h5>
                        <p>I tuoi <strong>pagamenti online</strong> sono protetti e accettiamo anche il <strong>pagamento alla consegna</strong></p>
                    </div>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-truck fs-1 me-3"></i>
                    <div>
                        <h5><strong>COSTI DI SPEDIZIONE</strong></h5>
                        <p><strong>Gratis</strong> per gli ordini sopra i <strong>69€</strong>, altrimenti la spedizione è di 7.75€</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-telephone fs-1 me-3"></i>
                    <div>
                        <h5><strong>CONTATTACI</strong></h5>
                        <p>Consulta la <strong>nostra guida</strong> o contatta il nostro <strong>servizio clienti</strong> per ottenere maggiori informazioni e ricevere assistenza</p>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col">
                    <img src="resources/img/logoWeb.jpeg" alt="Logo" class="img-fluid logo-footer">
                    <p class="mt-2">/vino copyright © 2024</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-qWi83VRvCCTBpBftVbI7Av9IquC/q9nlgVpbdVHsVOz7z9WsXBxl8W9K+KZ+pU8C" crossorigin="anonymous"></script>
</body>
</html>