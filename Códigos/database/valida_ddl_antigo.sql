-- Possíveis Problemas:
------ Uma pessoa pode ser funcionário e cliente ao mesmo tempo



----------------------------------------------------------- Funciona -----------------------------------------------------------


INSERT INTO filial (nome, cep, cidade, numero, rua, id_filial) VALUES
('1', '11111-111', 'Rio de Janeiro', 1, 'Rua 1', 10),
('2', '22222-222', 'Rio de Janeiro', 2, 'Rua 2', 20),
('2', '22222-222', 'Rio de Janeiro', 2, 'Rua 2', 2),
('2', '22222-222', 'Rio de Janeiro', 2, 'Rua 2', 3);

UPDATE	filial SET	id_filial=1 WHERE 	id_filial=10;

DELETE FROM filial WHERE id_filial=20;




INSERT INTO pessoa (cidade, cep, numero, rua, cpf, telefone, email, nome, id_pessoa) VALUES
('Campo Grande', '11111-111', 111, 'Rua 1', '111.111.111-11', '11 1111-1111', 'teste1@teste.com', 'Daniel Carvalho', 10),
('Campo Grande', '22222-222', 222, 'Rua 2', '222.222.222-22', '22 2222-2222', 'teste2@teste.com', 'Bruna Silva',     20),
('Campo Grande', '33333-333', 333, 'Rua 3', '333.333.333-33', '33 3333-3333', 'teste3@teste.com', 'Isis Ribeiro',    30),
('Campo Grande', '44444-444', 444, 'Rua 4', '444.444.444-44', '44 4444-4444', 'teste4@teste.com', 'Daniel Carvalho', 40);

UPDATE	pessoa SET	id_pessoa=1	WHERE	id_pessoa=10;
UPDATE	pessoa SET	id_pessoa=2	WHERE	id_pessoa=20;
UPDATE	pessoa SET	id_pessoa=3	WHERE	id_pessoa=30;

DELETE FROM pessoa WHERE id_pessoa=40;




INSERT INTO cliente (credito_disponivel, id_pessoa) VALUES
('111.11', 1),
('111.11', 2);

DELETE FROM cliente WHERE id_pessoa=1;

UPDATE	cliente SET	id_pessoa=1	WHERE	id_pessoa=2;




INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Atendente', '11111.11', 'teste1', 'senha1', 0, 1, 1),
('Gerente',   '22222.22', 'teste2', 'senha2', 1, 1, 2),
('Gerente',   '33333.33', 'teste3', 'senha3', 1, 1, 3);

DELETE FROM funcionario WHERE id_pessoa=3;

UPDATE	funcionario SET	id_pessoa=3	WHERE	id_pessoa=1;
UPDATE	funcionario SET	id_pessoa=1	WHERE	id_pessoa=2;
UPDATE	funcionario SET	id_pessoa=2	WHERE	id_pessoa=3;
UPDATE	funcionario SET	id_pessoa=3	WHERE	id_pessoa=1;




INSERT INTO gerente (turno, grau, id_pessoa) VALUES
('Diurno', 'Operacional', 2),
('Diurno', 'Operacional', 3);

DELETE FROM gerente WHERE id_pessoa=2;

UPDATE	gerente SET	id_pessoa=2	WHERE	id_pessoa=3;
UPDATE	gerente SET	id_pessoa=3	WHERE	id_pessoa=2;




INSERT INTO evento (data, duracao, preco, id_filial, id_cliente, id_evento) VALUES
('1980-09-16 19:15:00', '02:00:00', '44499.00', 1, 1, 10),
('1980-09-17 19:00:00', '03:00:00',  '4782.00', 1, 1, 20),
('1980-09-18 19:00:00', '04:00:00', '14782.00', 1, 1, 30);

UPDATE	evento SET	id_evento=1	WHERE	id_evento=10;
UPDATE	evento SET	id_evento=2	WHERE	id_evento=20;
UPDATE	evento SET	id_evento=3	WHERE	id_evento=30;

DELETE FROM evento WHERE id_evento=3;




INSERT INTO convidado (nome, id_evento) VALUES
('1', 1),
('2', 1),
('1', 2),
('2', 2),
('3', 2);

DELETE FROM convidado WHERE nome='3';

