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
