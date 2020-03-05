-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                           PostgreSQL
--                        (24/1/2020 12:51:54)
-- -----------------------------------------------------------------------------
--      Nom de la base : bdd commission
--      Projet : Accueil Win'Design version 16
--      Auteur : Peerbuccus
--      Date de dernière modification : 24/1/2020 12:51:25
-- -----------------------------------------------------------------------------

drop database bdd commission;
-- -----------------------------------------------------------------------------
--       CREATION DE LA BASE 
-- -----------------------------------------------------------------------------

CREATE DATABASE bdd commission;

-- -----------------------------------------------------------------------------
--       TABLE : CONSULTANT
-- -----------------------------------------------------------------------------

CREATE TABLE CONSULTANT
   (
    ID integer NOT NULL  ,
    TYPECONTRAT char(32) NULL  ,
    SALAIRE integer NULL  ,
    TARIF integer NULL  
,   CONSTRAINT PK_CONSULTANT PRIMARY KEY (ID)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE UTILISATEUR
   (
    ID SERIAL NOT NULL  ,
    NOM char(32) NULL  ,
    PRENOM char(32) NULL  ,
    ADRESSE char(32) NULL  ,
    VILLE char(32) NULL  ,
    CP int4 NULL  ,
    TEL int4 NULL  ,
    EMAIL char(32) NULL  
,   CONSTRAINT PK_UTILISATEUR PRIMARY KEY (ID)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : POURCENTAGE
-- -----------------------------------------------------------------------------

CREATE TABLE POURCENTAGE
   (
    IDCOMMISSION integer NOT NULL  ,
    VALEUR integer NULL  
,   CONSTRAINT PK_POURCENTAGE PRIMARY KEY (IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : FACTURE
-- -----------------------------------------------------------------------------

CREATE TABLE FACTURE
   (
    IDFACTURE SERIAL NOT NULL  ,
    ID integer NOT NULL  ,
    LIBELLE char(32) NULL  ,
    MONTANT int4 NULL   
,   CONSTRAINT PK_FACTURE PRIMARY KEY (IDFACTURE)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE FACTURE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_FACTURE_CRA
     ON FACTURE (ID)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CRA
-- -----------------------------------------------------------------------------

CREATE TABLE CRA
   (
    ID SERIAL NOT NULL  ,
    IDCONTRAT integer NOT NULL  ,
    TOTALJFACTURABLE float4 NULL  ,
    TOTALJMALADIE float4 NULL  ,
    TOTALJCONGE float4 NULL  ,
    ASTREINTE varchar(128) NULL  ,
    PERIODE varchar(128) NULL  ,
    INTERVENTION varchar(128) NULL  
,   CONSTRAINT PK_CRA PRIMARY KEY (ID)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CRA
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CRA_CONTRAT
     ON CRA (IDCONTRAT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : ONESHOT
-- -----------------------------------------------------------------------------

CREATE TABLE ONESHOT
   (
    IDCOMMISSION integer NOT NULL  ,
    MONTANT integer NULL  
,   CONSTRAINT PK_ONESHOT PRIMARY KEY (IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CONTACT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTACT
   (
    IDCONTACT SERIAL NOT NULL  ,
    EMAIL1 char(32) NULL  ,
    EMAIL2 char(32) NULL  ,
    EMAIL3 char(32) NULL  ,
    BUREAU int4 NULL  ,
    FAX int4 NULL  ,
    TEL3 int4 NULL  
,   CONSTRAINT PK_CONTACT PRIMARY KEY (IDCONTACT)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMERCIAL
-- -----------------------------------------------------------------------------

CREATE TABLE COMMERCIAL
   (
    ID integer NOT NULL  
,   CONSTRAINT PK_COMMERCIAL PRIMARY KEY (ID)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CLIENT
-- -----------------------------------------------------------------------------

CREATE TABLE CLIENT
   (
    IDCLIENT SERIAL NOT NULL  ,
    IDCONTACT integer NOT NULL  ,
    RAISONSOCIAL varchar(32) NULL  ,
    SIRET varchar(14) NULL  ,
    ADR char(32) NULL  ,
    VILLE char(32) NULL  ,
    CODEPOSTAL int4 NULL  
,   CONSTRAINT PK_CLIENT PRIMARY KEY (IDCLIENT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CLIENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CLIENT_CONTACT
     ON CLIENT (IDCONTACT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CONTRAT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTRAT
   (
    IDCONTRAT SERIAL NOT NULL  ,
    IDCLIENT int NOT NULL  ,
    ID int NOT NULL  ,
    DATEDEBUT timestamp(12) NULL  ,
    DATEFIN timestamp(12) NULL  
,   CONSTRAINT PK_CONTRAT PRIMARY KEY (IDCONTRAT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CONTRAT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CONTRAT_CONSULTANT
     ON CONTRAT (ID)
    ;

CREATE  INDEX I_FK_CONTRAT_CLIENT
     ON CONTRAT (IDCLIENT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : INFOB
-- -----------------------------------------------------------------------------

CREATE TABLE INFOB
   (
    ID SERIAL NOT NULL  ,
    IDCLIENT int NOT NULL  ,
    ID_1 int NOT NULL  ,
    CODEAGENCE char(32) NULL  ,
    COMPTE char(32) NULL  ,
    IBAN char(32) NULL  ,
    BIC char(32) NULL  ,
    CODEBANQUE char(32) NULL  ,
    CLERIB int NULL  
,   CONSTRAINT PK_INFOB PRIMARY KEY (ID)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE INFOB
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_INFOB_COMMERCIAL
     ON INFOB (ID_1)
    ;

CREATE  INDEX I_FK_INFOB_CLIENT
     ON INFOB (IDCLIENT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMISSION
-- -----------------------------------------------------------------------------

CREATE TABLE COMMISSION
   (
    IDCOMMISSION integer NOT NULL  ,
    ID integer NOT NULL  
,   CONSTRAINT PK_COMMISSION PRIMARY KEY (IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMISSION
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMISSION_COMMERCIAL
     ON COMMISSION (ID)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : DEPENSE
-- -----------------------------------------------------------------------------

CREATE TABLE DEPENSE
   (
    IDDEPENSE integer NOT NULL  ,
    LIBELLE char(32) NULL  ,
    MONTANT int4 NULL  
,   CONSTRAINT PK_DEPENSE PRIMARY KEY (IDDEPENSE)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PRENDRE
-- -----------------------------------------------------------------------------

CREATE TABLE PRENDRE
   (
    IDCONTRAT integer NOT NULL  ,
    IDCOMMISSION integer NOT NULL  
,   CONSTRAINT PK_PRENDRE PRIMARY KEY (IDCONTRAT, IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PRENDRE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PRENDRE_CONTRAT
     ON PRENDRE (IDCONTRAT)
    ;

CREATE  INDEX I_FK_PRENDRE_COMMISSION
     ON PRENDRE (IDCOMMISSION)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : PAYER
-- -----------------------------------------------------------------------------

CREATE TABLE PAYER
   (
    IDFACTURE integer NOT NULL  ,
    IDCONTRAT integer NOT NULL  ,
    IDCLIENT integer NOT NULL  
,   CONSTRAINT PK_PAYER PRIMARY KEY (IDFACTURE, IDCONTRAT, IDCLIENT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PAYER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PAYER_FACTURE
     ON PAYER (IDFACTURE)
    ;

CREATE  INDEX I_FK_PAYER_CONTRAT
     ON PAYER (IDCONTRAT)
    ;

CREATE  INDEX I_FK_PAYER_CLIENT
     ON PAYER (IDCLIENT)
    ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE CONSULTANT ADD 
     CONSTRAINT FK_CONSULTANT_UTILISATEUR
          FOREIGN KEY (ID)
               REFERENCES UTILISATEUR (ID);

ALTER TABLE POURCENTAGE ADD 
     CONSTRAINT FK_POURCENTAGE_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

ALTER TABLE FACTURE ADD 
     CONSTRAINT FK_FACTURE_CRA
          FOREIGN KEY (ID)
               REFERENCES CRA (ID);

ALTER TABLE CRA ADD 
     CONSTRAINT FK_CRA_CONTRAT
          FOREIGN KEY (IDCONTRAT)
               REFERENCES CONTRAT (IDCONTRAT);

ALTER TABLE ONESHOT ADD 
     CONSTRAINT FK_ONESHOT_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

ALTER TABLE COMMERCIAL ADD 
     CONSTRAINT FK_COMMERCIAL_UTILISATEUR
          FOREIGN KEY (ID)
               REFERENCES UTILISATEUR (ID);

ALTER TABLE CLIENT ADD 
     CONSTRAINT FK_CLIENT_CONTACT
          FOREIGN KEY (IDCONTACT)
               REFERENCES CONTACT (IDCONTACT);

ALTER TABLE CONTRAT ADD 
     CONSTRAINT FK_CONTRAT_CONSULTANT
          FOREIGN KEY (ID)
               REFERENCES CONSULTANT (ID);

ALTER TABLE CONTRAT ADD 
     CONSTRAINT FK_CONTRAT_CLIENT
          FOREIGN KEY (IDCLIENT)
               REFERENCES CLIENT (IDCLIENT);

ALTER TABLE INFOB ADD 
     CONSTRAINT FK_INFOB_COMMERCIAL
          FOREIGN KEY (ID_1)
               REFERENCES COMMERCIAL (ID);

ALTER TABLE INFOB ADD 
     CONSTRAINT FK_INFOB_CLIENT
          FOREIGN KEY (IDCLIENT)
               REFERENCES CLIENT (IDCLIENT);

ALTER TABLE COMMISSION ADD 
     CONSTRAINT FK_COMMISSION_COMMERCIAL
          FOREIGN KEY (ID)
               REFERENCES COMMERCIAL (ID);

ALTER TABLE PRENDRE ADD 
     CONSTRAINT FK_PRENDRE_CONTRAT
          FOREIGN KEY (IDCONTRAT)
               REFERENCES CONTRAT (IDCONTRAT);

ALTER TABLE PRENDRE ADD 
     CONSTRAINT FK_PRENDRE_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

ALTER TABLE PAYER ADD 
     CONSTRAINT FK_PAYER_FACTURE
          FOREIGN KEY (IDFACTURE)
               REFERENCES FACTURE (IDFACTURE);

ALTER TABLE PAYER ADD 
     CONSTRAINT FK_PAYER_CONTRAT
          FOREIGN KEY (IDCONTRAT)
               REFERENCES CONTRAT (IDCONTRAT);

ALTER TABLE PAYER ADD 
     CONSTRAINT FK_PAYER_CLIENT
          FOREIGN KEY (IDCLIENT)
               REFERENCES CLIENT (IDCLIENT);


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------