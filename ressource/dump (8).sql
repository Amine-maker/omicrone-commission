--
-- PostgreSQL database dump
--

-- Dumped from database version 12.1
-- Dumped by pg_dump version 12.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    idclient integer NOT NULL,
    idcontact integer NOT NULL,
    raisonsocial character varying(32),
    siret character varying(32),
    adr character varying(32),
    ville character varying(32),
    codepostale character varying(32)
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_idclient_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_idclient_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_idclient_seq OWNER TO postgres;

--
-- Name: client_idclient_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_idclient_seq OWNED BY public.client.idclient;


--
-- Name: commerciaux; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commerciaux (
    id integer NOT NULL,
    nom character varying(32),
    prenom character varying(32),
    tel character varying(32),
    email character varying(32),
    adresse character varying(32),
    ville character varying(32),
    cp character varying(32)
);


ALTER TABLE public.commerciaux OWNER TO postgres;

--
-- Name: commerciaux_idcommerciaux_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commerciaux_idcommerciaux_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commerciaux_idcommerciaux_seq OWNER TO postgres;

--
-- Name: commerciaux_idcommerciaux_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commerciaux_idcommerciaux_seq OWNED BY public.commerciaux.id;


--
-- Name: commission; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commission (
    idcommission integer NOT NULL,
    idcommerciaux integer NOT NULL
);


ALTER TABLE public.commission OWNER TO postgres;

--
-- Name: commission_idcommission_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commission_idcommission_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commission_idcommission_seq OWNER TO postgres;

--
-- Name: commission_idcommission_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commission_idcommission_seq OWNED BY public.commission.idcommission;


--
-- Name: contact; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contact (
    idcontact integer NOT NULL,
    email1 character varying(128),
    email2 character varying(128),
    email3 character varying(128),
    bureau integer,
    fax integer,
    tel3 integer
);


ALTER TABLE public.contact OWNER TO postgres;

--
-- Name: contact_idcontact_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contact_idcontact_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contact_idcontact_seq OWNER TO postgres;

--
-- Name: contact_idcontact_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contact_idcontact_seq OWNED BY public.contact.idcontact;


--
-- Name: contrat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contrat (
    idcontrat integer NOT NULL,
    idclient integer NOT NULL,
    datedebut date,
    datefin date,
    nbjtravailler integer,
    salaire integer,
    tarif integer,
    typecontrat character varying(20),
    idcra integer
);


ALTER TABLE public.contrat OWNER TO postgres;

--
-- Name: contrat_idconsultant_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contrat_idconsultant_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contrat_idconsultant_seq OWNER TO postgres;

--
-- Name: contrat_idconsultant_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contrat_idconsultant_seq OWNED BY public.contrat.idcontrat;


--
-- Name: cra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cra (
    idcra integer NOT NULL,
    nbjourstravaille integer
);


ALTER TABLE public.cra OWNER TO postgres;

--
-- Name: cra_idcra_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cra_idcra_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cra_idcra_seq OWNER TO postgres;

--
-- Name: cra_idcra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cra_idcra_seq OWNED BY public.cra.idcra;


--
-- Name: depense; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.depense (
    id integer NOT NULL,
    libelle character varying(32),
    montant integer
);


ALTER TABLE public.depense OWNER TO postgres;

--
-- Name: depense_iddepense_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.depense_iddepense_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.depense_iddepense_seq OWNER TO postgres;

--
-- Name: depense_iddepense_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.depense_iddepense_seq OWNED BY public.depense.id;


--
-- Name: facture; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facture (
    idfacture integer NOT NULL,
    datef date,
    montant character varying(32),
    "quantitÉ" character varying(32),
    prixht character varying(32),
    tva character varying(32)
);


ALTER TABLE public.facture OWNER TO postgres;

--
-- Name: information_bancaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.information_bancaire (
    idfinance integer NOT NULL,
    idclient integer,
    idcommerciaux integer,
    codeagence integer,
    compte character varying(32),
    iban character varying(32),
    bic character varying(32),
    codebanque integer,
    clerib integer
);


ALTER TABLE public.information_bancaire OWNER TO postgres;

--
-- Name: finance_idfinance_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.finance_idfinance_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.finance_idfinance_seq OWNER TO postgres;

--
-- Name: finance_idfinance_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.finance_idfinance_seq OWNED BY public.information_bancaire.idfinance;


--
-- Name: one_shot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.one_shot (
    idcommission integer NOT NULL,
    montant integer
);


ALTER TABLE public.one_shot OWNER TO postgres;

