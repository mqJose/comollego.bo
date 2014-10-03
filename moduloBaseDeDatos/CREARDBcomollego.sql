CREATE DATABASE comollego;
USE comollego;

CREATE TABLE sindicato(
	idsindicato integer NOT NULL AUTO_INCREMENT,
	nombre varchar(50),
	tipo varchar(20),
	direccion varchar(50),
	telefono varchar(50),
	PRIMARY KEY (idsindicato)
);

CREATE TABLE linea(
	idlinea integer NOT NULL AUTO_INCREMENT,
	nombre varchar(10),
	idsindicato integer NOT NULL,
	PRIMARY KEY (idlinea),
	FOREIGN KEY (idsindicato) REFERENCES sindicato(idsindicato)
);

CREATE TABLE parada(
	idparada integer NOT NULL AUTO_INCREMENT,
	referencia varchar (200),
	latitud varchar(30),
	longitud varchar(30),
	PRIMARY KEY (idparada)
);

CREATE TABLE tiene(
	orden integer NOT NULL, 
	idlinea integer NOT NULL,
	idparada varchar(10) NOT NULL,
	FOREIGN KEY (idlinea) REFERENCES linea (idlinea),
	FOREIGN KEY (idparada) REFERENCES parada (idparada)
);

CREATE TABLE comentario_parada(
	idcomentario integer NOT NULL AUTO_INCREMENT,
	remitente varchar(20),
	email varchar(50),
	contenido varchar(200),
	fecha datetime,
	idparada varchar(50),
	created_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	updated_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY(idcomentario),
	FOREIGN KEY(idparada) REFERENCES parada(idparada)
);

CREATE TABLE denuncia_linea(
	iddenuncia integer NOT NULL AUTO_INCREMENT,
	denunciante varchar(20),
	email varchar(50),
	contenido varchar(200),
	placa_automovil varchar(10),
	fecha datetime,
	created_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	updated_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	idlinea varchar(10),
	PRIMARY KEY(iddenuncia),
	FOREIGN KEY(idlinea) REFERENCES linea(idlinea)
);
