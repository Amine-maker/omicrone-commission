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
    id integer NOT NULL,
    idcontact integer NOT NULL,
    raisonsocial character varying(32),
    siret character varying(32),
    adr character varying(32),
    ville character varying(32),
    codepostale character varying(32),
    cacher boolean DEFAULT false
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

ALTER SEQUENCE public.client_idclient_seq OWNED BY public.client.id;


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
    cp character varying(32),
    cacher boolean DEFAULT false
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
    id integer NOT NULL,
    idcommerciaux integer NOT NULL,
    cacher boolean DEFAULT false
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

ALTER SEQUENCE public.commission_idcommission_seq OWNED BY public.commission.id;


--
-- Name: consultant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.consultant (
    id integer NOT NULL,
    nom character varying(32),
    prenom character varying(32),
    adr character varying(32),
    ville character varying(32),
    cp integer,
    tel integer,
    email character varying(32),
    cacher boolean DEFAULT false
);


ALTER TABLE public.consultant OWNER TO postgres;

--
-- Name: consulant_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.consulant_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.consulant_id_seq OWNER TO postgres;

--
-- Name: consulant_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.consulant_id_seq OWNED BY public.consultant.id;


--
-- Name: contact; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contact (
    id integer NOT NULL,
    email1 character varying(128),
    email2 character varying(128),
    email3 character varying(128),
    bureau character varying(20),
    fax character varying(20),
    tel3 character varying(10),
    cacher boolean DEFAULT false
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

ALTER SEQUENCE public.contact_idcontact_seq OWNED BY public.contact.id;


--
-- Name: contrat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contrat (
    id integer NOT NULL,
    idclient integer NOT NULL,
    datedebut date,
    datefin date,
    salaire integer,
    tarif integer,
    typecontrat character varying(20),
    idconsultant integer,
    mission character varying(200),
    cacher boolean DEFAULT false
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

ALTER SEQUENCE public.contrat_idconsultant_seq OWNED BY public.contrat.id;


--
-- Name: cra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cra (
    id integer NOT NULL,
    totaljfacturable real,
    totaljmaladie real,
    totaljconge real,
    astreinte character varying(300),
    idcontrat integer,
    periode character varying(20),
    intervention character varying(300)
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

ALTER SEQUENCE public.cra_idcra_seq OWNED BY public.cra.id;


--
-- Name: depense; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.depense (
    id integer NOT NULL,
    libelle character varying(32),
    montant integer,
    cacher boolean DEFAULT false
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
-- Name: facture_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.facture_id_seq
    START WITH 1
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facture_id_seq OWNER TO postgres;

--
-- Name: facture; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facture (
    id integer DEFAULT nextval('public.facture_id_seq'::regclass) NOT NULL,
    datef date,
    montant character varying(32),
    qt integer,
    tva integer
);


ALTER TABLE public.facture OWNER TO postgres;

--
-- Name: infob; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.infob (
    id integer NOT NULL,
    idclient integer,
    idcommerciaux integer,
    codeagence integer,
    compte character varying(32),
    iban character varying(32),
    bic character varying(32),
    codebanque integer,
    clerib integer,
    cacher boolean DEFAULT false
);


ALTER TABLE public.infob OWNER TO postgres;

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

ALTER SEQUENCE public.finance_idfinance_seq OWNED BY public.infob.id;


--
-- Name: one_shot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.one_shot (
    id integer NOT NULL,
    montant character varying(32)
);


ALTER TABLE public.one_shot OWNER TO postgres;

--
-- Name: payer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payer (
    idfacture integer NOT NULL,
    idcontrat integer NOT NULL,
    idclient integer NOT NULL
);


ALTER TABLE public.payer OWNER TO postgres;

--
-- Name: pourcentage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pourcentage (
    id integer NOT NULL,
    valeur character varying(32)
);


ALTER TABLE public.pourcentage OWNER TO postgres;

--
-- Name: prendre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prendre (
    idcontrat integer NOT NULL,
    idcommission integer NOT NULL
);


ALTER TABLE public.prendre OWNER TO postgres;

--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_idclient_seq'::regclass);


--
-- Name: commerciaux id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commerciaux ALTER COLUMN id SET DEFAULT nextval('public.commerciaux_idcommerciaux_seq'::regclass);


--
-- Name: commission id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission ALTER COLUMN id SET DEFAULT nextval('public.commission_idcommission_seq'::regclass);


--
-- Name: consultant id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultant ALTER COLUMN id SET DEFAULT nextval('public.consulant_id_seq'::regclass);


--
-- Name: contact id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contact ALTER COLUMN id SET DEFAULT nextval('public.contact_idcontact_seq'::regclass);


--
-- Name: contrat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat ALTER COLUMN id SET DEFAULT nextval('public.contrat_idconsultant_seq'::regclass);


--
-- Name: cra id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra ALTER COLUMN id SET DEFAULT nextval('public.cra_idcra_seq'::regclass);


--
-- Name: depense id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depense ALTER COLUMN id SET DEFAULT nextval('public.depense_iddepense_seq'::regclass);


--
-- Name: infob id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob ALTER COLUMN id SET DEFAULT nextval('public.finance_idfinance_seq'::regclass);


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.client VALUES (5, 5, 'jhhg', '5465484654894', '78 rue des templiers', 'anemoix', '89999', true);
INSERT INTO public.client VALUES (6, 6, 'hitango', '5465484654894', '20 rue amer tachni', 'nio', '46123', true);
INSERT INTO public.client VALUES (9, 4, 'hgjh', '5465484654894', '133 rue louis rouquier', 'levallois', '92300', true);
INSERT INTO public.client VALUES (10, 10, 'hitango', '5465484654894', 'ghgh', '54Gramatjh', '46123', false);
INSERT INTO public.client VALUES (3, 3, 'hgjh', '12345678910111', ' rue loui65s rouquier', 'levallois', '92300', true);
INSERT INTO public.client VALUES (2, 1, 'hjg', '12345678910111', 'hv', 'hhg', '0', true);
INSERT INTO public.client VALUES (8, 8, 'hitango', '7', '232 ue des Te', 'Gramatnb', '46123', true);
INSERT INTO public.client VALUES (7, 7, 'hitango', '5465484654894', '22 rue des Terneshg', 'Gramatnb', '461238', true);


--
-- Data for Name: commerciaux; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.commerciaux VALUES (81, 'aston', 'mitroglu', '0689966963', 'jho.ga@gmail.com', '78 rue des templiers', 'anemoix', '90000', true);
INSERT INTO public.commerciaux VALUES (82, 'aston', 'mitroglu', '0689966963', 'jho.ga@gmail.com', '78 rue des templiers', 'anemoix', '89999', true);
INSERT INTO public.commerciaux VALUES (84, 'fatou', 'camara', '0689966963', 'jho.ga@gmail.com', '78 rue des templiers', 'anemoix', '90000', true);
INSERT INTO public.commerciaux VALUES (83, 'djennadi', 'Louis', '0686899626', 'hg@jhg.fr', '22 rue des Ternes', 'Gramat', '46126', true);
INSERT INTO public.commerciaux VALUES (85, 'fhgf', 'test', '0114411552', 'amines@c.com', 'llk', 'vb', '78', false);
INSERT INTO public.commerciaux VALUES (86, 'uh', 'jh', '0114411552', 'amines@jjc.com', 'j', 'kj', '4', false);
INSERT INTO public.commerciaux VALUES (76, 'djennadi', 'ughjg', '454', 'hg@jhg.fr', '22 rue des Ternes', 'Gramat', '78', true);
INSERT INTO public.commerciaux VALUES (79, 'djennadi', 'Louis', '0686899626', 'hg@jhg.fr', '22 rue des Ternes', 'Gramatee', '46123', true);
INSERT INTO public.commerciaux VALUES (80, 'djennadi', 'Louis', '0686899626', 'hg@jhg.fr', '22 rue des Ternes', 'Gramat', '46123', true);


--
-- Data for Name: commission; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.commission VALUES (73, 82, true);
INSERT INTO public.commission VALUES (74, 83, true);
INSERT INTO public.commission VALUES (75, 83, true);
INSERT INTO public.commission VALUES (76, 83, false);
INSERT INTO public.commission VALUES (77, 83, true);
INSERT INTO public.commission VALUES (78, 83, true);
INSERT INTO public.commission VALUES (79, 83, true);
INSERT INTO public.commission VALUES (80, 83, true);
INSERT INTO public.commission VALUES (81, 83, false);
INSERT INTO public.commission VALUES (82, 83, true);
INSERT INTO public.commission VALUES (83, 83, true);
INSERT INTO public.commission VALUES (84, 83, false);
INSERT INTO public.commission VALUES (85, 83, false);


--
-- Data for Name: consultant; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.consultant VALUES (1, 'jhon', 'histeramine', '133 rue sofia', 'sofia', 89999, 147788999, 'jhjhh@jh.fr', true);
INSERT INTO public.consultant VALUES (3, 'hghg', 'jg', '133 rue louis rouquier', 'l', 92300, 686899626, 'hg@jhg.fr', false);


--
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contact VALUES (2, 'aoiuih@fgkj.com', 'hgf@hk.com', NULL, '219799964', '198899556', NULL, false);
INSERT INTO public.contact VALUES (3, 'hg@jhg.fr', 'hg@jhg.fr', 'hg@jhg.fr', '0', '0', '686899626', false);
INSERT INTO public.contact VALUES (1, 'jhhjg@yghg.fr', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '0', false);
INSERT INTO public.contact VALUES (8, 'hg@jhg.fr', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '199999999', false);
INSERT INTO public.contact VALUES (7, 'hg@jhg.fr', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '686899626', false);
INSERT INTO public.contact VALUES (9, 'hg@jhg.fr', 'hg@jhg.fr', 'hg@jhg.fr', '64', '6887', '686899626', false);
INSERT INTO public.contact VALUES (5, 'jho.ga@gmail.com', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '689966963', false);
INSERT INTO public.contact VALUES (6, 'hg@jhg.fr', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '198899663', false);
INSERT INTO public.contact VALUES (4, 'hg@jhg.fr', 'hg@jhg.fr', 'hg@jhg.fr', '64', '6887', '686899626', false);
INSERT INTO public.contact VALUES (10, 'hg@jhg.fr', 'xxx@xxx.xx', 'xxx@xxx.xx', '0', '0', '0686899626', false);


--
-- Data for Name: contrat; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contrat VALUES (9, 3, '2020-01-15', '2020-01-01', 55, 0, 'Salarié', 1, 'gd', false);
INSERT INTO public.contrat VALUES (1, 2, '2019-10-27', '2019-10-27', 215000, 100, 'salarié', 1, NULL, true);
INSERT INTO public.contrat VALUES (11, 3, '2020-01-15', '2020-01-01', 55, 0, 'Salarié', 1, 'gd', true);
INSERT INTO public.contrat VALUES (10, 3, '2020-01-15', '2020-01-01', 55, 0, 'Salarié', 1, 'gd', true);
INSERT INTO public.contrat VALUES (13, 5, '2020-01-03', '2020-01-26', 10, 10, 'Salarié', 1, 'fgh', false);
INSERT INTO public.contrat VALUES (14, 5, '2020-01-03', '2020-01-12', 10, 0, 'Salarié', 1, 'gdg', false);
INSERT INTO public.contrat VALUES (15, 5, '2020-02-03', '2020-03-26', 82, 0, 'Salarié', 1, 'salut', false);
INSERT INTO public.contrat VALUES (4, 2, '2020-12-20', '2019-07-07', 0, 58, 'Salarie', 1, NULL, true);
INSERT INTO public.contrat VALUES (7, 2, '2020-12-20', '2019-07-07', 0, 58, 'Salarie', 1, NULL, true);
INSERT INTO public.contrat VALUES (8, 2, '2000-02-27', '2000-01-28', 15, 0, 'Sous-traitant', 1, 'jn', false);
INSERT INTO public.contrat VALUES (12, 5, '2020-01-01', '2021-01-01', 5, 0, 'Salarié', 1, 'salut', false);


--
-- Data for Name: cra; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cra VALUES (245, 0, 0, 0, '', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (246, 0, 0, 0, '', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (247, 0, 0, 0, 'hghg', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (248, 0, 0, 0, 'hghg', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (249, 0, 0, 0, 'uu', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (250, 0, 0, 0, 'uu', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (251, 0, 0, 0, '', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (252, 0, 0, 0, 'yy', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (253, 0, 0, 0, 'yy', 12, 'fevrier2020', NULL);
INSERT INTO public.cra VALUES (254, 0, 0, 0, 'uh', 12, 'fevrier2020', 'hg');
INSERT INTO public.cra VALUES (244, 0, 0, 0, '', 12, 'fevrier2020', NULL);


--
-- Data for Name: depense; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.depense VALUES (29, 'jh', 0, false);
INSERT INTO public.depense VALUES (28, 'hjh', 897, false);
INSERT INTO public.depense VALUES (25, 'gf', 150, false);
INSERT INTO public.depense VALUES (26, 'hjg', 65, false);
INSERT INTO public.depense VALUES (23, 'uyg', 150, false);
INSERT INTO public.depense VALUES (22, 'ssaportir', 5457, false);
INSERT INTO public.depense VALUES (24, 'yghf', 45, false);
INSERT INTO public.depense VALUES (33, 'hhhhhhhh', 300000, true);
INSERT INTO public.depense VALUES (27, 'jkn', 87, true);
INSERT INTO public.depense VALUES (32, 'hhhhhhhhhhhhhhh', 5555555, true);
INSERT INTO public.depense VALUES (31, 'jyrc', 150, true);
INSERT INTO public.depense VALUES (30, 'sortie', 454, true);


--
-- Data for Name: facture; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.facture VALUES (1, '2020-01-20', '215000', NULL, NULL);
INSERT INTO public.facture VALUES (2, '2020-01-20', '215000', NULL, NULL);
INSERT INTO public.facture VALUES (3, '2019-10-27', '215000', NULL, NULL);
INSERT INTO public.facture VALUES (4, '2020-01-01', '55', NULL, NULL);
INSERT INTO public.facture VALUES (5, '2019-10-27', '215000', NULL, NULL);
INSERT INTO public.facture VALUES (6, '2020-01-23', '0', NULL, NULL);


--
-- Data for Name: infob; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: one_shot; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.one_shot VALUES (73, '54');
INSERT INTO public.one_shot VALUES (74, '57');
INSERT INTO public.one_shot VALUES (76, '1');
INSERT INTO public.one_shot VALUES (81, '0');


--
-- Data for Name: payer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.payer VALUES (1, 1, 2);
INSERT INTO public.payer VALUES (2, 1, 2);
INSERT INTO public.payer VALUES (3, 1, 2);
INSERT INTO public.payer VALUES (4, 11, 3);
INSERT INTO public.payer VALUES (5, 1, 2);
INSERT INTO public.payer VALUES (6, 4, 2);


--
-- Data for Name: pourcentage; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pourcentage VALUES (85, '0');
INSERT INTO public.pourcentage VALUES (75, '');
INSERT INTO public.pourcentage VALUES (77, '');
INSERT INTO public.pourcentage VALUES (78, '');
INSERT INTO public.pourcentage VALUES (79, '');
INSERT INTO public.pourcentage VALUES (80, '');
INSERT INTO public.pourcentage VALUES (82, '');
INSERT INTO public.pourcentage VALUES (83, '');
INSERT INTO public.pourcentage VALUES (84, '');


--
-- Data for Name: prendre; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.prendre VALUES (8, 73);
INSERT INTO public.prendre VALUES (8, 74);
INSERT INTO public.prendre VALUES (15, 75);
INSERT INTO public.prendre VALUES (15, 76);
INSERT INTO public.prendre VALUES (15, 77);
INSERT INTO public.prendre VALUES (15, 78);
INSERT INTO public.prendre VALUES (15, 79);
INSERT INTO public.prendre VALUES (15, 80);
INSERT INTO public.prendre VALUES (15, 81);
INSERT INTO public.prendre VALUES (15, 82);
INSERT INTO public.prendre VALUES (15, 83);
INSERT INTO public.prendre VALUES (15, 84);
INSERT INTO public.prendre VALUES (15, 85);


--
-- Name: client_idclient_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_idclient_seq', 10, true);


--
-- Name: commerciaux_idcommerciaux_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commerciaux_idcommerciaux_seq', 86, true);


--
-- Name: commission_idcommission_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commission_idcommission_seq', 85, true);


--
-- Name: consulant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.consulant_id_seq', 3, true);


--
-- Name: contact_idcontact_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contact_idcontact_seq', 10, true);


--
-- Name: contrat_idconsultant_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contrat_idconsultant_seq', 1, false);


--
-- Name: cra_idcra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cra_idcra_seq', 254, true);


--
-- Name: depense_iddepense_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.depense_iddepense_seq', 33, true);


--
-- Name: facture_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.facture_id_seq', 6, true);


--
-- Name: finance_idfinance_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.finance_idfinance_seq', 49, true);


--
-- Name: consultant consulant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultant
    ADD CONSTRAINT consulant_pkey PRIMARY KEY (id);


--
-- Name: consultant consulant_tel_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultant
    ADD CONSTRAINT consulant_tel_key UNIQUE (tel);


--
-- Name: client pk_client; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT pk_client PRIMARY KEY (id);


--
-- Name: commerciaux pk_commerciaux; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commerciaux
    ADD CONSTRAINT pk_commerciaux PRIMARY KEY (id);


--
-- Name: commission pk_commission; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT pk_commission PRIMARY KEY (id);


--
-- Name: contact pk_contact; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contact
    ADD CONSTRAINT pk_contact PRIMARY KEY (id);


--
-- Name: contrat pk_contrat; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT pk_contrat PRIMARY KEY (id);


--
-- Name: cra pk_cra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra
    ADD CONSTRAINT pk_cra PRIMARY KEY (id);


--
-- Name: depense pk_depense; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depense
    ADD CONSTRAINT pk_depense PRIMARY KEY (id);


--
-- Name: facture pk_facture; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facture
    ADD CONSTRAINT pk_facture PRIMARY KEY (id);


--
-- Name: infob pk_finance; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT pk_finance PRIMARY KEY (id);


--
-- Name: one_shot pk_one_shot; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.one_shot
    ADD CONSTRAINT pk_one_shot PRIMARY KEY (id);


--
-- Name: payer pk_payer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT pk_payer PRIMARY KEY (idfacture, idcontrat, idclient);


--
-- Name: pourcentage pk_pourcentage; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pourcentage
    ADD CONSTRAINT pk_pourcentage PRIMARY KEY (id);


--
-- Name: prendre pk_prendre; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT pk_prendre PRIMARY KEY (idcontrat, idcommission);


--
-- Name: client fk_client_contact; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT fk_client_contact FOREIGN KEY (idcontact) REFERENCES public.contact(id);


--
-- Name: commission fk_commission_commerciaux; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT fk_commission_commerciaux FOREIGN KEY (idcommerciaux) REFERENCES public.commerciaux(id);


--
-- Name: contrat fk_consultant_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_consultant_contrat FOREIGN KEY (idconsultant) REFERENCES public.consultant(id);


--
-- Name: contrat fk_contrat_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_contrat_client FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: cra fk_cra_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra
    ADD CONSTRAINT fk_cra_contrat FOREIGN KEY (idcontrat) REFERENCES public.contrat(id);


--
-- Name: infob fk_finance_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT fk_finance_client FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: infob fk_finance_commerciaux; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT fk_finance_commerciaux FOREIGN KEY (idcommerciaux) REFERENCES public.commerciaux(id);


--
-- Name: one_shot fk_one_shot_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.one_shot
    ADD CONSTRAINT fk_one_shot_commission FOREIGN KEY (id) REFERENCES public.commission(id);


--
-- Name: payer fk_payer_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_client FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: payer fk_payer_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_contrat FOREIGN KEY (idcontrat) REFERENCES public.contrat(id);


--
-- Name: payer fk_payer_facture; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT fk_payer_facture FOREIGN KEY (idfacture) REFERENCES public.facture(id);


--
-- Name: pourcentage fk_pourcentage_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pourcentage
    ADD CONSTRAINT fk_pourcentage_commission FOREIGN KEY (id) REFERENCES public.commission(id);


--
-- Name: prendre fk_prendre_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT fk_prendre_commission FOREIGN KEY (idcommission) REFERENCES public.commission(id);


--
-- Name: prendre fk_prendre_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT fk_prendre_contrat FOREIGN KEY (idcontrat) REFERENCES public.contrat(id);


--
-- PostgreSQL database dump complete
--

