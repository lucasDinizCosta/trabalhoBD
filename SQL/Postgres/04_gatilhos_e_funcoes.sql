
-- Procedure 1
CREATE OR REPLACE FUNCTION atualiza_funcionario_cadastrado() RETURNS trigger AS $$
DECLARE 
	bool_filial INTEGER;
BEGIN
	IF(TG_OP = 'INSERT') THEN
		UPDATE filial SET ultimo_funcionario_cadastrado=new.id_pessoa WHERE id_filial=new.id_filial;

	ELSIF(TG_OP = 'UPDATE') THEN
		IF(old.id_pessoa != new.id_pessoa) THEN
			IF(old.id_filial != new.id_filial) THEN
				UPDATE filial SET ultimo_funcionario_cadastrado=0 WHERE id_filial=old.id_filial;
				UPDATE filial SET ultimo_funcionario_cadastrado=new.id_pessoa WHERE id_filial=new.id_filial;
			ELSE
				UPDATE filial SET ultimo_funcionario_cadastrado=new.id_pessoa WHERE id_filial=new.id_filial;
			END IF;

		ELSE
			IF(old.id_filial != new.id_filial) THEN
				UPDATE filial SET ultimo_funcionario_cadastrado=0 WHERE id_filial=old.id_filial;
				UPDATE filial SET ultimo_funcionario_cadastrado=new.id_pessoa WHERE id_filial=new.id_filial;
			ELSE
				SELECT ultimo_funcionario_cadastrado INTO bool_filial FROM filial WHERE id_filial=new.id_filial;
				IF(bool_filial < 1) THEN
					UPDATE filial SET ultimo_funcionario_cadastrado=new.id_pessoa WHERE id_filial=new.id_filial;
				END IF;
			END IF;

		END IF;

	ELSE
		UPDATE filial SET ultimo_funcionario_cadastrado=0 WHERE id_filial=old.id_filial;

	END IF;

	return new;
END;
$$ LANGUAGE plpgsql;



-- Procedure 2
CREATE OR REPLACE FUNCTION atualiza_total_funcionario() RETURNS trigger AS $$
DECLARE 
	total_func INTEGER;
	total_filial INTEGER;
BEGIN
	IF(TG_OP = 'INSERT') THEN
		UPDATE filial SET total_funcionarios = total_funcionarios + 1 WHERE id_filial=new.id_filial;

	ELSIF(TG_OP = 'UPDATE') THEN
		IF(old.id_filial != new.id_filial) THEN
			UPDATE filial SET total_funcionarios = total_funcionarios - 1 WHERE id_filial=old.id_filial;
			UPDATE filial SET total_funcionarios = total_funcionarios + 1 WHERE id_filial=new.id_filial;
		ELSE
			SELECT total_funcionarios INTO total_filial FROM filial WHERE id_filial=new.id_filial;
			SELECT COUNT(*) INTO total_func FROM funcionario WHERE id_filial=new.id_filial;
			IF(total_filial < total_func) THEN
				UPDATE filial SET total_funcionarios = total_func WHERE id_filial=new.id_filial;
			END IF;
		END IF;

	ELSE
		UPDATE filial SET total_funcionarios = total_funcionarios - 1 WHERE id_filial=old.id_filial;

	END IF;

	return new;
END;
$$ LANGUAGE plpgsql;



-- Trigger 1
CREATE TRIGGER atualiza_ultimo_funcionario_cadastrado
	AFTER INSERT OR DELETE OR UPDATE ON funcionario
	FOR EACH ROW
	EXECUTE PROCEDURE atualiza_funcionario_cadastrado();



-- Trigger 2
CREATE TRIGGER atualiza_total_funcionarios
	AFTER INSERT OR DELETE OR UPDATE ON funcionario
	FOR EACH ROW
	EXECUTE PROCEDURE atualiza_total_funcionario();