UPDATE	convidado SET	nome='4'	WHERE	id_evento=2 and nome='1';
UPDATE	convidado SET	nome='5'	WHERE	id_evento=2 and nome='2';
UPDATE	convidado SET	id_evento=1	WHERE	id_evento=2;
UPDATE	convidado SET	id_evento=2	WHERE	id_evento=1 and nome='4';




INSERT INTO fornecedor (rua, cep, numero, cidade, razao_social, cnpj, id_fornecedor) VALUES
('Rua 1', '11111-111', 111, 'Campo Grande', 'Mariana Costa', '11.111.111/0001-11', 10),
('Rua 1', '11111-111', 111, 'Campo Grande', 'Mariana Costa', '11.111.111/0001-11', 20),
('Rua 1', '11111-111', 111, 'Campo Grande', 'Mariana Costa', '11.111.111/0001-11', 2),
('Rua 1', '11111-111', 111, 'Campo Grande', 'Mariana Costa', '11.111.111/0001-11', 3);

UPDATE	fornecedor SET	id_fornecedor=1	WHERE	id_fornecedor=10;

DELETE FROM fornecedor WHERE id_fornecedor=20;




INSERT INTO deposito (cidade, numero, cep, rua, id_deposito) VALUES
('Juiz de Fora', 111, '11111-111', 'Rua 1', 10),
('Juiz de Fora', 111, '11111-111', 'Rua 2', 20),
('Juiz de Fora', 111, '11111-111', 'Rua 3', 30),
('Juiz de Fora', 111, '11111-111', 'Rua 3', 3);

UPDATE	deposito SET	id_deposito=1	WHERE	id_deposito=10;
UPDATE	deposito SET	id_deposito=2	WHERE	id_deposito=20;

DELETE FROM deposito WHERE id_deposito=30;




INSERT INTO ingrediente (nome, preco_unitario, id_ingrediente) VALUES
('Farinha', '2.0', 10),
('Carne', '3.0', 20),
('Carne', '3.0', 2),
('Carne', '3.0', 3);

UPDATE	ingrediente SET	id_ingrediente=1 WHERE 	id_ingrediente=10;

DELETE FROM ingrediente WHERE id_ingrediente=20;




INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

DELETE FROM deposito_filial WHERE id_deposito=3;




INSERT INTO item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

DELETE FROM item_ingrediente_deposito WHERE id_ingrediente=3;




INSERT INTO item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

DELETE FROM item_ingrediente_fornecedor WHERE id_ingrediente=3;




INSERT INTO produto (nome, preco, id_produto) VALUES
('A', '2.0', 10),
('D', '3.0', 20),
('B', '3.0', 2),
('C', '3.0', 3);

UPDATE	produto SET	id_produto=1 WHERE 	id_produto=10;

DELETE FROM produto WHERE id_produto=20;




INSERT INTO item_produto_deposito (id_produto, id_deposito) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

DELETE FROM item_produto_deposito WHERE id_deposito=3;




INSERT INTO item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES
(10, 1, 1),
(20, 1, 2),
(30, 1, 3),
(10, 2, 1),
(20, 2, 2),
(30, 2, 3),
(10, 3, 1),
(20, 3, 2),
(30, 3, 3);

DELETE FROM item_ingrediente_produto WHERE quantidade=30;




INSERT INTO item_produto_fornecedor (id_produto, id_fornecedor) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3);

DELETE FROM item_produto_fornecedor WHERE id_fornecedor=3;




INSERT INTO combo (nome, preco, id_combo) VALUES
('A', '2.0', 10),
('D', '3.0', 20),
('B', '3.0', 2),
('C', '3.0', 3);

UPDATE	combo SET	id_combo=1 WHERE 	id_combo=10;

DELETE FROM combo WHERE id_combo=20;







----------------------------------------------------------- Não Funciona -----------------------------------------------------------


-- Chave primária (id_filial) repetida 
INSERT INTO filial (nome, cep, cidade, numero, rua, id_filial) VALUES
('2', '22222-222', 'Rio de Janeiro', 2, 'Rua 2', 1);

-- Chave primária (id_filial) está sendo usada como chave estrangeira 
UPDATE	filial 	
SET		id_filial=99	
WHERE	id_filial=1

-- Chave primária (id_filial) está sendo usada como chave estrangeira 
DELETE FROM filial WHERE id_filial=1



-- VALIDAÇÃO PARA (1, 1)




-- VALIDAÇÃO PARA (1, N)




