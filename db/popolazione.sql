/* Codice per riempire il database */

-- Popolamento della tabella UTENTE
INSERT INTO UTENTE (Email, Password, Nome, Cognome, Newsletter) VALUES
('mario.rossi@example.com', '$2y$10$Q8nb/xaZ1AHrEzWt/gG4LO.hxuPmYZLF6tOJBPNtobA', 'Mario', 'Rossi', 'Y'),
('luigi.bianchi@example.com', '$2y$10$Q8nb/xaZ1AHrEzWt/gG4LO.hxuPmYZLF6tOJBPNtobA', 'Luigi', 'Bianchi', 'N');

INSERT INTO UTENTE (Email, Password, Nome, Cognome, Newsletter,Admin) VALUES
('admin@gmail.com', '$2y$10$cNx5hLsOuXii2ltrQzwire/2CjyoH5IyGKriZ65VUK4', 'Roberto', 'Nuvoli', 'N','Y');

-- Popolamento della tabella INDIRIZZO
INSERT INTO INDIRIZZO (ID_Indirizzo, Via, Numero_Civico, CAP, Citta, Paese, Email) VALUES
('I1', 'Via Roma', '10', 47521, 'Roma', 'Italia', 'mario.rossi@example.com'),
('I2', 'Via Milano', '20', 47522, 'Milano', 'Italia', 'luigi.bianchi@example.com'),
('I3', 'Via Parma', '40', 47521, 'Cesena', 'Italia', 'luigi.bianchi@example.com');

-- Popolamento della tabella METODO_PAGAMENTO
INSERT INTO METODO_PAGAMENTO (ID_Metodo, Numero_Carta, mese_scadenza, anno_scadenza, Email) VALUES
('M1', 1234567812345678, 12, 2025, 'mario.rossi@example.com'),
('M2', 8765432187654321, 6, 2024, 'luigi.bianchi@example.com'),
('M3', 8765432187654321, 6, 2024, 'luigi.bianchi@example.com');

-- Popolamento della tabella CATEGORIA
INSERT INTO CATEGORIA (ID_Categoria, Titolo) VALUES
('C1', 'Frizzantezza'),
('C2', 'Tonalità'),
('C3', 'Provenienza'),
('C4', 'Dimensione Bottiglia');

-- Popolamento della tabella ATTRIBUTO
INSERT INTO ATTRIBUTO (ID_Attributo, Titolo, ID_Categoria) VALUES
('A1', 'Frizzante', 'C1'),
('A2', 'Fermo', 'C1'),
('A3', 'Spumante', 'C1'),
('A4', 'Rosso', 'C2'),
('A5', 'Bianco', 'C2'),
('A6', 'Rosè', 'C2'),
('A7', 'Abruzzo', 'C3'),
('A8', 'Basilicata', 'C3'),
('A9', 'Calabria', 'C3'),
('A10', 'Campania', 'C3'),
('A11', 'Emilia Romagna', 'C3'),
('A12', 'Friuli Venezia Giulia', 'C3'),
('A13', 'Lazio', 'C3'),
('A14', 'Liguria', 'C3'),
('A15', 'Lombardia', 'C3'),
('A16', 'Marche', 'C3'),
('A17', 'Molise', 'C3'),
('A18', 'Piemonte', 'C3'),
('A19', 'Puglia', 'C3'),
('A20', 'Sardegna', 'C3'),
('A21', 'Sicilia', 'C3'),
('A22', 'Toscana', 'C3'),
('A23', 'Trentino Alto Adige', 'C3'),
('A24', 'Umbria', 'C3'),
('A25', "Valle d'Aosta", 'C3'),
('A26', 'Veneto', 'C3'),
('A27', 'Bottiglia 0.75l', 'C4'),
('A28', 'Magnum 1.5l', 'C4'),
('A29', 'Mezza 0.375l', 'C4');


-- Popolamento della tabella PRODOTTO
INSERT INTO PRODOTTO (ID_Prodotto, Prezzo, Quantita_Magazzino, Foto) VALUES
('P1', 15.50, 100, 'foto1.jpg'),
('P2', 12.30, 200, 'foto2.jpg'),
('P3', 18.75, 150, 'foto3.jpg'),
('P4', 22.40, 0, 'foto4.jpg'),
('P5', 9.99, 300, 'foto5.jpg'),
('P6', 14.20, 250, 'foto6.jpg'),
('P7', 19.80, 80, 'foto7.jpg'),
('P8', 13.50, 220, 'foto8.jpg'),
('P9', 16.70, 90, 'foto9.jpg'),
('P10', 11.25, 500, 'foto10.jpg');

-- Popolamento della tabella Attributi
INSERT INTO Attributa (ID_Attributo, ID_Prodotto) VALUES
('A1', 'P1'), -- Frizzante (C1)
('A5', 'P1'), -- Bianco (C2)
('A7', 'P1'), -- Abruzzo (C3)
('A27', 'P1'), -- Bottiglia 0.75l (C4)

