<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Evento</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");
		?>
		<!-- /#sidebar-wrapper -->
		<div id="add">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="evento" name="evento" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Evento</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Cliente</label>
								<select id="nome_cliente" name="nome_cliente" class="form-control">
									<?php
										$sql = "SELECT DISTINCT p.nome 
												FROM cliente c
												INNER JOIN pessoa p
													on c.id_pessoa=p.id_pessoa
												ORDER BY p.nome";
										$clientes = mysqli_query($conexao, $sql);

										foreach ($clientes as $cliente){
											echo '<option>' . $cliente['nome'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Data</label>
								<input type="datetime-local" name="data" id="data" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Duração</label>
								<input type="time" name="duracao" id="duracao" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Preço</label>
								<input type="text" name="preco" id="preco" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required></textarea>
							</div>
							<div class="form-group">
								<label>Filial</label>
								<select id="nome_filial" name="nome_filial" class="form-control">
									<?php
										$sql = "SELECT DISTINCT nome 
												FROM filial 
												ORDER BY nome";
										$filiais = mysqli_query($conexao, $sql);

										foreach ($filiais as $filial){
											echo '<option>' . $filial['nome'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<a href="../evento.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
							<button type="submit" class="btn btn-success" value="Salvar" name="submit">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /#wrapper -->

	<?php
		if(isset($_POST['submit'])){
			if($_POST['submit'] == "Salvar"){
				$data 		= $_POST['data'];
				$duracao 	= $_POST['duracao'];
				$preco 		= $_POST['preco'];

				$nome_filial 	= $_POST['nome_filial'];
				$nome_cliente 	= $_POST['nome_cliente'];

				$data = date('Y-m-d H:i', strtotime($data));	// Converte a data para o padrão TIMESTAMP

				$sql = "SELECT id_filial
						FROM filial
						WHERE nome='$nome_filial'
						LIMIT 1";
				$filial = mysqli_fetch_array( mysqli_query($conexao, $sql) );
				$id_filial = $filial['id_filial'];

				$sql = "SELECT id_pessoa
						FROM pessoa
						WHERE nome='$nome_cliente'
						LIMIT 1";
				$cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) );
				$id_cliente = $cliente['id_pessoa'];

				$sql = "INSERT INTO evento (data, duracao, preco, id_filial, id_cliente) 
						VALUES ('$data', '$duracao', '$preco', '$id_filial', '$id_cliente')";
				$resultado = mysqli_query($conexao, $sql);

				mysqli_close($conexao);

				header("Location: ../evento.php"); // redireciona de volta para a página de vizualização*/
			}
		}
	?>
</body>
</html>