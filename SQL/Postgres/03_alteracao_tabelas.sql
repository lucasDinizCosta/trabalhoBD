
-- Executar apenas uma vez
	ALTER TABLE filial ADD COLUMN ultimo_funcionario_cadastrado INTEGER NOT NULL DEFAULT 0;

	ALTER TABLE filial ADD COLUMN total_funcionarios INTEGER NOT NULL DEFAULT 0;



-- Ajusta o ID AUTO INCREMENT para o SERIAL [SE NECESSARIO]
	SET session_replication_role = 'replica';
	UPDATE funcionario SET id_filial = id_filial - 85;
	SET session_replication_role = 'origin';