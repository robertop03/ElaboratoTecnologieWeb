<div class="container my-3 pb-5">
  <h1 class="fw-bold mb-4"><?php echo $linguaAttuale == "en" ? "Where are we?" : "Dove siamo?" ?></h1>
  <div class="mappa-testo">
    <div>
      <a href="https://maps.google.com/?q=Cesena" target="_blank">
        <img src="resources/img/maps.png" alt="Mappa di Cesena" class="img-fluid rounded shadow" />
      </a>
    </div>
    <div>
      <p><?php echo $linguaAttuale == "en" ? "We are located in Cesena, 10 minutes from the Hippodrome and a few minutes from Bufalini Hospital" : "Ci troviamo a Cesena, a 10 minuti dall'Ippodromo e a pochi minuti dall'ospedale Bufalini" ?></p>
      <p class="fw-bold"><?php echo $linguaAttuale == "en" ? "Opening Hours: " : "Orari di apertura: " ?></p>
      <ul>
        <li><?php echo $linguaAttuale == "en" ? "Mon-Fri: 9:00-12:00 / 15:00-19:00" : "Lun-Ven: 9:00-12:00 / 15:00-19:00" ?></li>
        <li><?php echo $linguaAttuale == "en" ? "Sat: 9:00 - 12:30" : "Sab: 9:00 - 12:30" ?></li>
        <li><?php echo $linguaAttuale == "en" ? "Sunday: close" : "Domenica: chiuso" ?></li>
      </ul>
    </div>
  </div>
</div>