('A2', 'P2'), -- Fermo (C1)
('A4', 'P2'), -- Rosso (C2)
('A22', 'P2'), -- Toscana (C3)
('A28', 'P2'), -- Magnum 1.5l (C4)

('A3', 'P3'), -- Spumante (C1)
('A6', 'P3'), -- Rosè (C2)
('A18', 'P3'), -- Piemonte (C3)
('A29', 'P3'), -- Mezza 0.375l (C4)

('A1', 'P4'), -- Frizzante (C1)
('A4', 'P4'), -- Rosso (C2)
('A26', 'P4'), -- Veneto (C3)
('A27', 'P4'), -- Bottiglia 0.75l (C4)

('A2', 'P5'), -- Fermo (C1)
('A5', 'P5'), -- Bianco (C2)
('A21', 'P5'), -- Sicilia (C3)
('A27', 'P5'), -- Bottiglia 0.75l (C4)

('A3', 'P6'), -- Spumante (C1)
('A6', 'P6'), -- Rosè (C2)
('A15', 'P6'), -- Lombardia (C3)
('A28', 'P6'), -- Magnum 1.5l (C4)

('A1', 'P7'), -- Frizzante (C1)
('A5', 'P7'), -- Bianco (C2)
('A20', 'P7'), -- Sardegna (C3)
('A29', 'P7'), -- Mezza 0.375l (C4)

('A2', 'P8'), -- Fermo (C1)
('A4', 'P8'), -- Rosso (C2)
('A19', 'P8'), -- Puglia (C3)
('A27', 'P8'), -- Bottiglia 0.75l (C4)

('A3', 'P9'), -- Spumante (C1)
('A5', 'P9'), -- Bianco (C2)
('A11', 'P9'), -- Emilia Romagna (C3)
('A27', 'P9'), -- Bottiglia 0.75l (C4)

('A1', 'P10'), -- Frizzante (C1)
('A6', 'P10'), -- Rosè (C2)
('A10', 'P10'), -- Campania (C3)
('A27', 'P10'); -- Bottiglia 0.75l (C4)

-- Popolamento della tabella Testo Prodotto
-- all'interno del campo lingua il valore 1 significa italiano, il valore 2 inglese

-- Descrizioni per P1
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T1', 1, 'Vino Frizzante Bianco', 'Fresco e vivace', 'Un vino frizzante con note di agrumi, ideale per aperitivi.', 'P1'),
('T2', 2, 'Sparkling White Wine', 'Fresh and lively', 'A sparkling wine with citrus notes, perfect for appetizers.', 'P1');

-- Descrizioni per P2
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T3', 1, 'Vino Rosso Fermo', 'Corposo e intenso', 'Un vino rosso fermo con sentori di frutti di bosco e spezie.', 'P2'),
('T4', 2, 'Still Red Wine', 'Full-bodied and intense', 'A still red wine with hints of berries and spices.', 'P2');

-- Descrizioni per P3
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T5', 1, 'Vino Rosè Spumante', 'Elegante e raffinato', 'Un vino spumante rosè con profumi di fiori e frutta fresca.', 'P3'),
('T6', 2, 'Sparkling Rosé Wine', 'Elegant and refined', 'A sparkling rosé wine with floral and fresh fruit aromas.', 'P3');

-- Descrizioni per P4
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T7', 1, 'Vino Rosso Frizzante', 'Vivace e versatile', 'Un vino rosso frizzante con note di ciliegia e un pizzico di freschezza.', 'P4'),
('T8', 2, 'Sparkling Red Wine', 'Lively and versatile', 'A sparkling red wine with cherry notes and a touch of freshness.', 'P4');

-- Descrizioni per P5
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T9', 1, 'Vino Bianco Fermo', 'Delicato e aromatico', 'Un vino bianco fermo con sentori di pesca e fiori bianchi.', 'P5'),
('T10', 2, 'Still White Wine', 'Delicate and aromatic', 'A still white wine with hints of peach and white flowers.', 'P5');

-- Descrizioni per P6
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T11', 1, 'Vino Rosè Spumante', 'Fruttato e fresco', 'Un vino spumante rosè con sapori di fragola e lampone.', 'P6'),
('T12', 2, 'Sparkling Rosé Wine', 'Fruity and fresh', 'A sparkling rosé wine with flavors of strawberry and raspberry.', 'P6');

-- Descrizioni per P7
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T13', 1, 'Vino Bianco Frizzante', 'Fresco e minerale', 'Un vino bianco frizzante con note di mela verde e una spiccata mineralità.', 'P7'),
('T14', 2, 'Sparkling White Wine', 'Fresh and mineral', 'A sparkling white wine with green apple notes and pronounced minerality.', 'P7');

-- Descrizioni per P8
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T15', 1, 'Vino Rosso Fermo', 'Ricco e intenso', 'Un vino rosso fermo con sapori di prugna e cioccolato fondente.', 'P8'),
('T16', 2, 'Still Red Wine', 'Rich and intense', 'A still red wine with flavors of plum and dark chocolate.', 'P8');

