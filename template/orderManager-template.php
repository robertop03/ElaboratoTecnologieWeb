<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$perPage = 5;
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
            <th class="w-10 d-none d-md-table-cell">Data</th>
            <th class="d-none d-md-table-cell">Email Utente</th>
            <th>Stato</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ordini as $ordine): ?>
            <?php 
            switch ($ordine['Stato']) {
                case '0':
                    $statoTesto = '<span class="bi bi-box text-warning" role="image" aria-label="icona confermato"></span> ordine confermato'; // Icona di conferma
                    break;
                case '1':
                    $statoTesto = '<span class="bi bi-truck text-primary" role="image" aria-label="icona spedizione"></span> ordine spedito'; // Icona di spedizione
                    break;
                case '2':
                    $statoTesto = '<span class="bi bi-check-circle text-success" role="image" aria-label="icona consegnato"></span> ordine consegnato'; // Icona di consegna
                    break;
                default:
                    $statoTesto = 'sconosciuto';
                    break;
            }
            ?>
            <tr id="ordine-<?php echo htmlspecialchars($ordine['ID_Ordine']); ?>">
              <td><?php echo htmlspecialchars($ordine['ID_Ordine']); ?></td>
              <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($ordine['Data']); ?></td>
              <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($ordine['Email']); ?></td>
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