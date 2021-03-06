CREATE DATABASE bdcuponenlinea;
use bdcuponenlinea;

CREATE TABLE tbempresacategoria (
	empresacategoriaid int PRIMARY KEY NOT NULL,
    empresacategoriacodigo VARCHAR(100) UNIQUE NOT NULL,
    empresacategoriaestado int,
    empresacategorianombre VARCHAR(100),
    empresacategoriaacronimo VARCHAR(15)
);

CREATE TABLE tbempresaturistica (
	empresaid int PRIMARY KEY NOT NULL,
    empresacodigo VARCHAR(100) UNIQUE NOT NULL,
    empresanombre VARCHAR(100),
	empresaubicacion VARCHAR(255),
    empresaestado int,
    empresacategoria VARCHAR(100),
    empresacedulajuridica  VARCHAR(100),
    empresasitioweb  VARCHAR(200)
);

create table tbcliente(
  clienteid int PRIMARY KEY NOT NULL,
  clientecorreo VARCHAR(100) UNIQUE NOT NULL,
  clientecontrasenna VARCHAR(100),
  clienteestado int,
  clientefechainscripcion datetime,
  clientefechadedesafiliacion  datetime
);

create table tbclientedatobancario(
  clientedatobancarioid int PRIMARY KEY NOT NULL,
  clientedatobancariobanco varchar(150),
  clientedatobancarionumerotarjeta varchar(150),
  clientedatobancarioestado int,
  clientedatobancarioclienteid int,
  clientedatobancariofechainscripcion datetime
);

create table tbclientecontacto (
  clientecontactoid int PRIMARY KEY NOT NULL,
  clientecontactotelefono1 varchar(20),
  clientecontactotelefono2 varchar(20),
  clientecontactocorreo varchar(200),
  clientecontactofax varchar(100),
  clientecontactoclienteid int,
  clientecontactoestado int
);

CREATE TABLE tbusuario(
  usuarioid int,
  usuariocorreo VARCHAR(150),
  usuariocontrasenna VARCHAR(50)
);
CREATE TABLE tbempresacontacto(
  empesacontactoid int PRIMARY KEY NOT NULL,
  empresacontactocriterio VARCHAR(500),
  empesacontactovalor VARCHAR(500),
  empresaid int
);
CREATE TABLE tbservicio(
	servicioid int PRIMARY KEY,
  serviciocriterio varchar(500),
  serviciovalor varchar(500),
  empresaid int
);

CREATE TABLE tbservicioimagen(
    id int PRIMARY KEY,
    servicioid int,
    serviciovalor varchar(50),
    ruta varchar(150)
);

CREATE TABLE tbcupon(
	cuponid int PRIMARY KEY,
    cuponnombre varchar(50),
    empresaid int,
    serviciovalor varchar(250),
    cuponrutaimagen varchar(150),
    cupondescripcion varchar(500),
    cupondetallesadicionales varchar(500),
    cuponrestricciones varchar(500),
    cuponfechainicio date,
    cuponfechafin date,
    cuponprecio int,
    cuponestado int
);

CREATE TABLE tbempresaubicacion(
	id int PRIMARY KEY,
    provincia VARCHAR(200),
    canton VARCHAR(200),
    distrito VARCHAR(200),
    otrassenas VARCHAR(300),
    empresaid int
);

CREATE TABLE tbclientedireccion (
	id INT PRIMARY KEY,
    clienteubicacion VARCHAR(500),
    clienteid INT
);

