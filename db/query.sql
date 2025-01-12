-- 1 - estrarre tutti i vini con i relativi attributi

SELECT 
    PRODOTTO.ID_Prodotto, 
    Prezzo, 
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
    TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
    TESTO_PRODOTTO.Descrizione
FROM 
    PRODOTTO
JOIN 
    TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
LEFT JOIN 
    ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
LEFT JOIN 
    ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
LEFT JOIN 
    CATEGORIA ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
WHERE 
    TESTO_PRODOTTO.Lingua = 1 -- inserire la lingua desiderata 1 italiano 2 inglese
GROUP BY 
    PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione;


-- 2 - estrarre tutti gli eventi
SELECT EVENTO.ID_Evento,Data_Inizio,Data_Fine,Foto,Titolo,Sottotitolo,Descrizione 
FROM EVENTO
JOIN TESTO_EVENTO
ON EVENTO.ID_EVENTO = TESTO_EVENTO.ID_EVENTO
WHERE TESTO_EVENTO.Lingua = 1 -- inserire la lingua desiderata 1 italiano 2 inglese

-- 3 - ricavare prezzo di un articolo
SELECT Prezzo 
FROM PRODOTTO 
WHERE ID_Prodotto = 'P3' -- inserire l'id del vino

-- 4 - verificare la disponibilità in magazzino di un prodotto
SELECT Quantita_Magazzino 
FROM PRODOTTO 
WHERE ID_Prodotto = 'P3'; -- inserire l'id del vino

-- 5 - registrare un utente
INSERT INTO UTENTE (Email, Password, Nome, Cognome, Newsletter) 
VALUES ('nuovo.utente@example.com', 'password789', 'Nuovo', 'Utente', 'N'); -- inserire i dati dell'utente

-- 6 - eliminare un utente registrato
DELETE FROM UTENTE 
WHERE Email = 'utente.da.rimuovere@example.com'; -- inserire l'email dell'utente da eliminare

-- 7 - verificare che la password inserita dall'utente sia esatta
SELECT * 
FROM UTENTE 
WHERE Email = 'utente@example.com' -- email utente
AND Password = 'password123'; -- password utente

-- 8 - registrare un metodo di pagamento
INSERT INTO METODO_PAGAMENTO (ID_Metodo, Numero_Carta, mese_scadenza, anno_scadenza, Email) 
VALUES ('M4', 1111222233334444, 12, 2026, 'utente@example.com'); -- inserisci qui i dati del metodo di pagamento e il riferimento all'utente

-- 9 - registrare un ordine
INSERT INTO ORDINE (ID_Ordine, Data, Stato, ID_Metodo, Email, ID_Indirizzo) 
VALUES ('O4', '2025-01-12', 0, 'M4', 'utente@example.com', 'I3'); -- inserisci qui i dati dell'ordine

-- 10 - registrare l'indirizzo di spedizione associata al cliente
INSERT INTO INDIRIZZO (ID_Indirizzo, Via, Numero_Civico, CAP, Citta, Paese, Email) 
VALUES ('I4', 'Via Nuova', '30', 47523, 'Napoli', 'Italia', 'utente@example.com'); -- inserisci qui i dati dell'indirizzo

-- 11 - aggiungere / modificare il testo di un prodotto (o evento)
-- aggiungere
INSERT INTO TESTO_PRODOTTO (ID_Testo, Lingua, Titolo, Sottotitolo, Descrizione, ID_Prodotto) 
VALUES ('T21', 1, 'Nuovo Vino', 'Sottotitolo di prova', 'Descrizione di prova', 'P15'); -- inserisci qui i dati del testo del prodotto

-- modificare
UPDATE TESTO_PRODOTTO 
SET Titolo = 'Vino Modificato', Descrizione = 'Nuova descrizione' -- inserisci qui i campi da modificare
WHERE ID_Testo = 'T1'; -- inserisci qui l'id del testo da modificare

-- 12 - filtrare per data per vedere gli eventi disponibili
SELECT * 
FROM EVENTO 
WHERE Data_Inizio <= '2025-01-12'-- inserire la data di inizio
AND Data_Fine >= '2025-05-20'; -- inserire la data di fine

-- 15 - estrarre singolo vino da mostra nella pagina prodotto

SELECT 
    PRODOTTO.ID_Prodotto, 
    Prezzo, 
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
    TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
    TESTO_PRODOTTO.Descrizione,
    PRODOTTO.Quantita_Magazzino
FROM 
    PRODOTTO
JOIN 
    TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
LEFT JOIN 
    ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
LEFT JOIN 
    ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
LEFT JOIN 
    CATEGORIA ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
WHERE 
    TESTO_PRODOTTO.Lingua = 1 -- inserire la lingua desiderata 1 italiano 2 inglese
