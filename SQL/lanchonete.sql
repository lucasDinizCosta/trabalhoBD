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
	grau 		VARCHAR(200),
	id_pessoa 	INTEGER 		PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES funcionario (id_pessoa)
);

CREATE TABLE evento (
	data 		DATETIME,
	duracao 	TIME,
	preco 		NUMERIC(10,2),
	id_filial 	INTEGER,
	id_cliente	INTEGER,
	id_evento 	INTEGER 	PRIMARY KEY 	AUTO_INCREMENT,
	FOREIGN KEY(id_cliente) REFERENCES cliente (id_pessoa),
	FOREIGN KEY(id_filial) 	REFERENCES filial  (id_filial)
);

CREATE TABLE convidado (
	nome 		VARCHAR(200),
	id_evento 	INTEGER,
	PRIMARY KEY(nome, id_evento),
	FOREIGN KEY(id_evento) REFERENCES evento (id_evento)
);

CREATE TABLE fornecedor (
	rua 			VARCHAR(200),
	cep 			CHAR(9),
	numero 			INTEGER,
	cidade 			VARCHAR(200),
	razao_social 	VARCHAR(200),
	cnpj 			VARCHAR(18),
	id_fornecedor 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE deposito (
	cidade 			VARCHAR(200),
	numero 			INTEGER,
	cep 			CHAR(9),
	rua 			VARCHAR(200),
	id_deposito 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE ingrediente (
	nome 			VARCHAR(200),
	preco_unitario 	NUMERIC(10,2),
	id_ingrediente 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE produto (
	nome 		VARCHAR(200),
	preco 		NUMERIC(10,2),
	id_produto 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE combo (
	preco 		NUMERIC(10,2),
	nome 		VARCHAR(200),
	id_combo 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE deposito_filial (
	id_filial 	INTEGER,
	id_deposito INTEGER,
	PRIMARY KEY(id_filial, id_deposito),
	FOREIGN KEY(id_filial) 	 REFERENCES filial   (id_filial),
	FOREIGN KEY(id_deposito) REFERENCES deposito (id_deposito)
);

CREATE TABLE item_ingrediente_deposito (
	id_deposito 	INTEGER,
	id_ingrediente 	INTEGER,
	PRIMARY KEY(id_deposito, id_ingrediente),
	FOREIGN KEY(id_deposito) 	REFERENCES deposito    (id_deposito),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente)
);

CREATE TABLE item_ingrediente_fornecedor (
	id_fornecedor 	INTEGER,
	id_ingrediente 	INTEGER,
	PRIMARY KEY(id_fornecedor, id_ingrediente),
	FOREIGN KEY(id_fornecedor) 	REFERENCES fornecedor  (id_fornecedor),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente)
);

CREATE TABLE item_produto_deposito (
	id_deposito 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_deposito, id_produto),
	FOREIGN KEY(id_deposito) REFERENCES deposito (id_deposito),
	FOREIGN KEY(id_produto)  REFERENCES produto  (id_produto)
);

CREATE TABLE item_ingrediente_produto (
	quantidade 		INTEGER,
	id_ingrediente 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_ingrediente, id_produto),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente),
	FOREIGN KEY(id_produto) 	REFERENCES produto 	   (id_produto)
);

CREATE TABLE item_produto_fornecedor (
	id_fornecedor 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_fornecedor, id_produto),
	FOREIGN KEY(id_fornecedor) 	REFERENCES fornecedor (id_fornecedor),
	FOREIGN KEY(id_produto) 	REFERENCES produto 	  (id_produto)
);

CREATE TABLE item_produto_combo (
	quantidade 	INTEGER,
	id_produto 	INTEGER,
	id_combo 	INTEGER,
	PRIMARY KEY(id_produto, id_combo),
	FOREIGN KEY(id_produto) REFERENCES produto (id_produto),
	FOREIGN KEY(id_combo)	REFERENCES combo   (id_combo)
);

CREATE TABLE venda (
	data 			DATETIME,
	nota_fiscal 	VARCHAR(200),
	id_cliente		INTEGER,
	id_funcionario 	INTEGER,
	id_venda 		INTEGER 	PRIMARY KEY 	AUTO_INCREMENT,
	FOREIGN KEY(id_cliente) 	REFERENCES 		cliente 	(id_pessoa),
	FOREIGN KEY(id_funcionario)	REFERENCES 		funcionario (id_pessoa)
);

CREATE TABLE entrega (
	rua					VARCHAR(200),
	cep 				VARCHAR(9),
	numero 				INTEGER,
	cidade 				VARCHAR(200),
	frete 				NUMERIC(10,2),
	nome_destinatario	VARCHAR(200),
	id_venda 			INTEGER 		PRIMARY KEY,
	FOREIGN KEY(id_venda) REFERENCES venda (id_venda)
);

CREATE TABLE item_produto_venda (
	preco_unitario 	NUMERIC(10,2),
	quantidade 		INTEGER,
	id_produto 		INTEGER,
	id_venda 		INTEGER,
	PRIMARY KEY(id_produto, id_venda),
	FOREIGN KEY(id_produto) REFERENCES produto (id_produto),
	FOREIGN KEY(id_venda) 	REFERENCES venda   (id_venda)
);

CREATE TABLE item_combo_venda (
	quantidade 		INTEGER,
	preco_unitario 	NUMERIC(10,2),
	id_combo 		INTEGER,
	id_venda 		INTEGER,
	PRIMARY KEY(id_combo, id_venda),
	FOREIGN KEY(id_combo) REFERENCES combo (id_combo),
	FOREIGN KEY(id_venda) REFERENCES venda (id_venda)
);