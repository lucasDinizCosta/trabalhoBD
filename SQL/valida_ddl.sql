-- VALIDAÇÃO PARA (1, N)

-- Chave primária (id_filial) repetida 
INSERT INTO filial (nome, cep, cidade, numero, rua, id_filial) VALUES
('2', '22222-222', 'Rio de Janeiro', 2, 'Rua 2', 1);

-- Chave estrangeira (id_filial) não existe
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Gerente',   '22222.22', 'teste2', 'senha2', 1, 99, 4);

-- Chave primária e estrangeira (id_pessoa) não é um funcionário
INSERT INTO gerente (turno, grau, id_pessoa) VALUES
('Integral', 'Intermediária', 1);

-- Chave primária (id_filial) está sendo usada como chave estrangeira 
UPDATE	filial
SET		id_filial=99
WHERE	id_filial=1

-- Chave estrangeira (id_pessoa) não existe
UPDATE	funcionario
SET		id_pessoa=99
WHERE	id_pessoa=1

-- Chave primária e estrangeira (id_pessoa) não é um funcionário
UPDATE	gerente
SET		id_pessoa=1
WHERE	id_pessoa=3

-- Chave primária (id_filial) está sendo usada como chave estrangeira 
DELETE FROM filial WHERE id_filial=1

-- Chave estrangeira (id_pessoa) não existe
DELETE FROM funcionario WHERE id_pessoa=99




-- VALIDAÇÃO PARA (N, N)

-- Chave primária (id_filial, id_deposito) repetida 
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(1, 1);

-- Chave primaria estrangeira (id_filial) não existe
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(99, 1);

-- Chave primaria estrangeira (id_deposito) não existe
INSERT INTO deposito_filial (id_filial, id_deposito) VALUES
(1, 99);

-- Chave estrangeira (id_filial) não existe
UPDATE	deposito_filial
SET		id_filial=99
WHERE	id_filial=1

-- Chave estrangeira (id_deposito) não existe
UPDATE	deposito_filial
SET		id_deposito=99
WHERE	id_deposito=1

-- Chave estrangeira (id_filial) repetida
UPDATE	deposito_filial
SET		id_filial=2
WHERE	id_filial=1

-- Chave estrangeira (id_deposito) repetida
UPDATE	deposito_filial
SET		id_deposito=2
WHERE	id_deposito=1

-- O Comando DELETE funciona pois a chave primária da tabela deposito_filial 
--		não está usada como chave estrangeira em outra tabela


