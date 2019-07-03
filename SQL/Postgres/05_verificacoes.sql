
-- Verificação 1
UPDATE funcionario SET id_pessoa=id_pessoa;
SELECT * FROM filial ORDER BY ultimo_funcionario_cadastrado DESC;


INSERT INTO pessoa (cidade, cep, numero, rua, cpf, telefone, email, nome, id_pessoa) VALUES
('Campo Grande', '11111-111', 111, 'Rua 1', '111.111.111-11', '11 1111-1111', 'teste1@teste.com', 'Daniel Carvalho', 999);
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Atendente', '11111.11', 'teste1', 'senha1', false, 1, 999);
SELECT * FROM filial ORDER BY total_funcionarios DESC;


DELETE FROM funcionario WHERE id_pessoa=999;
SELECT * FROM filial ORDER BY total_funcionarios DESC;



-- Verificação 2
UPDATE funcionario SET id_pessoa=id_pessoa;
SELECT * FROM filial ORDER BY total_funcionarios DESC;


INSERT INTO pessoa (cidade, cep, numero, rua, cpf, telefone, email, nome, id_pessoa) VALUES
('Campo Grande', '11111-111', 111, 'Rua 1', '111.111.111-11', '11 1111-1111', 'teste1@teste.com', 'Daniel Carvalho', 998);
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Atendente', '11111.11', 'teste1', 'senha1', false, 1, 998);

INSERT INTO pessoa (cidade, cep, numero, rua, cpf, telefone, email, nome, id_pessoa) VALUES
('Campo Grande', '11111-111', 111, 'Rua 1', '111.111.111-11', '11 1111-1111', 'teste1@teste.com', 'Daniel Carvalho', 997);
INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES
('Atendente', '11111.11', 'teste1', 'senha1', false, 1, 997);
SELECT * FROM filial ORDER BY total_funcionarios DESC;


DELETE FROM funcionario WHERE id_pessoa=998;
DELETE FROM funcionario WHERE id_pessoa=997;
SELECT * FROM filial ORDER BY total_funcionarios DESC;