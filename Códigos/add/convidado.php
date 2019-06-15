<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Convidado</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");

			if(isset($_GET['nome_cliente'])){
				$nome_cliente = $_GET['nome_cliente'];
			}
			else{
				$nome_cliente = '--- Último Evento ---';
			}
		?>
		<!-- /#sidebar-wrapper -->
		<div id="add">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="convidado" name="convidado" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Convidado</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nome Completo</label>
								<input type="text" name="nome_convidado" id="nome_convidado" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Evento do Cliente</label>
								<select id="nome_cliente" name="nome_cliente" class="form-control">
									<?php
										$sql = "SELECT DISTINCT p.nome 
												FROM evento e
												INNER JOIN cliente c
													on e.id_cliente=c.id_pessoa
												INNER JOIN pessoa p
													on c.id_pessoa=p.id_pessoa
												ORDER BY p.nome";
										$clientes = mysqli_query($conexao, $sql);

										if($nome_cliente == '--- Último Evento ---'){
											echo '<option selected>--- Último Evento ---</option>';
										}
										else{
											echo '<option>--- Último Evento ---</option>';
										}
										

										foreach ($clientes as $cliente){
											if($nome_cliente == $cliente['nome']){
												echo '<option selected>' . $cliente['nome'] . '</option>';
											}
											else{
												echo '<option>' . $cliente['nome'] . '</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<a href="../evento.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
							<button type="submit" class="btn btn-primary" value="Salvar" name="submit">Adicionar</button>
							<a href="../evento.php"><span class="btn btn-success" value="Cancelar">Finalizar</span></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /#wrapper -->

	<?php
		if(isset($_POST['submit'])){
			$nome_convidado = $_POST['nome_convidado'];
			$nome_cliente 	= $_POST['nome_cliente'];

			if($nome_cliente == '--- Último Evento ---'){
				// Retorna o próximo id do AUTO_INCREMENTE da tabela evento
				$sql = "SELECT AUTO_INCREMENT
						FROM information_schema.TABLES
						WHERE TABLE_SCHEMA = 'lanchonete'
						AND TABLE_NAME = 'evento'";
				$last_id_evento = mysqli_fetch_array( mysqli_query($conexao, $sql) )['AUTO_INCREMENT'] - 1;

				$sql = "INSERT INTO convidado (nome, id_evento) 
						VALUES ('$nome_convidado', '$last_id_evento')";
			}
			else{
				$sql = "SELECT id_pessoa
						FROM pessoa
						WHERE nome='$nome_cliente'
						LIMIT 1";
				$id_cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) )['id_pessoa'];

				$sql = "SELECT id_evento
						FROM evento
						WHERE id_cliente='$id_cliente'
						ORDER BY data DESC
						LIMIT 1";
				$id_evento = mysqli_fetch_array( mysqli_query($conexao, $sql) )['id_evento'];

				$sql = "INSERT INTO convidado (nome, id_evento) 
						VALUES ('$nome_convidado', '$id_evento')";
			}

			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			$str = "Location: convidado.php?nome_cliente=".$nome_cliente;

			header($str); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>