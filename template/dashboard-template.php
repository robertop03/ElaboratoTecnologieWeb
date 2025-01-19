<h1 class="text-center">Dashboard Operatore</h1>
<div class="row">
  <!-- Riquadro 1 -->
  <div class="col-md-3">
    <div class="card h-100 text-center">
      <div class="card-body">
        <h5 class="card-title">Utenti Registrati</h5>
        <p class="display-4 fw-bold"><?php echo $db->getUsersCount(); ?></p>
      </div>
    </div>
  </div>

  <!-- Riquadro 2 -->
  <div class="col-md-3">
    <div class="card h-100 text-center">
      <div class="card-body">
        <h5 class="card-title">Ordini Totali</h5>
        <p class="display-4 fw-bold"><?php echo $db->getTotalOrderCount(); ?></p>
      </div>
    </div>
  </div>

  <!-- Riquadro 3 -->
  <div class="col-md-3">
    <div class="card h-100 text-center">
      <div class="card-body">
        <h5 class="card-title">Ordini da Evadere</h5>
        <p class="display-4 fw-bold"><?php echo $db->getOrdersUnshipped(); ?></p>
      </div>
    </div>
  </div>

  <!-- Riquadro 4 -->
  <div class="col-md-3">
    <div class="card h-100 text-center">
      <div class="card-body">
        <h5 class="card-title">Bottiglie in Magazzino</h5>
        <p class="display-4 fw-bold"><?php echo $db->getTotalBottleCount(); ?></p>
      </div>
    </div>
  </div>
</div>