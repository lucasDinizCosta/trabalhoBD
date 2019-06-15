DROP DATABASE IF EXISTS lanchonete;
CREATE DATABASE lanchonete;

CREATE TABLE filial (
	nome 		VARCHAR(200)	NOT NULL,
	cep 		VARCHAR(9)		NOT NULL,
	cidade 		VARCHAR(200)	NOT NULL,
	numero 		INTEGER			NOT NULL,
	rua 		VARCHAR(200)	NOT NULL,
	id_filial 	INTEGER			PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE pessoa (
	cidade 		VARCHAR(200),
	cep 		CHAR(9),
	numero 		INTEGER,
	rua 		VARCHAR(200),
	cpf 		VARCHAR(14),
	telefone 	VARCHAR(12),
	email 		VARCHAR(200),
	nome 		VARCHAR(200),
	id_pessoa 	INTEGER			PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE cliente (
	credito_disponivel 	NUMERIC(10,2),
	id_pessoa 			INTEGER	 		PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa)
);

CREATE TABLE funcionario (
	cargo 		VARCHAR(200),
	salario 	NUMERIC(10,2),
	login 		VARCHAR(200),
	senha 		VARCHAR(200),
	status 		BOOLEAN,
	id_filial 	INTEGER,
	id_pessoa 	INTEGER	 		PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa),
	FOREIGN KEY(id_filial) REFERENCES filial (id_filial)
);

CREATE TABLE gerente (
	turno 		VARCHAR(200),
	grau 		BOOLEAN,
	id_pessoa 	INTEGER 		PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES funcionario (id_pessoa)
);