<!-- Main content: caroselli -->
<div class="content-main">
  <!-- CAROUSEL BEST SELLER PRODUCTS -->
  <div class="carousel slide mb-4" id="carouselBestSeller" data-bs-ride="carousel">
    <h2>I più venduti</h2>
    <p>Scopri i nostri prodotti più venduti, scelti dai nostri clienti. Unisciti a loro e prova anche tu queste fantastiche etichette!</p>
    <div class="carousel-inner text-center">
      <div class="carousel-item active">
        <img src="resources/img/vino1.jpg" alt="Vino 1" class="d-block w-100" />
      </div>
      <div class="carousel-item">
        <img src="resources/img/vino2.jpg" alt="Vino 2" class="d-block w-100" />
      </div>
      <div class="carousel-item">
        <img src="resources/img/vino3.jpg" alt="Vino 3" class="d-block w-100" />
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
        <img src="resources/img/evento1.png" alt="Evento 1" class="d-block w-100" />
      </div>
      <div class="carousel-item">
        <img src="resources/img/evento2.png" alt="Evento 2" class="d-block w-100" />
      </div>
      <div class="carousel-item">
        <img src="resources/img/evento3.png" alt="Evento 3" class="d-block w-100" />
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
        <!-- <a href="https://maps.app.goo.gl/qrVCVyX85zjw7Xta6" target="_blank"> -->
        <a href="dovecitroviamo.html" target="_blank">
          <img src="resources/img/maps.png" alt="Mappa Cesena" class="img-fluid rounded shadow" />
        </a>
      </div>
      <div class="col-md-6">
        <p>Ci troviamo a Cesena, a 10 minuti dall'Ippodromo e a pochi minuti dall'ospedale Bufalini.</p>
      </div>
    </div>
    <hr class="my-4" />
    <h3 class="fw-bold">Newsletter</h3>
    <p>Rimani aggiornato sui nuovi arrivi e sui prossimi eventi!</p>
    <form>
      <div class="mb-3">
        <label for="email" class="form-label">Indirizzo Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" required />
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="newArrivals" />
        <label class="form-check-label" for="newArrivals"> Voglio ricevere notizie riguardo ai nuovi arrivi </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="events" />
        <label class="form-check-label" for="events"> Voglio ricevere notizie riguardo ai nuovi eventi </label>
      </div>
      <button type="submit" class="btn mt-3 px-5 py-2">Invia</button>
    </form>
  </div>
</aside>
<!-- END ASIDE -->