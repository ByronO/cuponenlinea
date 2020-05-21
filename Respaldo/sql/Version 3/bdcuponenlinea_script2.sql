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
empresacontactoid int PRIMARY KEY NOT NULL,
empresacontactocriterio VARCHAR(500),
empresacontactovalor VARCHAR(500),
empresafechainscripcion DATE,
empresafehcadesafiliacion DATE,
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
CREATE TABLE tbempresaubicacion(
	id int PRIMARY KEY,
    provincia VARCHAR(200),
    canton VARCHAR(200),
    distrito VARCHAR(200),
    otrassenas VARCHAR(300),
    empresaid int
);

CREATE TABLE tbempresacontacto(
empresacontactoid int PRIMARY KEY NOT NULL,
empresacontactocriterio VARCHAR(500),
empresacontactovalor VARCHAR(500),
empresafechainscripcion DATE,
empresafehcadesafiliacion DATE,
empresaid int
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

SELECT MAX(empresacontactoid) AS id FROM tbempresacontacto;
select * from tbempresaturistica;
SELECT MAX(empesacontactoid) AS id FROM tbempresacontacto;
select * from tbempresacontacto;
delete from tbempresaturistica where empresaid = 6;
INSERT INTO tbempresacontacto (empresacontactoid, empresacontactocriterio, empresacontactovalor,empresafechainscripcion, empresaid) 
                                        VALUES(2,"telefono","88888888",now(),4);
                                        SELECT empresacontactocriterio, empresacontactovalor FROM  tbempresacontacto WHERE empresaid=4;