-- VALIDAÇÃO PARA (N, N)




-- Chave primária (id_pessoa) repetida 
INSERT INTO pessoa (cidade, cep, numero, rua, cpf, telefone, email, nome, id_pessoa) VALUES
('Campo Grande', '33333-333', 333, 'Rua 3', '333.333.333-33', '33 3333-3333', 'teste3@teste.com', 'Isis Ribeiro', 2);

-- Chave primária (id_pessoa) já existe
UPDATE	pessoa
SET 	id_pessoa=2
WHERE 	id_pessoa=1

-- Chave primária (id_pessoa) está sendo usada como chave estrangeira 
UPDATE	pessoa
SET 	id_pessoa=99
WHERE 	id_pessoa=1

-- Chave primária (id_pessoa) está sendo usada como chave estrangeira 
DELETE FROM pessoa WHERE id_pessoa=1




-- Chave primária estrangeira (id_pessoa) repetida 
INSERT INTO cliente (credito_disponivel, id_pessoa) VALUES
('123.12', 1);

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira
UPDATE	cliente
SET 	id_pessoa=2
WHERE 	id_pessoa=1

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira 
DELETE FROM cliente WHERE id_pessoa=1




-- Chave primária (id_pessoa) repetida 
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Gerente',   '22222.22', 'teste2', 'senha2', 1, 1, 3);

-- Chave estrangeira (id_filial) não existe
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Gerente',   '22222.22', 'teste2', 'senha2', 1, 99, 4);

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira
UPDATE	funcionario
SET 	id_pessoa=2
WHERE 	id_pessoa=3

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira 
DELETE FROM funcionario WHERE id_pessoa=3




-- Chave primária e estrangeira (id_pessoa) não é um funcionário
INSERT INTO gerente (turno, grau, id_pessoa) VALUES
('Integral', 'Intermediária', 1);

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira 
UPDATE	gerente
SET 	id_pessoa=1
WHERE 	id_pessoa=3

-- Chave primária estrangeira (id_pessoa) está sendo usada como chave estrangeira 
-- DELETE FROM gerente WHERE id_pessoa=3 -- Gerente não está vinculado a nenhuma chave estrangeira ainda




-- Chave primária (id_evento) repetida 
INSERT INTO evento (data, duracao, preco, id_filial, id_cliente, id_evento) VALUES
('2008-03-05 13:15:00', '02:15:00', '36499.48', 1, 1, 2);

-- Chave estrangeira (id_cliente) não existe
INSERT INTO evento (data, duracao, preco, id_filial, id_cliente, id_evento) VALUES
('2008-03-05 13:15:00', '02:15:00', '36499.48', 1, 99, 3);

-- Chave estrangeira (id_filial) não existe
INSERT INTO evento (data, duracao, preco, id_filial, id_cliente, id_evento) VALUES
('1980-09-16 19:15:00', '02:00:00', '44499.37', 99, 1, 3);

-- Chave primária (id_evento) está sendo usada como chave estrangeira 
UPDATE	evento
SET 	id_evento=3
WHERE 	id_evento=2

-- Chave primária (id_evento) está sendo usada como chave estrangeira 
DELETE FROM evento WHERE id_evento=1




-- Chave primária (nome, id_evento) repetida 
INSERT INTO convidado (nome, id_evento) VALUES
('1', 1);

-- Chave primária (id_evento) não existe 
INSERT INTO convidado (nome, id_evento) VALUES
('1', 99);

-- Chave primária estrangeira (id_evento) não existe
UPDATE	convidado
SET 	id_evento=3
WHERE 	id_evento=99

-- Chave primária estrangeira (id_evento) está sendo usada como chave estrangeira 
-- DELETE FROM convidado WHERE id_evento=2 -- Convidado não está vinculado a nenhuma chave estrangeira ainda




-- Chave primária (id_fornecedor) repetida 
INSERT INTO fornecedor (rua, cep, numero, cidade, razao_social, cnpj, id_fornecedor) VALUES
('Rua 2', '22222-222', 222, 'Campo Grande', 'Mariana Costa', '22.222.222/0001-22', 1);

-- Chave primária (id_evento) está sendo usada como chave estrangeira 
-- UPDATE	fornecedor
-- SET 	id_fornecedor=2
-- WHERE 	id_fornecedor=1 -- Fornecedor não está vinculado a nenhuma chave estrangeira ainda

