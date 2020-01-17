-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                           PostgreSQL
--                        (12/12/2019 19:34:46)
-- -----------------------------------------------------------------------------
--      Nom de la base : MLR2
--      Libellé base : 
--      Projet : Espace de travail
--      Auteur : djenandi
--      Date de dernière modification : 12/12/2019 19:33:43
-- -----------------------------------------------------------------------------



-- -----------------------------------------------------------------------------
--       TABLE : RIBEUROPEEN
-- -----------------------------------------------------------------------------

CREATE TABLE RIBEUROPEEN
   (
    IDFINANCE integer NOT NULL  ,
    IBAN integer NULL  ,
    BIC integer NULL  
,   CONSTRAINT PK_RIBEUROPEEN PRIMARY KEY (IDFINANCE)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : ONE_SHOT
-- -----------------------------------------------------------------------------

CREATE TABLE ONE_SHOT
   (
    IDCOMMISSION integer NOT NULL  ,
    MONTANT money NULL  
,   CONSTRAINT PK_ONE_SHOT PRIMARY KEY (IDCOMMISSION)
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

--CREATE TABLE FACTURE
   --(
   -- IDFACTURE serial NOT NULL  ,
   -- DATEF date NULL  ,
   -- MONTANT integer NULL  ,
   -- QUANTITÉ integer NULL  ,
   -- PRIXHT integer NULL  ,
   -- TVA integer NULL  
--,   CONSTRAINT PK_FACTURE PRIMARY KEY (IDFACTURE)
   --) ;

-- -----------------------------------------------------------------------------
--       TABLE : CONTACT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTACT
   (
    IDCONTACT serial NOT NULL  ,
    EMAIL1 varchar(128) NULL  ,
    EMAIL2 varchar(128) NULL  ,
    EMAIL3 varchar(128) NULL  ,
    TEL1 integer NULL  ,
    TEL2 integer NULL  ,
    TEL3 integer NULL  
,   CONSTRAINT PK_CONTACT PRIMARY KEY (IDCONTACT)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CLIENT
-- -----------------------------------------------------------------------------

CREATE TABLE CLIENT
   (
    IDCLIENT serial NOT NULL  ,
    IDFINANCE integer NOT NULL  ,
    IDCONTACT integer NOT NULL  ,
    RAISON_SOCIAL varchar(32) NULL  ,
    NO_SIRET varchar(32) NULL  ,
    ADRESSE varchar(32) NULL  ,
    VILLE varchar(32) NULL  ,
    CP varchar(32) NULL  
,   CONSTRAINT PK_CLIENT PRIMARY KEY (IDCLIENT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CLIENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CLIENT_FINANCE
     ON CLIENT (IDFINANCE)
    ;

CREATE  INDEX I_FK_CLIENT_CONTACT
     ON CLIENT (IDCONTACT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CONTRAT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTRAT
   (
    IDCONSULTANT serial NOT NULL  ,
    IDCLIENT integer NOT NULL  ,
    DATEDEBUT date NULL  ,
    DATEFIN date NULL  ,
    NBJTRAVAILLER integer NULL  ,
    SALAIRE integer NULL  ,
    TARIF integer NULL  ,
    TYPECONTRAT varchar(20) NULL  
,   CONSTRAINT PK_CONTRAT PRIMARY KEY (IDCONSULTANT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CONTRAT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CONTRAT_CLIENT
     ON CONTRAT (IDCLIENT)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : RIB
-- -----------------------------------------------------------------------------

CREATE TABLE RIB
   (
    IDFINANCE integer NOT NULL  ,
    CODEBANQUE integer NULL  ,
    CODEAGENCE integer NULL  ,
    COMPTE integer NULL  ,
    CLERIB integer NULL  
,   CONSTRAINT PK_RIB PRIMARY KEY (IDFINANCE)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMISSION
-- -----------------------------------------------------------------------------

CREATE TABLE COMMISSION
   (
    IDCOMMISSION serial NOT NULL  ,
    IDCOMMERCIAUX integer NOT NULL  
,   CONSTRAINT PK_COMMISSION PRIMARY KEY (IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMISSION
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMISSION_COMMERCIAUX
     ON COMMISSION (IDCOMMERCIAUX)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMERCIAUX
-- -----------------------------------------------------------------------------

CREATE TABLE COMMERCIAUX
   (
    IDCOMMERCIAUX serial NOT NULL  ,
    IDFINANCE integer NOT NULL  ,
    NOM varchar(32) NULL  ,
    PRENOM varchar(32) NULL  ,
    TEL integer NULL  ,
    EMAIL varchar(32) NULL  ,
    ADRESSE varchar(32) NULL  ,
    VILLE varchar(32) NULL  ,
    CP varchar(32) NULL  
,   CONSTRAINT PK_COMMERCIAUX PRIMARY KEY (IDCOMMERCIAUX)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMERCIAUX
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMERCIAUX_FINANCE
     ON COMMERCIAUX (IDFINANCE)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : FINANCE
-- -----------------------------------------------------------------------------

CREATE TABLE FINANCE
   (
    IDFINANCE serial NOT NULL  
,   CONSTRAINT PK_FINANCE PRIMARY KEY (IDFINANCE)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : DEPENSE
-- -----------------------------------------------------------------------------

CREATE TABLE DEPENSE
   (
    IDDEPENSE serial NOT NULL  ,
    MONTANT money NULL  ,
    LIBELLE varchar(32) NULL  
,   CONSTRAINT PK_DEPENSE PRIMARY KEY (IDDEPENSE)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PRENDRE
-- -----------------------------------------------------------------------------

CREATE TABLE PRENDRE
   (
    IDCONSULTANT integer NOT NULL  ,
    IDCOMMISSION integer NOT NULL  
,   CONSTRAINT PK_PRENDRE PRIMARY KEY (IDCONSULTANT, IDCOMMISSION)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PRENDRE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PRENDRE_CONTRAT
     ON PRENDRE (IDCONSULTANT)
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
    IDCONSULTANT integer NOT NULL  ,
    IDCLIENT integer NOT NULL  
,   CONSTRAINT PK_PAYER PRIMARY KEY (IDFACTURE, IDCONSULTANT, IDCLIENT)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PAYER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PAYER_FACTURE
     ON PAYER (IDFACTURE)
    ;

CREATE  INDEX I_FK_PAYER_CONTRAT
     ON PAYER (IDCONSULTANT)
    ;

CREATE  INDEX I_FK_PAYER_CLIENT
     ON PAYER (IDCLIENT)
    ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE RIBEUROPEEN ADD 
     CONSTRAINT FK_RIBEUROPEEN_FINANCE
          FOREIGN KEY (IDFINANCE)
               REFERENCES FINANCE (IDFINANCE);

ALTER TABLE ONE_SHOT ADD 
     CONSTRAINT FK_ONE_SHOT_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

ALTER TABLE POURCENTAGE ADD 
     CONSTRAINT FK_POURCENTAGE_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

ALTER TABLE CLIENT ADD 
     CONSTRAINT FK_CLIENT_FINANCE
          FOREIGN KEY (IDFINANCE)
               REFERENCES FINANCE (IDFINANCE);

ALTER TABLE CLIENT ADD 
     CONSTRAINT FK_CLIENT_CONTACT
          FOREIGN KEY (IDCONTACT)
               REFERENCES CONTACT (IDCONTACT);

ALTER TABLE CONTRAT ADD 
     CONSTRAINT FK_CONTRAT_CLIENT
          FOREIGN KEY (IDCLIENT)
               REFERENCES CLIENT (IDCLIENT);

ALTER TABLE RIB ADD 
     CONSTRAINT FK_RIB_FINANCE
          FOREIGN KEY (IDFINANCE)
               REFERENCES FINANCE (IDFINANCE);

ALTER TABLE COMMISSION ADD 
     CONSTRAINT FK_COMMISSION_COMMERCIAUX
          FOREIGN KEY (IDCOMMERCIAUX)
               REFERENCES COMMERCIAUX (IDCOMMERCIAUX);

ALTER TABLE COMMERCIAUX ADD 
     CONSTRAINT FK_COMMERCIAUX_FINANCE
          FOREIGN KEY (IDFINANCE)
               REFERENCES FINANCE (IDFINANCE);

ALTER TABLE PRENDRE ADD 
     CONSTRAINT FK_PRENDRE_CONTRAT
          FOREIGN KEY (IDCONSULTANT)
               REFERENCES CONTRAT (IDCONSULTANT);

ALTER TABLE PRENDRE ADD 
     CONSTRAINT FK_PRENDRE_COMMISSION
          FOREIGN KEY (IDCOMMISSION)
               REFERENCES COMMISSION (IDCOMMISSION);

--ALTER TABLE PAYER ADD 
    -- CONSTRAINT FK_PAYER_FACTURE
         -- FOREIGN KEY (IDFACTURE)
              -- REFERENCES FACTURE (IDFACTURE);

ALTER TABLE PAYER ADD 
     CONSTRAINT FK_PAYER_CONTRAT
          FOREIGN KEY (IDCONSULTANT)
               REFERENCES CONTRAT (IDCONSULTANT);

ALTER TABLE PAYER ADD 
     CONSTRAINT FK_PAYER_CLIENT
          FOREIGN KEY (IDCLIENT)
               REFERENCES CLIENT (IDCLIENT);


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------