<!-- Main content: caroselli -->
<div class="content-main">
  <!-- CAROUSEL BEST SELLER PRODUCTS -->
  <div class="carousel slide mb-4" id="carouselBestSeller" data-bs-ride="carousel">
    <h4 class="text-center text-sm-start"><?php echo $linguaAttuale == "en" ? "Best Sellers" : "I più venduti" ?></h4>
    <p class="text-center text-sm-start"><?php echo $linguaAttuale == "en" ? "Discover our best-selling products, chosen by our customers. Join them and try these amazing labels yourself!" : "Scopri i nostri prodotti più venduti, scelti dai nostri clienti. Unisciti a loro e prova anche tu queste fantastiche etichette!" ?></p>
    <div class="carousel-inner text-center">
        <?php 
        $isFirst = true;
        foreach ($templateParams["topSellingProducts"] as $product): 
        ?>
        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
            <!-- Link che porta alla pagina prodotto -->
            <a href="prodotto.php?id=<?php echo htmlspecialchars($product["ID_Prodotto"]); ?>">
                <img src="resources/img/<?php echo htmlspecialchars($product["Foto"]); ?>" alt="Prodotto <?php echo htmlspecialchars($product["ID_Prodotto"]); ?>" class="d-block w-100" />
                <!-- Titolo del prodotto -->
                <h5 class="mt-2"><?php echo htmlspecialchars($product["Titolo"]); ?></h5>
                <!-- Prezzo del prodotto -->
                <p class="text-muted"><?php echo number_format($product["Prezzo"], 2, ',', ' ') . ' €'; ?></p>
            </a>
        </div>
        <?php 
        $isFirst = false;
        endforeach; 
        ?>
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
    <h4 class="text-center text-sm-start">
        <?php echo $linguaAttuale == "en" ? "Events" : "Eventi" ?>
    </h4>
    <p class="text-center text-sm-start">
        <?php echo $linguaAttuale == "en" 
            ? "Don't miss the most exclusive events organized by us. Join us and experience unique moments in the world of wine!" 
            : "Non perdere gli eventi più esclusivi organizzati da noi. Partecipa e vivi esperienze uniche nel mondo del vino!" ?>
    </p>  
    <div class="carousel-inner text-center">
        <?php 
        $isFirst = true;
        foreach ($templateParams["events"] as $event): 
        ?>
        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
            <!-- Foto dell'evento -->
            <img src="resources/img/<?php echo htmlspecialchars($event["Foto"]); ?>" alt="<?php echo htmlspecialchars($event["Titolo"]); ?>" class="d-block w-100" />
            <!-- Testo dell'evento -->
            <h5><?php echo htmlspecialchars($event["Titolo"]); ?></h5>
                <p><?php echo htmlspecialchars($event["Sottotitolo"]); ?></p>
                <p class="text-muted">
                    <?php 
                    echo $linguaAttuale == "en" 
                        ? "From " . htmlspecialchars(date("F j, Y", strtotime($event["Data_Inizio"]))) . " to " . htmlspecialchars(date("F j, Y", strtotime($event["Data_Fine"]))) 
                        : "Dal " . htmlspecialchars(date("d/m/Y", strtotime($event["Data_Inizio"]))) . " al " . htmlspecialchars(date("d/m/Y", strtotime($event["Data_Fine"])));
                    ?>
                </p>
        </div>
        <?php 
        $isFirst = false;
        endforeach; 
        ?>
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
    <a href="dovecitroviamo.php" title="Dove ci troviamo">
      <h3 class="fw-bold"><?php echo $linguaAttuale == "en" ? "Where are we?" : "Dove siamo?" ?></h3>
    </a>
    <div class="row align-items-center mb-4">
      <div class="col-md-6">
        <a href="dovecitroviamo.php" target="_blank">
          <img src="resources/img/maps.png" alt="Mappa Cesena" class="img-fluid rounded shadow" />
        </a>
      </div>
      <div class="col-md-6">
        <a href="dovecitroviamo.php" title="Dove ci troviamo" >
          <p><?php echo $linguaAttuale == "en" ? "We are located in Cesena, 10 minutes from the Hippodrome and a few minutes from Bufalini Hospital" : "Ci troviamo a Cesena, a 10 minuti dall'Ippodromo e a pochi minuti dall'ospedale Bufalini" ?></p>
        </a>
      </div>
    </div>
    <hr class="my-4" />
    <h4 class="fw-bold mt-5">Newsletter</h>
    <p><?php echo $linguaAttuale == "en" ? "Keep up to date with new arrivals and upcoming events!" : "Rimani aggiornato sui nuovi arrivi e sui prossimi eventi!" ?></p>
    <?php
      $iscritto = $db->checkNewsletter(isset($_SESSION["email"]) ? $_SESSION["email"] : "");
      if (isset($_SESSION["email"]) && $iscritto[0]["Newsletter"] === "Y") {
        // Utente loggato e iscritto alla newsletter
        $email = $_SESSION["email"];
    ?>
    <p>Email: <strong><?php echo htmlspecialchars($email); ?></strong></p>
    <form id="unsubscribe-form">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="action" value="N" />
        <button type="submit" class="btn btn-danger"><?php echo $linguaAttuale == "en" ? "Unsubscribe from the Newsletter" : "Disiscriviti dalla Newsletter" ?></button>
    </form>
    <?php
      } else {
      // Utente non loggato
    ?>
    <form id="subscribe-form">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required />
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="newArrivals" id="newArrivals" required />
            <label class="form-check-label" for="newArrivals"> 
                <span class="text-danger">*</span>
                <?php echo $linguaAttuale == "en" ? "I want to receive news about new arrivals" : "Voglio ricevere notizie riguardo ai nuovi arrivi" ?>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="events" id="events" required />
            <label class="form-check-label" for="events">
                <span class="text-danger">*</span> 
                <?php echo $linguaAttuale == "en" ? "I want to receive news about new events" : "Voglio ricevere notizie riguardo ai nuovi eventi" ?>
            </label>
        </div>
        <input type="hidden" name="action" value="Y" />
        <button type="submit" class="btn mt-3 px-5 py-2"><?php echo $linguaAttuale == "en" ? "Send" : "Invia" ?></button>
    </form>
    <?php
    }
  ?>
  </div>
</aside>
<!-- END ASIDE -->