-- Chave primária (id_evento) está sendo usada como chave estrangeira 
-- DELETE FROM fornecedor WHERE id_fornecedor=1 -- Fornecedor não está vinculado a nenhuma chave estrangeira ainda




-- Chave primária (id_deposito) repetida 
INSERT INTO deposito (cidade, numero, cep, rua, id_deposito) VALUES
('Juiz de Fora', 222, '22222-222', 'Rua 1', 1);

-- Chave primária (id_evento) está sendo usada como chave estrangeira 
UPDATE	deposito
SET 	id_deposito=2
WHERE 	id_deposito=1

-- Chave primária (id_deposito) está sendo usada como chave estrangeira 
DELETE FROM deposito WHERE id_deposito=1




-- Chave primária (id_ingrediente) repetida 
INSERT INTO ingrediente (nome, preco_unitario, id_ingrediente) VALUES
('Carne', '3.0', 1);

-- Chave primária (id_ingrediente) está sendo usada como chave estrangeira 
UPDATE	ingrediente
SET 	id_ingrediente=2
WHERE 	id_ingrediente=1

-- Chave primária (id_ingrediente) está sendo usada como chave estrangeira 
DELETE FROM ingrediente WHERE id_ingrediente=1




-- Chave primária (id_filial, id_deposito) repetida 
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(1, 1);

-- Chave primaria estrangeira (id_filial) não existe
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(99, 1);

-- Chave primaria estrangeira (id_deposito) não existe
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(1, 99);




-- Chave primária (id_deposito, id_ingrediente) repetida 
INSERT INTO item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES
(1, 1);

-- Chave primaria estrangeira (id_deposito) não existe
INSERT INTO item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES
(99, 1);

-- Chave primaria estrangeira (id_ingrediente) não existe
INSERT INTO item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES
(1, 99);




-- Chave primária (id_fornecedor, id_ingrediente) repetida 
INSERT INTO item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES
(1, 1);

-- Chave primaria estrangeira (id_fornecedor) não existe
INSERT INTO item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES
(99, 1);

-- Chave primaria estrangeira (id_ingrediente) não existe
INSERT INTO item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES
(1, 99);




-- Chave primária (id_produto) repetida 
INSERT INTO produto (nome, preco, id_produto) VALUES
('Carne', '3.0', 1);

-- Chave primária (id_produto) está sendo usada como chave estrangeira 
UPDATE	produto
SET 	id_produto=2
WHERE 	id_produto=1

-- Chave primária (id_produto) está sendo usada como chave estrangeira 
DELETE FROM produto WHERE id_produto=1




-- Chave primária (id_produto, id_deposito) repetida 
INSERT INTO item_produto_deposito (id_produto, id_deposito) VALUES
(1, 1);

-- Chave primaria estrangeira (id_produto) não existe
INSERT INTO item_produto_deposito (id_produto, id_deposito) VALUES
(99, 1);

-- Chave primaria estrangeira (id_deposito) não existe
INSERT INTO item_produto_deposito (id_produto, id_deposito) VALUES
(1, 99);




-- Chave primária (id_ingrediente, id_produto) repetida 
INSERT INTO item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES
(50, 1, 1);

-- Chave primaria estrangeira (id_ingrediente) não existe
INSERT INTO item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES
(40, 99, 1);

-- Chave primaria estrangeira (id_produto) não existe
INSERT INTO item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES
(30, 1, 99);




-- Chave primária (id_produto, id_fornecedor) repetida 
INSERT INTO item_produto_fornecedor (id_produto, id_fornecedor) VALUES
(1, 1);

-- Chave primaria estrangeira (id_produto) não existe
INSERT INTO item_produto_fornecedor (id_produto, id_fornecedor) VALUES
(99, 1);

-- Chave primaria estrangeira (id_fornecedor) não existe
INSERT INTO item_produto_fornecedor (id_produto, id_fornecedor) VALUES
(1, 99);




-- Chave primária (id_combo) repetida 
INSERT INTO combo (nome, preco, id_combo) VALUES
('Carne', '3.0', 1);

-- Chave primária (id_combo) está sendo usada como chave estrangeira 
UPDATE	combo
SET 	id_combo=2
WHERE 	id_combo=1

-- Chave primária (id_combo) está sendo usada como chave estrangeira 
DELETE FROM combo WHERE id_combo=1





