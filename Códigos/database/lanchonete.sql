DROP TABLE IF EXISTS `filial`;
DROP TABLE IF EXISTS `deposito`;
DROP TABLE IF EXISTS `pessoa`;
DROP TABLE IF EXISTS `cliente`;
DROP TABLE IF EXISTS `funcionario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `usuario`;

CREATE TABLE filial (
	nome 		VARCHAR,
	cep 		VARCHAR,
	cidade 		VARCHAR,
	numero 		INTEGER,
	rua 		VARCHAR,
	id_filial 	INTEGER PRIMARY KEY
);

CREATE TABLE deposito (
	cidade 			VARCHAR,
	numero 			INTEGER,
	cep 			VARCHAR,
	rua 			VARCHAR,
	id_deposito 	INTEGER PRIMARY KEY
);

CREATE TABLE pessoa (
	cidade 		VARCHAR,
	cep 		VARCHAR,
	numero 		INTEGER,
	rua 		VARCHAR,
	cpf 		VARCHAR,
	telefone 	VARCHAR,
	email 		VARCHAR,
	nome 		VARCHAR,
	id_pessoa 	INTEGER PRIMARY KEY
);

CREATE TABLE cliente (
	credito_disponivel 	NUMERIC(10,2),
	id_pessoa 			INTEGER PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa)
);

CREATE TABLE funcionario (
	cargo 		VARCHAR,
	salario 	NUMERIC(10,2),
	login 		VARCHAR,
	senha 		VARCHAR,
	status 		BOOLEAN,
	id_filial 	INTEGER,
	id_pessoa 	INTEGER	PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa),
	FOREIGN KEY(id_filial) REFERENCES filial (id_filial)
);

CREATE TABLE gerente (
	turno 		VARCHAR,
	grau 		VARCHAR,
	id_pessoa 	INTEGER PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES funcionario (id_pessoa)
);

CREATE TABLE fornecedor (
	rua 			VARCHAR,
	cep 			VARCHAR,
	numero 			INTEGER,
	cidade 			VARCHAR,
	razao_social 	VARCHAR,
	cnpj 			VARCHAR,
	id_fornecedor 	INTEGER PRIMARY KEY
);

CREATE TABLE combo (
	preco 		NUMERIC(10,2),
	nome 		VARCHAR,
	id_combo 	INTEGER PRIMARY KEY
);

CREATE TABLE produto (
	nome 		VARCHAR,
	preco 		NUMERIC(10,2),
	id_produto 	INTEGER PRIMARY KEY
);

CREATE TABLE ingrediente (
	nome 			VARCHAR,
	preco_unitario 	NUMERIC(10,2),
	id_ingrediente 	INTEGER PRIMARY KEY
);

CREATE TABLE venda (
	data 		DATETIME,
	nota_fiscal VARCHAR,
	id_venda 	INTEGER PRIMARY KEY
);

CREATE TABLE evento (
	data 		DATETIME,
	duracao 	TIME,
	preco 		INTEGER,
	id_filial 	INTEGER,
	id_cliente	INTEGER,
	id_evento 	INTEGER PRIMARY KEY,
	FOREIGN KEY(id_cliente) REFERENCES cliente (id_cliente),
	FOREIGN KEY(id_filial) 	REFERENCES filial  (id_filial)
);

CREATE TABLE convidado (
	convidado VARCHAR,
	id_evento INTEGER PRIMARY KEY,
	FOREIGN KEY(id_evento) REFERENCES evento (id_evento)
);

CREATE TABLE entrega (
	rua				VARCHAR,
	cep 			VARCHAR,
	numero 			INTEGER,
	cidade 			VARCHAR,
	frete 			NUMERIC(10,2),
	nome_remetente 	VARCHAR,
	id_venda 		INTEGER PRIMARY KEY,
	FOREIGN KEY(id_venda) REFERENCES venda (id_venda)
);

CREATE TABLE item_produto_fornecedor (
	id_fornecedor 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_fornecedor, id_produto),
	FOREIGN KEY(id_fornecedor) 	REFERENCES fornecedor (id_fornecedor),
	FOREIGN KEY(id_produto) 	REFERENCES produto 	  (id_produto)
);

CREATE TABLE item_ingrediente_produto (
	quantidade 		INTEGER,
	id_ingrediente 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_ingrediente, id_produto),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente),
	FOREIGN KEY(id_produto) 	REFERENCES produto 	   (id_produto)
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

CREATE TABLE item_produto_combo (
	quantidade 	INTEGER,
	id_produto 	INTEGER,
	id_combo 	INTEGER,
	PRIMARY KEY(id_produto, id_combo),
	FOREIGN KEY(id_produto) REFERENCES produto (id_produto),
	FOREIGN KEY(id_combo)	REFERENCES combo   (id_combo)
);

CREATE TABLE item_produto_deposito (
	id_deposito 	INTEGER,
	id_produto 		INTEGER,
	PRIMARY KEY(id_deposito, id_produto),
	FOREIGN KEY(id_deposito) REFERENCES deposito (id_deposito),
	FOREIGN KEY(id_produto)  REFERENCES produto  (id_produto)
);

CREATE TABLE item_ingrediente_deposito (
	id_deposito 	INTEGER,
	id_ingrediente 	INTEGER,
	PRIMARY KEY(id_deposito, id_ingrediente),
	FOREIGN KEY(id_deposito) 	REFERENCES deposito    (id_deposito),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente)
);

CREATE TABLE deposito_filial (
	id_filial 	INTEGER,
	id_deposito INTEGER,
	PRIMARY KEY(id_filial, id_deposito),
	FOREIGN KEY(id_filial) 	 REFERENCES filial   (id_filial),
	FOREIGN KEY(id_deposito) REFERENCES deposito (id_deposito)
);

CREATE TABLE item_ingrediente_fornecedor (
	id_fornecedor 	INTEGER,
	id_ingrediente 	INTEGER,
	PRIMARY KEY(id_fornecedor, id_ingrediente),
	FOREIGN KEY(id_fornecedor) 	REFERENCES fornecedor  (id_fornecedor),
	FOREIGN KEY(id_ingrediente) REFERENCES ingrediente (id_ingrediente)
);
