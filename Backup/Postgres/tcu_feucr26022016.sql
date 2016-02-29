--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.5
-- Dumped by pg_dump version 9.4.5
-- Started on 2016-02-26 15:57:09 CST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 174 (class 3079 OID 11935)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 174
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 173 (class 1259 OID 40368)
-- Name: association; Type: TABLE; Schema: public; Owner: ricardo; Tablespace: 
--

CREATE TABLE association (
    location character varying(100)[],
    schedule character varying(100)[],
    acronym character varying(16)[] NOT NULL,
    name character varying(70)[] NOT NULL,
    id integer NOT NULL
);


ALTER TABLE association OWNER TO ricardo;

--
-- TOC entry 172 (class 1259 OID 40366)
-- Name: association_id_seq; Type: SEQUENCE; Schema: public; Owner: ricardo
--

CREATE SEQUENCE association_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE association_id_seq OWNER TO ricardo;

--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 172
-- Name: association_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ricardo
--

ALTER SEQUENCE association_id_seq OWNED BY association.id;


--
-- TOC entry 1960 (class 2604 OID 40371)
-- Name: id; Type: DEFAULT; Schema: public; Owner: ricardo
--

ALTER TABLE ONLY association ALTER COLUMN id SET DEFAULT nextval('association_id_seq'::regclass);


--
-- TOC entry 2073 (class 0 OID 40368)
-- Dependencies: 173
-- Data for Name: association; Type: TABLE DATA; Schema: public; Owner: ricardo
--

COPY association (location, schedule, acronym, name, id) FROM stdin;
\.


--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 172
-- Name: association_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ricardo
--

SELECT pg_catalog.setval('association_id_seq', 1, false);


--
-- TOC entry 1962 (class 2606 OID 40376)
-- Name: association_pkey; Type: CONSTRAINT; Schema: public; Owner: ricardo; Tablespace: 
--

ALTER TABLE ONLY association
    ADD CONSTRAINT association_pkey PRIMARY KEY (id);


--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-02-26 15:57:10 CST

--
-- PostgreSQL database dump complete
--

