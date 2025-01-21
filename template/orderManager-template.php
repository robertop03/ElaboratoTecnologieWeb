<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$perPage = 8;
$offset = ($page - 1) * $perPage;

$totalOrders = $db->getTotalOrderCount();
$totalPages = ceil($totalOrders / $perPage);

$ordini = $db->getOrdersPaginated($perPage, $offset);
?>

<div class="container">
  <h2 class="mt-3">Elenco Ordini</h2>
  <?php if ($totalOrders > 0): ?>
    <p>Ordini trovati: <?php echo $totalOrders; ?></p>

    <!-- Contenitore responsivo per la tabella -->
    <div class="table-responsive">
      <table class="table table-bordered" id="order-table">
        <thead>
          <tr>
            <th class="w-10">ID Ordine</th>
            <th class="w-10">Data</th>
            <th>Email Utente</th>
            <th>Stato</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ordini as $ordine): ?>
            <?php 
            switch ($ordine['Stato']) {
                case '0':
                    $statoTesto = '<i class="bi bi-check-circle text-success"></i> ordine confermato'; // Icona di conferma
                    break;
                case '1':
                    $statoTesto = '<i class="bi bi-truck text-primary"></i> ordine spedito'; // Icona di spedizione
                    break;
                case '2':
                    $statoTesto = '<i class="bi bi-box text-warning"></i> ordine consegnato'; // Icona di consegna
                    break;
                default:
                    $statoTesto = '<i class="bi bi-question-circle text-danger"></i> sconosciuto'; // Icona di errore/sconosciuto
                    break;
            }
            ?>
            <tr id="ordine-<?php echo htmlspecialchars($ordine['ID_Ordine']); ?>">
              <td><?php echo htmlspecialchars($ordine['ID_Ordine']); ?></td>
              <td><?php echo htmlspecialchars($ordine['Data']); ?></td>
              <td><?php echo htmlspecialchars($ordine['Email']); ?></td>
              <td class="stato-ordine"><?php echo $statoTesto; ?></td>
              <td class="text-end">
                <div class="d-inline-flex gap-2">
                  <button class="btn btn-warning btn-cambia-stato" data-id="<?php echo htmlspecialchars($ordine['ID_Ordine']); ?>">
                    Modifica stato
                  </button>
                  <a href="orderdetailsadmin.php?id=<?php echo urlencode($ordine['ID_Ordine']); ?>" class="btn btn-primary">
                    Dettagli ordine
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

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
    <p>Nessun ordine presente.</p>
  <?php endif; ?>
</div>

<script>
document.querySelectorAll(".btn-cambia-stato").forEach(button => {
    button.addEventListener("click", function () {
        const id = this.dataset.id; // dataset è un modo comodo per accedere agli attributi data-*

        // AJAX Request
        fetch("api/modifica-stato-ordine.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id: id }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(`Azione completata per ID: ${id}`);
            } else {
                console.error(`Errore: ${data.message}`);
            }
            window.location.reload();
        })
        .catch(error => {
            console.error("Errore nella richiesta:", error);
            window.location.reload();
        });
    });
});

</script>