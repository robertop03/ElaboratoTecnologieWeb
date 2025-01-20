<?php
$eventi = $db->getAllEvents(); 
?>

<div class="container my-4">
    <h2 class="mb-3">Lista Eventi</h2>

    <!-- Pulsante per aggiungere un evento -->
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addEventModal">Aggiungi evento</button>

    <!-- Tabella eventi -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Evento</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Titolo (EN)</th>
                    <th>Titolo (IT)</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($eventi)): ?>
                    <?php foreach ($eventi as $evento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($evento['ID_Evento']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Data_Inizio']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Data_Fine']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Titolo_EN']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Titolo_IT']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Foto']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nessun evento trovato</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal per aggiungere un evento -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modale larga per schermi -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Aggiungi un nuovo evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="template/addevent.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dataInizio" class="form-label">Data Inizio</label>
                            <input type="date" class="form-control" id="dataInizio" name="dataInizio" required>
                        </div>
                        <div class="mb-3">
                            <label for="dataFine" class="form-label">Data Fine</label>
                            <input type="date" class="form-control" id="dataFine" name="dataFine" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Nome File Foto</label>
                            <input type="text" class="form-control" id="foto" name="foto" required>
                        </div>
                        <hr>
                        <h6>Testo in Italiano</h6>
                        <div class="mb-3">
                            <label for="titoloIT" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="titoloIT" name="titoloIT" required>
                        </div>
                        <div class="mb-3">
                            <label for="sottotitoloIT" class="form-label">Sottotitolo</label>
                            <input type="text" class="form-control" id="sottotitoloIT" name="sottotitoloIT" required>
                        </div>
                        <div class="mb-3">
                            <label for="descrizioneIT" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="descrizioneIT" name="descrizioneIT" rows="3" required></textarea>
                        </div>
                        <hr>
                        <h6>Testo in Inglese</h6>
                        <div class="mb-3">
                            <label for="titoloEN" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="titoloEN" name="titoloEN" required>
                        </div>
                        <div class="mb-3">
                            <label for="sottotitoloEN" class="form-label">Sottotitolo</label>
                            <input type="text" class="form-control" id="sottotitoloEN" name="sottotitoloEN" required>
                        </div>
                        <div class="mb-3">
                            <label for="descrizioneEN" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="descrizioneEN" name="descrizioneEN" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Salva evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