--
-- Name: payer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payer (
    idfacture integer NOT NULL,
    idconsultant integer NOT NULL,
    idclient integer NOT NULL
);


ALTER TABLE public.payer OWNER TO postgres;

--
-- Name: pourcentage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pourcentage (
    idcommission integer NOT NULL,
    valeur character varying(32)
);


ALTER TABLE public.pourcentage OWNER TO postgres;

--
-- Name: prendre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prendre (
    idconsultant integer NOT NULL,
    idcommission integer NOT NULL
);


ALTER TABLE public.prendre OWNER TO postgres;

--
-- Name: client idclient; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN idclient SET DEFAULT nextval('public.client_idclient_seq'::regclass);


--
-- Name: commerciaux id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commerciaux ALTER COLUMN id SET DEFAULT nextval('public.commerciaux_idcommerciaux_seq'::regclass);


--
-- Name: commission idcommission; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission ALTER COLUMN idcommission SET DEFAULT nextval('public.commission_idcommission_seq'::regclass);


--
-- Name: contact idcontact; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contact ALTER COLUMN idcontact SET DEFAULT nextval('public.contact_idcontact_seq'::regclass);


--
-- Name: contrat idcontrat; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat ALTER COLUMN idcontrat SET DEFAULT nextval('public.contrat_idconsultant_seq'::regclass);


--
-- Name: cra idcra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra ALTER COLUMN idcra SET DEFAULT nextval('public.cra_idcra_seq'::regclass);


--
-- Name: depense id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depense ALTER COLUMN id SET DEFAULT nextval('public.depense_iddepense_seq'::regclass);


--
-- Name: information_bancaire idfinance; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.information_bancaire ALTER COLUMN idfinance SET DEFAULT nextval('public.finance_idfinance_seq'::regclass);


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.client VALUES (1, 1, 'bonjour      ', '65654', '1 rue bonjour', 'catek', '201666       ');
INSERT INTO public.client VALUES (2, 1, 'uy', '5464', 'hgf', 'h', '98');


--
-- Data for Name: commerciaux; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.commerciaux VALUES (40, 'djennaxdii', 'amine', '0686899629', 'hg@jhg.fr', '133 rue louis rouquier', 'levallois', '92300');
INSERT INTO public.commerciaux VALUES (39, 'djennaj', 'amine', '0686899629', 'hg@hg', '133 rue louis rouquier', 'levalloisidjhhkg', '92300000000');
INSERT INTO public.commerciaux VALUES (1, 'joe', 'dji', '2896546867', 'gfhgf@ku.tr', 'jgt65utv', 'uy', '23');


--
-- Data for Name: commission; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.commission VALUES (1, 1);
INSERT INTO public.commission VALUES (2, 1);
INSERT INTO public.commission VALUES (3, 1);
INSERT INTO public.commission VALUES (5, 1);
INSERT INTO public.commission VALUES (4, 40);
INSERT INTO public.commission VALUES (7, 39);


--
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contact VALUES (1, 'amine.jhjh@gmail.com', NULL, NULL, 656899656, NULL, NULL);
INSERT INTO public.contact VALUES (2, 'aoiuih@fgkj.com', 'hgf@hk.com', NULL, 219799964, 198899556, NULL);


--
-- Data for Name: contrat; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contrat VALUES (1, 2, '2019-10-27', '2019-10-27', 20, 215000, 100, 'salarié', NULL);
INSERT INTO public.contrat VALUES (2, 2, '2020-12-20', '2019-07-07', NULL, 0, 58, 'Salarie', NULL);
INSERT INTO public.contrat VALUES (3, 2, '2020-12-20', '2019-07-07', NULL, 0, 58, 'Salarie', NULL);
INSERT INTO public.contrat VALUES (4, 2, '2020-12-20', '2019-07-07', NULL, 0, 58, 'Salarie', NULL);
INSERT INTO public.contrat VALUES (7, 2, '2020-12-20', '2019-07-07', NULL, 0, 58, 'Salarie', NULL);


--
-- Data for Name: cra; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: depense; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.depense VALUES (11, 'sortie', 5457);


--
-- Data for Name: facture; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.facture VALUES (1, '2019-12-10', '200', '10', '200', '20');


--
-- Data for Name: information_bancaire; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: one_shot; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.one_shot VALUES (7, 7886);


--
-- Data for Name: payer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.payer VALUES (1, 1, 2);


--
-- Data for Name: pourcentage; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pourcentage VALUES (3, '20');


--
-- Data for Name: prendre; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.prendre VALUES (1, 3);


--
-- Name: client_idclient_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_idclient_seq', 2, true);


