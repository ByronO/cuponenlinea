CREATE DATABASE bdcuponenlinea;
USE bdcuponenlinea;

CREATE TABLE tbempresaturistica (
	empresaturisticaid int PRIMARY KEY NOT NULL,
    empresaturisticacodigo VARCHAR(100) UNIQUE NOT NULL,
    empresaturisticanombre VARCHAR(100),
    empresaturisticadescripcion VARCHAR(255),
	empresaturisticaubicacion VARCHAR(255),
    empresaturisticaestado int,
    empresaturisticatipo VARCHAR(100),
    empresaturisticaemail VARCHAR(50),
    empresaturisticatelefono VARCHAR(10)
);
CREATE TABLE tbusuario(
usuarioid int,
usuarionombre VARCHAR(100),
usuariocontrasenna VARCHAR(50)
);
INSERT INTO tbusuario VALUE (1,"admin","admin");
INSERT INTO tbempresaturistica VALUE(0,0,"default","default","default",0,"default","default","default");