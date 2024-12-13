--
-- PostgreSQL database dump
--

-- Dumped from database version 13.18
-- Dumped by pg_dump version 13.18

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
-- Name: clase_clientes; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.clase_clientes (
    id integer NOT NULL,
    clase_id integer NOT NULL,
    cliente_id integer NOT NULL
);


ALTER TABLE public.clase_clientes OWNER TO fcb6c35;

--
-- Name: clase_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.clase_clientes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clase_clientes_id_seq OWNER TO fcb6c35;

--
-- Name: clase_clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.clase_clientes_id_seq OWNED BY public.clase_clientes.id;


--
-- Name: clase_equipos; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.clase_equipos (
    id integer NOT NULL,
    clase_id integer NOT NULL,
    equipo_id integer NOT NULL
);


ALTER TABLE public.clase_equipos OWNER TO fcb6c35;

--
-- Name: clase_equipos_clase_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.clase_equipos_clase_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clase_equipos_clase_id_seq OWNER TO fcb6c35;

--
-- Name: clase_equipos_clase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.clase_equipos_clase_id_seq OWNED BY public.clase_equipos.clase_id;


--
-- Name: clase_equipos_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.clase_equipos_equipo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clase_equipos_equipo_id_seq OWNER TO fcb6c35;

--
-- Name: clase_equipos_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.clase_equipos_equipo_id_seq OWNED BY public.clase_equipos.equipo_id;


--
-- Name: clase_equipos_id_ins_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.clase_equipos_id_ins_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clase_equipos_id_ins_seq OWNER TO fcb6c35;

--
-- Name: clase_equipos_id_ins_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.clase_equipos_id_ins_seq OWNED BY public.clase_equipos.id;


--
-- Name: clases; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.clases (
    clase_id integer NOT NULL,
    nombre character varying,
    instructor character varying,
    cupo_actual integer DEFAULT 0,
    cupo_maximo integer,
    horario time without time zone,
    dias_semana character varying,
    costo numeric,
    imagen character varying(255)
);


ALTER TABLE public.clases OWNER TO fcb6c35;

--
-- Name: clases_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.clases_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clases_id_seq OWNER TO fcb6c35;

--
-- Name: clases_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.clases_id_seq OWNED BY public.clases.clase_id;


--
-- Name: equipos; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.equipos (
    equipo_id integer NOT NULL,
    nombre character varying,
    marca character varying,
    modelo character varying,
    estatus character varying
);


ALTER TABLE public.equipos OWNER TO fcb6c35;

--
-- Name: equipos_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.equipos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.equipos_id_seq OWNER TO fcb6c35;

--
-- Name: equipos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.equipos_id_seq OWNED BY public.equipos.equipo_id;


--
-- Name: membresias; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.membresias (
    usuario_id integer NOT NULL,
    fecha_inscripcion date,
    fecha_vencimiento date,
    nombre_c character varying,
    "Precio" integer
);


ALTER TABLE public.membresias OWNER TO fcb6c35;

--
-- Name: membresias_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.membresias_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.membresias_usuario_id_seq OWNER TO fcb6c35;

--
-- Name: membresias_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.membresias_usuario_id_seq OWNED BY public.membresias.usuario_id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: fcb6c35
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre character varying(50),
    apellidos character varying(100),
    correo character varying(100),
    telefono character varying(50),
    direccion character varying(200),
    fecha_nacimiento date,
    contra character varying NOT NULL,
    foto_perfil character varying(225)
);


ALTER TABLE public.usuarios OWNER TO fcb6c35;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: fcb6c35
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO fcb6c35;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fcb6c35
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: clase_clientes id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_clientes ALTER COLUMN id SET DEFAULT nextval('public.clase_clientes_id_seq'::regclass);


--
-- Name: clase_equipos id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos ALTER COLUMN id SET DEFAULT nextval('public.clase_equipos_id_ins_seq'::regclass);


--
-- Name: clase_equipos clase_id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos ALTER COLUMN clase_id SET DEFAULT nextval('public.clase_equipos_clase_id_seq'::regclass);


--
-- Name: clase_equipos equipo_id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos ALTER COLUMN equipo_id SET DEFAULT nextval('public.clase_equipos_equipo_id_seq'::regclass);


--
-- Name: clases clase_id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clases ALTER COLUMN clase_id SET DEFAULT nextval('public.clases_id_seq'::regclass);