--
-- Name: commerciaux_idcommerciaux_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commerciaux_idcommerciaux_seq', 53, true);


--
-- Name: commission_idcommission_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commission_idcommission_seq', 7, true);


--
-- Name: contact_idcontact_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contact_idcontact_seq', 1, false);


--
-- Name: contrat_idconsultant_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contrat_idconsultant_seq', 1, false);


--
-- Name: cra_idcra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cra_idcra_seq', 1, false);


--
-- Name: depense_iddepense_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.depense_iddepense_seq', 12, true);


--
-- Name: finance_idfinance_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.finance_idfinance_seq', 49, true);


--
-- Name: client pk_client; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT pk_client PRIMARY KEY (idclient);


--
-- Name: commerciaux pk_commerciaux; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commerciaux
    ADD CONSTRAINT pk_commerciaux PRIMARY KEY (id);


--
-- Name: commission pk_commission; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT pk_commission PRIMARY KEY (idcommission);


--
-- Name: contact pk_contact; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contact
    ADD CONSTRAINT pk_contact PRIMARY KEY (idcontact);


--
-- Name: contrat pk_contrat; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT pk_contrat PRIMARY KEY (idcontrat);


--
-- Name: cra pk_cra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra
    ADD CONSTRAINT pk_cra PRIMARY KEY (idcra);


--
-- Name: depense pk_depense; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depense
    ADD CONSTRAINT pk_depense PRIMARY KEY (id);


--
-- Name: facture pk_facture; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facture
    ADD CONSTRAINT pk_facture PRIMARY KEY (idfacture);


--
-- Name: information_bancaire pk_finance; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.information_bancaire
    ADD CONSTRAINT pk_finance PRIMARY KEY (idfinance);


--
-- Name: one_shot pk_one_shot; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.one_shot
    ADD CONSTRAINT pk_one_shot PRIMARY KEY (idcommission);


--
-- Name: payer pk_payer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT pk_payer PRIMARY KEY (idfacture, idconsultant, idclient);


--
-- Name: pourcentage pk_pourcentage; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pourcentage
    ADD CONSTRAINT pk_pourcentage PRIMARY KEY (idcommission);


--
-- Name: prendre pk_prendre; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT pk_prendre PRIMARY KEY (idconsultant, idcommission);


--
-- Name: i_fk_contrat_cra; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_contrat_cra ON public.contrat USING btree (idcra);


--
-- Name: client fk_client_contact; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT fk_client_contact FOREIGN KEY (idcontact) REFERENCES public.contact(idcontact);


--
-- Name: commission fk_commission_commerciaux; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT fk_commission_commerciaux FOREIGN KEY (idcommerciaux) REFERENCES public.commerciaux(id);


--
-- Name: contrat fk_contrat_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_contrat_client FOREIGN KEY (idclient) REFERENCES public.client(idclient);


--
-- Name: contrat fk_contrat_cra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_contrat_cra FOREIGN KEY (idcra) REFERENCES public.cra(idcra);


--
-- Name: information_bancaire fk_finance_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.information_bancaire
    ADD CONSTRAINT fk_finance_client FOREIGN KEY (idclient) REFERENCES public.client(idclient);


--
-- Name: information_bancaire fk_finance_commerciaux; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.information_bancaire
    ADD CONSTRAINT fk_finance_commerciaux FOREIGN KEY (idcommerciaux) REFERENCES public.commerciaux(id);


--
-- Name: one_shot fk_one_shot_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.one_shot
    ADD CONSTRAINT fk_one_shot_commission FOREIGN KEY (idcommission) REFERENCES public.commission(idcommission);


--
-- Name: payer fk_payer_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_client FOREIGN KEY (idclient) REFERENCES public.client(idclient);


--
-- Name: payer fk_payer_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_contrat FOREIGN KEY (idconsultant) REFERENCES public.contrat(idcontrat);


--
-- Name: payer fk_payer_facture; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_facture FOREIGN KEY (idfacture) REFERENCES public.facture(idfacture);


--
-- Name: pourcentage fk_pourcentage_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pourcentage
    ADD CONSTRAINT fk_pourcentage_commission FOREIGN KEY (idcommission) REFERENCES public.commission(idcommission);


--
-- Name: prendre fk_prendre_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT fk_prendre_commission FOREIGN KEY (idcommission) REFERENCES public.commission(idcommission);


--
-- Name: prendre fk_prendre_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT fk_prendre_contrat FOREIGN KEY (idconsultant) REFERENCES public.contrat(idcontrat);


--
-- PostgreSQL database dump complete
--

