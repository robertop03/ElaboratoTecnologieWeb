-- codice che crea il database

DROP DATABASE IF EXISTS Vino;

create database Vino;

use Vino;


create table Attributa (
     ID_Attributo varchar(10) not null,
     ID_Prodotto varchar(10) not null,
     primary key (ID_Prodotto, ID_Attributo));

create table ATTRIBUTO (
     ID_Attributo varchar(10) not null,
     Titolo varchar(50) not null,
     ID_Categoria varchar(10) not null,
     primary key (ID_Attributo));

create table CATEGORIA (
     ID_Categoria varchar(10) not null,
     Titolo char(50) not null,
     primary key (ID_Categoria));

create table Compone (
     ID_Prodotto varchar(10) not null,
     ID_Ordine varchar(10) not null,
     Quantità numeric(3) not null,
     primary key (ID_Ordine, ID_Prodotto));

create table Consiglia (
     ID_Prodotto varchar(10) not null,
     ID_Evento varchar(10) not null,
     primary key (ID_Prodotto, ID_Evento));

create table EVENTO (
     ID_Evento varchar(10) not null,
     Data_Inizio date not null,
     Data_Fine date not null,
     Foto text not null,
     primary key (ID_Evento));

create table INDIRIZZO (
     ID_Indirizzo varchar(10) not null,
     Via varchar(50) not null,
     Numero_Civico varchar(10) not null,
     CAP numeric(10) not null,
     Citta varchar(25) not null,
     Paese varchar(25) not null,
     Email varchar(100) not null,
     primary key (ID_Indirizzo));

create table METODO_PAGAMENTO (
     ID_Metodo varchar(10) not null,
     Numero_Carta numeric(16) not null,
     mese_scadenza numeric(2) not null,
     anno_scadenza numeric(4) not null,
     Email varchar(100) not null,
     primary key (ID_Metodo));

create table ORDINE (
     ID_Ordine varchar(10) not null,
     Data date not null,
     Stato numeric(1) not null,
     ID_Metodo varchar(10) not null,
     Email varchar(100) not null,
     ID_Indirizzo varchar(10) not null,
     primary key (ID_Ordine));

create table Preferisce (
     Email varchar(100) not null,
     ID_Prodotto varchar(10) not null,
     primary key (ID_Prodotto, Email));

create table PRODOTTO (
     ID_Prodotto varchar(10) not null,
     Prezzo float(10) not null,
     Quantita_Magazzino numeric(10) not null,
     Foto text not null,
     primary key (ID_Prodotto));

create table TESTO_EVENTO (
     ID_Testo varchar(10) not null,
     Lingua numeric(1) not null,
     Titolo varchar(50) not null,
     Sottotitolo varchar(200) not null,
     Descrizione varchar(1000) not null,
     ID_Evento varchar(10) not null,
     primary key (ID_Testo));

create table TESTO_PRODOTTO (
     ID_Testo varchar(10) not null,
     Lingua numeric(1) not null,
     Titolo varchar(50) not null,
     Sottotitolo varchar(200) not null,
     Descrizione varchar(1000) not null,
     ID_Prodotto varchar(10) not null,
     primary key (ID_Testo));

create table UTENTE (
     Email varchar(100) not null,
     Password varchar(256) not null,
     Nome varchar(25),
     Cognome varchar(25),
     Newsletter char not null,
     Admin char,
     primary key (Email));

create table NOTIFICA (
     ID_NOTIFICA varchar(10) not null,
     Data date not null,
     Visualizzato char not null,
     Email varchar(100) not null,
     primary key (ID_NOTIFICA));

create table TESTO_NOTIFICA (
     ID_Testo varchar(10) not null,
     Lingua numeric(1) not null,
     Titolo varchar(50) not null,
     Testo varchar(200) not null,
     ID_NOTIFICA varchar(10) not null,
     primary key (ID_Testo));



alter table Attributa add constraint FKHa_PRO
     foreign key (ID_Prodotto)
     references PRODOTTO(ID_Prodotto);

alter table Attributa add constraint FKHa_ATT
     foreign key (ID_Attributo)
     references ATTRIBUTO(ID_Attributo);

alter table ATTRIBUTO add constraint FKRaggruppa
     foreign key (ID_Categoria)
     references CATEGORIA(ID_Categoria);

alter table Compone add constraint FKCom_ORD
     foreign key (ID_Ordine)
     references ORDINE(ID_Ordine);

alter table Compone add constraint FKCom_PRO
     foreign key (ID_Prodotto)
     references PRODOTTO(ID_Prodotto);

alter table Consiglia add constraint FKCon_EVE
     foreign key (ID_Evento)
     references EVENTO(ID_Evento);

alter table Consiglia add constraint FKCon_PRO
     foreign key (ID_Prodotto)
     references PRODOTTO(ID_Prodotto); 

alter table INDIRIZZO add constraint FKPossiede
     foreign key (Email)
     references UTENTE(Email);

alter table METODO_PAGAMENTO add constraint FKUtilizza
     foreign key (Email)
     references UTENTE(Email);

alter table ORDINE add constraint FKUsa
     foreign key (ID_Metodo)
     references METODO_PAGAMENTO(ID_Metodo);

alter table ORDINE add constraint FKEsegue
     foreign key (Email)
     references UTENTE(Email);

alter table ORDINE add constraint FKSpedisce
     foreign key (ID_Indirizzo)
     references INDIRIZZO(ID_Indirizzo);

alter table Preferisce add constraint FKPre_PRO
     foreign key (ID_Prodotto)
     references PRODOTTO(ID_Prodotto);

alter table Preferisce add constraint FKPre_UTE
     foreign key (Email)
     references UTENTE(Email);

alter table TESTO_EVENTO add constraint FKSpecifica
     foreign key (ID_Evento)
     references EVENTO(ID_Evento);

alter table TESTO_PRODOTTO add constraint FKDescrive
     foreign key (ID_Prodotto)
     references PRODOTTO(ID_Prodotto);

alter table NOTIFICA add constraint FKR
     foreign key (Email)
     references UTENTE(Email);

alter table TESTO_NOTIFICA add constraint FKComunica
     foreign key (ID_NOTIFICA)
     references NOTIFICA(ID_NOTIFICA);
