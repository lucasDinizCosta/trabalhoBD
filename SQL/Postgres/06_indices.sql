
-- Índice 1

	CREATE INDEX icv_quantidade_idx ON item_combo_venda(quantidade);
	DROP INDEX icv_quantidade_idx;

-- Índice 2

	CREATE INDEX p_nome_idx ON pessoa(nome);
	DROP INDEX p_nome_idx;
