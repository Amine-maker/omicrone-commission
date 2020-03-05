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
    siret character varying(14),
    adr character(32),
    ville character(32),
    codepostal integer,
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
-- Name: commercial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commercial (
    idutilisateur integer NOT NULL,
    cacher boolean DEFAULT false
);


ALTER TABLE public.commercial OWNER TO postgres;

--
-- Name: commission; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commission (
    id integer NOT NULL,
    idcommercial integer NOT NULL,
    cacher boolean DEFAULT false
);


ALTER TABLE public.commission OWNER TO postgres;

--
-- Name: consultant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.consultant (
    idutilisateur integer NOT NULL,
    typecontrat character(32),
    salaire integer,
    tarif integer,
    cacher boolean DEFAULT false
);


ALTER TABLE public.consultant OWNER TO postgres;

--
-- Name: contact; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contact (
    id integer NOT NULL,
    email1 character(32),
    email2 character(32),
    email3 character(32),
    bureau integer,
    fax integer,
    tel3 integer,
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
    idutilisateur integer NOT NULL,
    datedebut timestamp(6) without time zone,
    datefin timestamp(6) without time zone,
    mission text,
    cacher boolean DEFAULT false
);


ALTER TABLE public.contrat OWNER TO postgres;

--
-- Name: contrat_idcontrat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contrat_idcontrat_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contrat_idcontrat_seq OWNER TO postgres;

--
-- Name: contrat_idcontrat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contrat_idcontrat_seq OWNED BY public.contrat.id;


--
-- Name: cra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cra (
    id integer NOT NULL,
    idcontrat integer NOT NULL,
    totaljfacturable real,
    totaljmaladie real,
    totaljconge real,
    astreinte character varying(128),
    periode character varying(128),
    intervention character varying(128),
    chemin text
);


ALTER TABLE public.cra OWNER TO postgres;

--
-- Name: cra_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cra_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cra_id_seq OWNER TO postgres;

--
-- Name: cra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cra_id_seq OWNED BY public.cra.id;


--
-- Name: depense_iddepense_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.depense_iddepense_seq
    START WITH 1
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.depense_iddepense_seq OWNER TO postgres;

--
-- Name: depense; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.depense (
    id integer DEFAULT nextval('public.depense_iddepense_seq'::regclass) NOT NULL,
    libelle character(32),
    montant integer,
    cacher boolean DEFAULT false
);


ALTER TABLE public.depense OWNER TO postgres;

--
-- Name: facture; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facture (
    id integer NOT NULL,
    idcra integer NOT NULL,
    libelle character(32),
    montant integer,
    datef date
);


ALTER TABLE public.facture OWNER TO postgres;

--
-- Name: facture_idfacture_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.facture_idfacture_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facture_idfacture_seq OWNER TO postgres;

--
-- Name: facture_idfacture_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.facture_idfacture_seq OWNED BY public.facture.id;


--
-- Name: infob; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.infob (
    id integer NOT NULL,
    idclient integer NOT NULL,
    idcommercial integer NOT NULL,
    codeagence character(32),
    compte character(32),
    iban character(32),
    bic character(32),
    codebanque character(32),
    clerib integer
);


ALTER TABLE public.infob OWNER TO postgres;

--
-- Name: infob_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.infob_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.infob_id_seq OWNER TO postgres;

--
-- Name: infob_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.infob_id_seq OWNED BY public.infob.id;


--
-- Name: oneshot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oneshot (
    idcommission integer NOT NULL,
    montant integer
);


ALTER TABLE public.oneshot OWNER TO postgres;

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
    idcommission integer NOT NULL,
    valeur integer
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
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateur (
    id integer NOT NULL,
    nom character varying(32),
    prenom character varying(32),
    adresse character varying(32),
    ville character varying(32),
    cp integer,
    tel integer,
    email character varying(32),
    login character varying(32),
    mdp character varying(32)
);


ALTER TABLE public.utilisateur OWNER TO postgres;

--
-- Name: utilisateur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilisateur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_id_seq OWNER TO postgres;

--
-- Name: utilisateur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilisateur_id_seq OWNED BY public.utilisateur.id;


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_idclient_seq'::regclass);