--
-- Name: equipos equipo_id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.equipos ALTER COLUMN equipo_id SET DEFAULT nextval('public.equipos_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Name: clase_clientes clase_clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_clientes
    ADD CONSTRAINT clase_clientes_pkey PRIMARY KEY (id);


--
-- Name: clase_equipos clase_equipos_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos
    ADD CONSTRAINT clase_equipos_pkey PRIMARY KEY (id);


--
-- Name: clases clases_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clases
    ADD CONSTRAINT clases_pkey PRIMARY KEY (clase_id);


--
-- Name: equipos equipos_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.equipos
    ADD CONSTRAINT equipos_pkey PRIMARY KEY (equipo_id);


--
-- Name: membresias membresias_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.membresias
    ADD CONSTRAINT membresias_pkey PRIMARY KEY (usuario_id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: clase_clientes clase_clientes_clase_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_clientes
    ADD CONSTRAINT clase_clientes_clase_id_fkey FOREIGN KEY (clase_id) REFERENCES public.clases(clase_id) ON DELETE CASCADE;


--
-- Name: clase_clientes clase_clientes_cliente_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_clientes
    ADD CONSTRAINT clase_clientes_cliente_id_fkey FOREIGN KEY (cliente_id) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- Name: clase_equipos clase_equipos_clase_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos
    ADD CONSTRAINT clase_equipos_clase_id_fkey FOREIGN KEY (clase_id) REFERENCES public.clases(clase_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: clase_equipos clase_equipos_equipo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.clase_equipos
    ADD CONSTRAINT clase_equipos_equipo_id_fkey FOREIGN KEY (equipo_id) REFERENCES public.equipos(equipo_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: membresias id; Type: FK CONSTRAINT; Schema: public; Owner: fcb6c35
--

ALTER TABLE ONLY public.membresias
    ADD CONSTRAINT id FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: TABLE clase_clientes; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.clase_clientes TO PUBLIC;
GRANT ALL ON TABLE public.clase_clientes TO fcb6c35_geovani;
GRANT ALL ON TABLE public.clase_clientes TO fcb6c35_gimnasio;


--
-- Name: SEQUENCE clase_clientes_id_seq; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON SEQUENCE public.clase_clientes_id_seq TO fcb6c35_geovani;


--
-- Name: TABLE clase_equipos; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.clase_equipos TO PUBLIC;
GRANT ALL ON TABLE public.clase_equipos TO fcb6c35_geovani;
GRANT ALL ON TABLE public.clase_equipos TO fcb6c35_gimnasio;


--
-- Name: SEQUENCE clase_equipos_id_ins_seq; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT SELECT,USAGE ON SEQUENCE public.clase_equipos_id_ins_seq TO fcb6c35_geovani;


--
-- Name: TABLE clases; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.clases TO fcb6c35_gimnasio;
GRANT ALL ON TABLE public.clases TO PUBLIC;
GRANT ALL ON TABLE public.clases TO fcb6c35_geovani;


--
-- Name: SEQUENCE clases_id_seq; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT SELECT,USAGE ON SEQUENCE public.clases_id_seq TO fcb6c35_geovani;


--
-- Name: TABLE equipos; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.equipos TO fcb6c35_gimnasio WITH GRANT OPTION;
GRANT ALL ON TABLE public.equipos TO fcb6c35_geovani WITH GRANT OPTION;
GRANT ALL ON TABLE public.equipos TO PUBLIC;


--
-- Name: COLUMN equipos.equipo_id; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL(equipo_id) ON TABLE public.equipos TO fcb6c35_geovani WITH GRANT OPTION;


--
-- Name: SEQUENCE equipos_id_seq; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT SELECT,USAGE ON SEQUENCE public.equipos_id_seq TO fcb6c35_geovani;


--
-- Name: TABLE membresias; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.membresias TO fcb6c35_gimnasio;


--
-- Name: TABLE usuarios; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON TABLE public.usuarios TO fcb6c35_gimnasio;
GRANT ALL ON TABLE public.usuarios TO PUBLIC;
GRANT ALL ON TABLE public.usuarios TO fcb6c35_geovani;


--
-- Name: SEQUENCE usuarios_id_seq; Type: ACL; Schema: public; Owner: fcb6c35
--

GRANT ALL ON SEQUENCE public.usuarios_id_seq TO fcb6c35_geovani;


--
-- PostgreSQL database dump complete
--

