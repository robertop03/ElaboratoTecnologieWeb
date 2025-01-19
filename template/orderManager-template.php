<?php
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;

$perPage = 25;
$offset = ($page - 1) * $perPage;

$totalOrders = $db->getTotalOrderCount();
$totalPages = ceil($totalOrders / $perPage);

$ordini = $db->getOrdersPaginated($perPage, $offset);
?>

<div class="container my-4">
  <h2>Elenco Ordini</h2>

  <?php if ($totalOrders > 0): ?>
    <p>Ordini trovati: <?php echo $totalOrders; ?></p>

    <!-- Contenitore responsivo per la tabella -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <!-- ID Ordine -->
            <th style="width: 15ch;">ID Ordine</th>
            <!-- Data -->
            <th style="width: 15ch;">Data</th>
            <!-- Email utente -->
            <th>Email Utente</th>
            <!-- Stato (testuale) -->
            <th>Stato</th>
            <!-- Colonna vuota per i bottoni -->
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ordini as $ordine): ?>
            <?php 
              // Mappa i valori di stato numerici ai corrispondenti testi
              switch ($ordine['Stato']) {
                case '0':
                  $statoTesto = "ordine confermato";
                  break;
                case '1':
                  $statoTesto = "ordine spedito";
                  break;
                case '2':
                  $statoTesto = "ordine consegnato";
                  break;
                default:
                  $statoTesto = "sconosciuto";
                  break;
              }
            ?>
            <tr>
              <!-- ID Ordine -->
              <td><?php echo htmlspecialchars($ordine['ID_Ordine']); ?></td>
              <!-- Data -->
              <td><?php echo htmlspecialchars($ordine['Data']); ?></td>
              <!-- Email -->
              <td><?php echo htmlspecialchars($ordine['Email']); ?></td>
              <!-- Stato testo -->
              <td><?php echo htmlspecialchars($statoTesto); ?></td>
              <!-- Bottoni allineati a destra -->
              <td class="text-end">
                <div class="d-inline-flex gap-2">
                    <!-- Bottone per modificare lo stato ordine -->
                    <a href="modifica_stato_ordine.php?id=<?php echo urlencode($ordine['ID_Ordine']); ?>" class="btn btn-warning">
                      Modifica stato
                    </a>
                    <!-- Bottone per pagina futura (dettagli ordine) -->
                    <a href="orderdetailsadmin.php?id=<?php echo urlencode($ordine['ID_Ordine']); ?>" class="btn btn-primary me-2">
                      Dettagli ordine
                    </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div> <!-- Fine .table-responsive -->

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
    <p>Nessun ordine presente.</p>
  <?php endif; ?>
</div>
