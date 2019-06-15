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

			$id_evento = $_GET['id'];
			$sql = "SELECT 	c.nome
					FROM convidado c
					WHERE c.id_evento='$id_evento'";
			$convidados = mysqli_query($conexao, $sql);

			$sql = "SELECT 	p.nome as 'nome_cliente'
					FROM evento e
					INNER JOIN pessoa p
						on e.id_cliente=p.id_pessoa
					WHERE e.id_evento='$id_evento'";
			$nome_cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) )['nome_cliente'];
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
								<label>Convidados</label>
								<select id="convidado_lista" name="convidado_lista" class="form-control">
									<?php
										foreach ($convidados as $convidado){
											echo '<option>' . $convidado['nome'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Nome Completo</label>
								<input type="text" name="nome_convidado" id="nome_convidado" class="form-control">
							</div>
							<div class="form-group">
								<label>Evento do Cliente</label>
								<select id="nome_cliente" name="nome_cliente" class="form-control" disabled>
									<?php
										$sql = "SELECT DISTINCT p.nome 
												FROM evento e
												INNER JOIN cliente c
													on e.id_cliente=c.id_pessoa
												INNER JOIN pessoa p
													on c.id_pessoa=p.id_pessoa
												ORDER BY p.nome";
										$clientes = mysqli_query($conexao, $sql);

										foreach ($clientes as $cliente){
											if($nome_cliente == $cliente['nome']){
												echo '<option selected>' . $cliente['nome'] . '</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger" value="Deletar_Todos" name="submit">Deletar Todos</button>
							<button type="submit" class="btn btn-warning" value="Deletar" name="submit">Deletar</button>
							<button type="submit" class="btn btn-primary" value="Adicionar" name="submit">Adicionar</button>
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
			if($_POST['submit'] == 'Adicionar'){
				$nome_convidado = $_POST['nome_convidado'];

				$sql = "INSERT INTO convidado (nome, id_evento) 
						VALUES ('$nome_convidado', '$id_evento')";
			}

			elseif($_POST['submit'] == 'Deletar'){
				$nome_convidado = $_POST['convidado_lista'];

				$sql = "DELETE FROM convidado
						WHERE id_evento='$id_evento' and nome='$nome_convidado'";
			}

			elseif($_POST['submit'] == 'Deletar_Todos'){
				$sql = "DELETE FROM convidado
						WHERE id_evento='$id_evento'";
			}

			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			$str = "Location: convidado.php?id=".$id_evento;

			header($str); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>