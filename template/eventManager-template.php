<?php
$eventi = $db->getAllEvents();
?>

<div class="container my-4">
    <h4 class="h2 mb-3">Lista Eventi</h4>

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
                    <th class="d-none d-md-table-cell">Titolo (EN)</th>
                    <th class="d-none d-md-table-cell">Titolo (IT)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($eventi)): ?>
                    <?php foreach ($eventi as $evento): ?>
                        <tr id="evento-<?php echo htmlspecialchars($evento['ID_Evento']); ?>">
                            <td><?php echo htmlspecialchars($evento['ID_Evento']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Data_Inizio']); ?></td>
                            <td><?php echo htmlspecialchars($evento['Data_Fine']); ?></td>
                            <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($evento['Titolo_EN']); ?></td>
                            <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($evento['Titolo_IT']); ?></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-warning btn-modifica-evento" 
                                            data-id="<?php echo htmlspecialchars($evento['ID_Evento']); ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modificaEventoModal">
                                        Dettagli e Modifica
                                    </button>
                                    <button class="btn btn-danger btn-elimina-evento" 
                                            data-id="<?php echo htmlspecialchars($evento['ID_Evento']); ?>">
                                        Elimina
                                    </button>
                                </div>
                            </td>
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
</div>

<!-- Modale per aggiungere evento -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Aggiungi un nuovo evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addEventForm" action="api/addevent.php" method="POST">
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
                        <label for="foto" class="form-label">Nome Foto</label>
                        <input type="text" class="form-control" id="foto" name="foto" required>
                    </div>
                    <hr>
                    <h6>Testo Italiano</h6>
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
                    <h6>Testo Inglese</h6>
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
                    <button type="submit" class="btn btn-primary">Aggiungi evento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modale per modificare evento -->
<div class="modal fade" id="modificaEventoModal" tabindex="-1" aria-labelledby="modificaEventoModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificaEventoModalLabel">Modifica Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modificaEventoForm" action="api/modificaevento.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="modificaEventoId" name="eventoId">

                    <!-- Dettagli evento -->
                    <div class="mb-3">
                        <label for="modificaDataInizio" class="form-label">Data Inizio</label>
                        <input type="date" class="form-control" id="modificaDataInizio" name="dataInizio" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaDataFine" class="form-label">Data Fine</label>
                        <input type="date" class="form-control" id="modificaDataFine" name="dataFine" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaFoto" class="form-label">Nome Foto</label>
                        <input type="text" class="form-control" id="modificaFoto" name="foto" required>
                    </div>

                    <hr>
                    <!-- Testo Italiano -->
                    <h6>Testo Italiano</h6>
                    <div class="mb-3">
                        <label for="modificaTitoloIT" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="modificaTitoloIT" name="titoloIT" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaSottotitoloIT" class="form-label">Sottotitolo</label>
                        <input type="text" class="form-control" id="modificaSottotitoloIT" name="sottotitoloIT" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaDescrizioneIT" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="modificaDescrizioneIT" name="descrizioneIT" rows="3" required></textarea>
                    </div>

                    <hr>
                    <!-- Testo Inglese -->
                    <h6>Testo Inglese</h6>
                    <div class="mb-3">
                        <label for="modificaTitoloEN" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="modificaTitoloEN" name="titoloEN" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaSottotitoloEN" class="form-label">Sottotitolo</label>
                        <input type="text" class="form-control" id="modificaSottotitoloEN" name="sottotitoloEN" required>
                    </div>
                    <div class="mb-3">
                        <label for="modificaDescrizioneEN" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="modificaDescrizioneEN" name="descrizioneEN" rows="3" required></textarea>
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