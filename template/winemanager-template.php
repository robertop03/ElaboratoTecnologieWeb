<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$perPage = 5;
$offset = ($page - 1) * $perPage;

$totalWines = $db->getTotalWineCount();
$totalPages = ceil($totalWines / $perPage);

$vini = $db->getWinesPaginated($perPage, $offset);
?>

<div class="container my-4">
  <h2 class="mt-3">Lista Vini</h2>
  <?php if ($totalWines > 0): ?>
    <p>Vini trovati: <?php echo $totalWines; ?></p>

    <!-- Tabella vini -->
    <div class="table-responsive">
      <table class="table table-bordered" id="wine-table">
        <thead>
          <tr>
            <th>ID Prodotto</th>
            <th>Quantità Magazzino</th>
            <th>Titolo Prodotto</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($vini as $vino): ?>
            <tr id="vino-<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>">
              <td><?php echo htmlspecialchars($vino['ID_Prodotto']); ?></td>
              <td><?php echo htmlspecialchars($vino['Quantita_Magazzino']); ?></td>
              <td><?php echo htmlspecialchars($vino['Titolo_Prodotto']); ?></td>
              <td class="text-end">
                <button class="btn btn-warning btn-modifica-quantita" data-id="<?php echo htmlspecialchars($vino['ID_Prodotto']); ?>" data-bs-toggle="modal" data-bs-target="#modificaQuantitaModal">
                  Modifica quantità
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Paginazione -->
    <nav>
      <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <?php $active = ($i === $page) ? 'active' : ''; ?>
          <li class="page-item <?php echo $active; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php else: ?>
    <p>Nessun vino trovato.</p>
  <?php endif; ?>
</div>

<!-- Modale per modificare la quantità -->
<div class="modal fade" id="modificaQuantitaModal" tabindex="-1" aria-labelledby="modificaQuantitaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modificaQuantitaModalLabel">Modifica Quantità</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="modificaQuantitaForm" action="template/modifica-quantita-vino.php" method="POST">
        <div class="modal-body">
          <input type="hidden" id="vinoId" name="vinoId">
          <div class="mb-3">
            <label for="nuovaQuantita" class="form-label">Nuova Quantità</label>
            <input type="number" class="form-control" id="nuovaQuantita" name="nuovaQuantita" min="0" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-modifica-quantita").forEach(button => {
        button.addEventListener("click", function () {
            const vinoId = this.dataset.id;
            document.getElementById("vinoId").value = vinoId;
        });
    });
});
</script>