--
-- Name: contact id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contact ALTER COLUMN id SET DEFAULT nextval('public.contact_idcontact_seq'::regclass);


--
-- Name: contrat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat ALTER COLUMN id SET DEFAULT nextval('public.contrat_idcontrat_seq'::regclass);


--
-- Name: cra id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra ALTER COLUMN id SET DEFAULT nextval('public.cra_id_seq'::regclass);


--
-- Name: facture id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facture ALTER COLUMN id SET DEFAULT nextval('public.facture_idfacture_seq'::regclass);


--
-- Name: infob id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob ALTER COLUMN id SET DEFAULT nextval('public.infob_id_seq'::regclass);


--
-- Name: utilisateur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id SET DEFAULT nextval('public.utilisateur_id_seq'::regclass);


--
-- Name: client pk_client; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT pk_client PRIMARY KEY (id);


--
-- Name: commercial pk_commercial; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial
    ADD CONSTRAINT pk_commercial PRIMARY KEY (idutilisateur);


--
-- Name: commission pk_commission; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT pk_commission PRIMARY KEY (id);


--
-- Name: consultant pk_consultant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultant
    ADD CONSTRAINT pk_consultant PRIMARY KEY (idutilisateur);


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
-- Name: infob pk_infob; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT pk_infob PRIMARY KEY (id);


--
-- Name: oneshot pk_oneshot; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oneshot
    ADD CONSTRAINT pk_oneshot PRIMARY KEY (idcommission);


--
-- Name: payer pk_payer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payer
    ADD CONSTRAINT pk_payer PRIMARY KEY (idfacture, idcontrat, idclient);


--
-- Name: pourcentage pk_pourcentage; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pourcentage
    ADD CONSTRAINT pk_pourcentage PRIMARY KEY (idcommission);


--
-- Name: prendre pk_prendre; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prendre
    ADD CONSTRAINT pk_prendre PRIMARY KEY (idcontrat, idcommission);


--
-- Name: utilisateur pk_utilisateur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT pk_utilisateur PRIMARY KEY (id);


--
-- Name: client fk_client_contact; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT fk_client_contact FOREIGN KEY (idcontact) REFERENCES public.contact(id);


--
-- Name: commercial fk_commercial_utilisateur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial
    ADD CONSTRAINT fk_commercial_utilisateur FOREIGN KEY (idutilisateur) REFERENCES public.utilisateur(id);


--
-- Name: commission fk_commission_commercial; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commission
    ADD CONSTRAINT fk_commission_commercial FOREIGN KEY (idcommercial) REFERENCES public.commercial(idutilisateur);


--
-- Name: consultant fk_consultant_utilisateur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultant
    ADD CONSTRAINT fk_consultant_utilisateur FOREIGN KEY (idutilisateur) REFERENCES public.utilisateur(id);


--
-- Name: contrat fk_contrat_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_contrat_client FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: contrat fk_contrat_consultant; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrat
    ADD CONSTRAINT fk_contrat_consultant FOREIGN KEY (idutilisateur) REFERENCES public.consultant(idutilisateur);


--
-- Name: cra fk_cra_contrat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cra
    ADD CONSTRAINT fk_cra_contrat FOREIGN KEY (idcontrat) REFERENCES public.contrat(id);


--
-- Name: facture fk_facture_cra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facture
    ADD CONSTRAINT fk_facture_cra FOREIGN KEY (idcra) REFERENCES public.cra(id);


--
-- Name: infob fk_infob_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT fk_infob_client FOREIGN KEY (idclient) REFERENCES public.client(id);


--
-- Name: infob fk_infob_commercial; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infob
    ADD CONSTRAINT fk_infob_commercial FOREIGN KEY (idcommercial) REFERENCES public.commercial(idutilisateur);


--
-- Name: oneshot fk_oneshot_commission; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oneshot
    ADD CONSTRAINT fk_oneshot_commission FOREIGN KEY (idcommission) REFERENCES public.commission(id);


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
    ADD CONSTRAINT fk_pourcentage_commission FOREIGN KEY (idcommission) REFERENCES public.commission(id);


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

