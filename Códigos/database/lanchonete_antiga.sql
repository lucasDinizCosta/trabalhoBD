
DROP TABLE IF EXISTS `item_ingrediente_fornecedor`;
DROP TABLE IF EXISTS `deposito_filial`;
DROP TABLE IF EXISTS `item_ingrediente_deposito`;
DROP TABLE IF EXISTS `item_produto_deposito`;
DROP TABLE IF EXISTS `item_produto_combo`;
DROP TABLE IF EXISTS `item_combo_venda`;
DROP TABLE IF EXISTS `item_produto_venda`;
DROP TABLE IF EXISTS `item_ingrediente_produto`;
DROP TABLE IF EXISTS `item_produto_fornecedor`;
DROP TABLE IF EXISTS `entrega`;
DROP TABLE IF EXISTS `convidado`;
DROP TABLE IF EXISTS `evento`;
DROP TABLE IF EXISTS `venda`;
DROP TABLE IF EXISTS `ingrediente`;
DROP TABLE IF EXISTS `produto`;
DROP TABLE IF EXISTS `combo`;
DROP TABLE IF EXISTS `fornecedor`;
DROP TABLE IF EXISTS `gerente`;
DROP TABLE IF EXISTS `funcionario`;
DROP TABLE IF EXISTS `cliente`;
DROP TABLE IF EXISTS `pessoa`;
DROP TABLE IF EXISTS `deposito`;
DROP TABLE IF EXISTS `filial`;

CREATE TABLE filial (
	nome 		VARCHAR(200)	NOT NULL,
	cep 		VARCHAR(9)		NOT NULL,
	cidade 		VARCHAR(200)	NOT NULL,
	numero 		INTEGER			NOT NULL,
	rua 		VARCHAR(200)	NOT NULL,
	id_filial 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE deposito (
	cidade 			VARCHAR(200),
	numero 			INTEGER,
	cep 			CHAR(9),
	rua 			VARCHAR(200),
	id_deposito 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
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
	id_pessoa 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE cliente (
	credito_disponivel 	NUMERIC(10,2),
	id_pessoa 			INTEGER PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa)
);

CREATE TABLE funcionario (
	cargo 		VARCHAR(200),
	salario 	NUMERIC(10,2),
	login 		VARCHAR(200),
	senha 		VARCHAR(200),
	status 		BOOLEAN,
	id_filial 	INTEGER,
	id_pessoa 	INTEGER	PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa (id_pessoa),
	FOREIGN KEY(id_filial) REFERENCES filial (id_filial)
);

CREATE TABLE gerente (
	turno 		VARCHAR(200),
	grau 		VARCHAR(200),
	id_pessoa 	INTEGER PRIMARY KEY,
	FOREIGN KEY(id_pessoa) REFERENCES funcionario (id_pessoa)
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

CREATE TABLE combo (
	preco 		NUMERIC(10,2),
	nome 		VARCHAR(200),
	id_combo 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE produto (
	nome 		VARCHAR(200),
	preco 		NUMERIC(10,2),
	id_produto 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE ingrediente (
	nome 			VARCHAR(200),
	preco_unitario 	NUMERIC(10,2),
	id_ingrediente 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE venda (
	data 		DATETIME,
	nota_fiscal VARCHAR(200),
	id_venda 	INTEGER PRIMARY KEY 	AUTO_INCREMENT
);

CREATE TABLE evento (
	data 		DATETIME,
	duracao 	TIME,
	preco 		NUMERIC(10,2),
	id_filial 	INTEGER,
	id_cliente	INTEGER,
	id_evento 	INTEGER PRIMARY KEY 	AUTO_INCREMENT,
	FOREIGN KEY(id_cliente) REFERENCES cliente (id_pessoa),
	FOREIGN KEY(id_filial) 	REFERENCES filial  (id_filial)
);

CREATE TABLE convidado (
	convidado VARCHAR(200),
	id_evento INTEGER PRIMARY KEY,
	FOREIGN KEY(id_evento) REFERENCES evento (id_evento)
);

CREATE TABLE entrega (
	rua				VARCHAR(200),
	cep 			CHAR(9),
	numero 			INTEGER,
	cidade 			VARCHAR(200),
	frete 			NUMERIC(10,2),
	nome_remetente 	VARCHAR(200),
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

INSERT INTO `filial` (`nome`, `cep`, `cidade`, `numero`, `rua`, `id_filial`) VALUES
('A', '11111-111', 'Juiz de Fora', 120, 'Rua A', 1),
('B', '11111-000', 'Juiz de Fora', 100, 'Rua B', 2);