-- Descrizioni per P9
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T17', 1, 'Vino Bianco Spumante', 'Elegante e floreale', "Un vino spumante bianco con profumi di fiori d'arancio e agrumi.", 'P9'),
('T18', 2, 'Sparkling White Wine', 'Elegant and floral', 'A sparkling white wine with orange blossom and citrus aromas.', 'P9');

-- Descrizioni per P10
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) VALUES
('T19', 1, 'Vino Rosè Frizzante', 'Vivace e fresco', 'Un vino rosè frizzante con sentori di melograno e petali di rosa.', 'P10'),
('T20', 2, 'Sparkling Rosé Wine', 'Lively and fresh', 'A sparkling rosé wine with hints of pomegranate and rose petals.', 'P10');

-- Popolamento della tabella Preferisce
INSERT INTO Preferisce (Email, ID_Prodotto) VALUES
('mario.rossi@example.com', 'P1'),
('luigi.bianchi@example.com', 'P2'),
('luigi.bianchi@example.com', 'P10'),
('luigi.bianchi@example.com', 'P7');

-- Popolamento della tabella ORDINE
-- stato 0 -> ordine confermato
-- stato 1 -> ordine spedito
-- stato 2 -> ordine consegnato
INSERT INTO ORDINE (ID_Ordine, Data, Stato, ID_Metodo, Email, ID_Indirizzo) VALUES
('O1', '2023-10-01', 2, 'M1', 'mario.rossi@example.com', 'I1'),
('O2', '2024-12-29', 1, 'M2', 'luigi.bianchi@example.com', 'I3'),
('O3', '2025-01-02', 0, 'M3', 'luigi.bianchi@example.com', 'I2');

-- Popolamento della tabella Compone
INSERT INTO Compone (ID_Prodotto, ID_Ordine, Quantità) VALUES
('P1', 'O1', 2),
('P8', 'O1', 1),
('P10', 'O2', 6),
('P2', 'O2', 3),
('P4', 'O3', 6),
('P6', 'O3', 3),
('P9', 'O3', 1);

-- Popolamento della tabella EVENTO
INSERT INTO EVENTO (ID_Evento, Data_Inizio, Data_Fine, Foto) VALUES
('E1', '2023-12-01', '2023-12-05', 'Evento1.jpg'),
('E2', '2024-11-15', '2025-03-20', 'Evento2.jpg');

-- Popolamento della tabella TESTO_EVENTO
-- all'interno del campo lingua il valore 1 significa italiano, il valore 2 inglese

-- Descrizioni per l'evento E1
INSERT INTO TESTO_EVENTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Evento) VALUES
('T1', 1, 'Festa del Vino Rosso', 'Un evento imperdibile per gli amanti del vino rosso', 'Partecipa alla Festa del Vino Rosso per assaporare i migliori vini rossi provenienti da tutta Italia. Un evento ricco di degustazioni e attività.', 'E1'),
('T2', 2, 'Red Wine Festival', 'An unmissable event for red wine lovers', 'Join the Red Wine Festival to taste the best red wines from all over Italy. An event full of tastings and activities.', 'E1');

-- Descrizioni per l'evento E2
INSERT INTO TESTO_EVENTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Evento) VALUES
('T3', 1, 'Fiera del Vino e dei Prodotti Locali', "Esplora i sapori e i vini della tradizione", "La Fiera del Vino e dei Prodotti Locali ti offre l'opportunità di scoprire e degustare prodotti tipici e vini di alta qualità provenienti dalle varie regioni d'Italia.", 'E2'),
('T4', 2, 'Wine and Local Products Fair', 'Explore the flavors and wines of tradition', 'The Wine and Local Products Fair offers you the opportunity to discover and taste typical products and high-quality wines from different regions of Italy.', 'E2');

-- Consigli per l'evento E1 (Festa del Vino Rosso)
INSERT INTO Consiglia (ID_Prodotto, ID_Evento) VALUES
('P2', 'E1'),
('P4', 'E1');

-- Consigli per l'evento E2 (Fiera del Vino e dei Prodotti Locali)
INSERT INTO Consiglia (ID_Prodotto, ID_Evento) VALUES
('P5', 'E2'),  
('P6', 'E2'),
('P7', 'E2'),
('P10', 'E2');

INSERT INTO NOTIFICA (ID_NOTIFICA, Data, Titolo, Testo, Visualizzato, Email) 
VALUES
('N001', '2023-10-23', 'Ordine consegnato', 'Il tuo ordine è stato consegnato con successo.', 'Y', 'luigi.bianchi@example.com'),
('N002', '2023-10-23', 'Ordine spedito', 'Il tuo ordine è stato spedito ed è in transito.', 'N', 'mario.rossi@example.com'),
('N003', '2025-01-13', 'Articolo esaurito', 'Un articolo del catalogo non è più disponibile, id articolo: P4', 'N', 'admin@gmail.com'),
('N004', '2025-01-02', 'Ordine confermato', 'Il tuo ordine è stato confermato, attendi la spedizione 3/7 giorni lavorativi.', 'N', 'luigi.bianchi@example.com');