AND 
    PRODOTTO.ID_Prodotto = 'P3' -- inserire l'id del vino
GROUP BY 
    PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione;

-- 16 - modifica/cancellazione indirizzo
-- cancellare
DELETE FROM INDIRIZZO 
WHERE ID_Indirizzo = 'I1'; -- inserire l'id dell'indirizzo da cancellare

-- modificare
UPDATE INDIRIZZO 
SET Via = 'Via Modificata', Numero_Civico = '50' -- inserire i campi da modificare
WHERE ID_Indirizzo = 'I1'; -- inserire l'id dell'indirizzo da modificare

-- 17 - cancellazione metodo di pagamento
DELETE FROM METODO_PAGAMENTO
WHERE ID_Metodo = 'M1'; -- inserire l'id del metodo di pagamento da cancellare

-- 22 - iscrivere utente già registrato in newsletter - 23 - disiscrivere utente dalla newsletter
UPDATE UTENTE 
SET Newsletter = 'Y' -- inserire come modificare la newsletter
WHERE Email = 'utente@example.com'; -- inserire l'email dell'utente

-- 24 - aggiungere vino nei preferiti
INSERT INTO Preferisce (Email, ID_Prodotto) 
VALUES ('utente@example.com', 'P1'); -- inserire l'email dell'utente e l'id del vino

-- 25 - rimuovere vino dai preferiti
DELETE FROM Preferisce 
WHERE Email = 'utente@example.com' -- inserire l'email dell'utente
AND ID_Prodotto = 'P1'; -- inserire l'id del vino

-- 26 - visualizzare i preferiti

SELECT 
    PRODOTTO.ID_Prodotto, 
    Prezzo, 
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Frizzantezza' THEN ATTRIBUTO.Titolo END) AS Frizzantezza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Tonalità' THEN ATTRIBUTO.Titolo END) AS Tonalita,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Provenienza' THEN ATTRIBUTO.Titolo END) AS Provenienza,
    GROUP_CONCAT(CASE WHEN CATEGORIA.Titolo = 'Dimensione Bottiglia' THEN ATTRIBUTO.Titolo END) AS Capacita_Bottiglia,
    TESTO_PRODOTTO.Titolo AS Titolo_Prodotto, 
    TESTO_PRODOTTO.Descrizione
FROM 
    PRODOTTO
JOIN 
    TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
JOIN 
    Preferisce PR ON PRODOTTO.ID_Prodotto = PR.ID_Prodotto 
LEFT JOIN 
    ATTRIBUTA ON PRODOTTO.ID_Prodotto = ATTRIBUTA.ID_Prodotto
LEFT JOIN 
    ATTRIBUTO ON ATTRIBUTA.ID_Attributo = ATTRIBUTO.ID_Attributo
LEFT JOIN 
    CATEGORIA ON ATTRIBUTO.ID_Categoria = CATEGORIA.ID_Categoria
WHERE 
    TESTO_PRODOTTO.Lingua = 1 -- inserire la lingua desiderata 1 italiano 2 inglese
AND
    PR.Email = 'luigi.bianchi@example.com' -- inserire l'email dell'utente
GROUP BY 
    PRODOTTO.ID_Prodotto, Prezzo, TESTO_PRODOTTO.Titolo, TESTO_PRODOTTO.Descrizione;

-- 27 - estrarre le notifiche di un determinato utente

-- 28 - estrarre tutti gli ordini di un determinato utente
SELECT * 
FROM ORDINE 
WHERE Email = 'luigi.bianchi@example.com'; -- inserire l'email dell'utente

-- 29 - dato un id ordine mostra la lista di vini acquistati e la quantità
SELECT 
    PRODOTTO.ID_Prodotto, 
    TESTO_PRODOTTO.Titolo, 
    Compone.Quantità, 
    PRODOTTO.Prezzo
FROM 
    Compone
JOIN 
    PRODOTTO ON Compone.ID_Prodotto = PRODOTTO.ID_Prodotto
JOIN 
    TESTO_PRODOTTO ON PRODOTTO.ID_Prodotto = TESTO_PRODOTTO.ID_Prodotto
WHERE 
    Compone.ID_Ordine = 'O3' -- sostituire con l'ID dell'ordine di interesse
    AND TESTO_PRODOTTO.Lingua = 1 -- inserire la lingua desiderata 1 italiano 2 inglese



-- 13 - filtrare per regione per vedere i vini disponibili

-- 14 - mostrare i vini in ordine crescente/decrescente per capacità della bottiglia

-- 18 - mostrare vini in ordine crescente/descrescente per prezzo

-- 19 - filtrare i vini per categoria (navbar: rossi, bianchi ecc)

-- 20 - filtrare i vini per range di prezzo 

-- 21 - filtrare i vini per capacità bottiglia