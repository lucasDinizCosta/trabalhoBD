<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Editar Evento</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");

			$id_evento = $_GET['id'];
			$sql = "SELECT 	e.data, e.duracao, e.preco, 
							p.nome as 'nome_cliente',
							f.nome as 'nome_filial'
					FROM evento e
					INNER JOIN pessoa p
						on e.id_cliente=p.id_pessoa
					INNER JOIN filial f
						on e.id_filial=f.id_filial
					WHERE e.id_evento='$id_evento'";
			$evento = mysqli_fetch_array( mysqli_query($conexao, $sql) );

			$aux = date('Y-m-d', strtotime($evento['data'])).'T'.date('H:i', strtotime($evento['data']));

			$evento['data'] = $aux;	// Converte a data para o padrão TIMESTAMP
		?>
		<!-- /#sidebar-wrapper -->
		<div id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="filial" name="filial" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Editar Evento</h4>
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
											if($evento['nome_cliente'] == $cliente['nome']){
												echo '<option selected>' . $cliente['nome'] . '</option>';
											}
											else{
												echo '<option>' . $cliente['nome'] . '</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Data</label>
								<input type="datetime-local" name="data" id="data" class="form-control" required <?php echo 'value="'.$evento['data'].'"'?>>
							</div>
							<div class="form-group">
								<label>Duração</label>
								<input type="time" name="duracao" id="duracao" class="form-control" required <?php echo 'value="'.$evento['duracao'].'"'?>>
							</div>
							<div class="form-group">
								<label>Preço</label>
								<input type="text" name="preco" id="preco" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required <?php echo 'value="'.$evento['preco'].'"'?>></textarea>
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
											if($evento['nome_filial'] == $filial['nome']){
												echo '<option selected>' . $filial['nome'] . '</option>';
											}
											else{
												echo '<option>' . $filial['nome'] . '</option>';
											}
											echo '<option>' . $filial['nome'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="modal-footer">
								<a href="../evento.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
								<button type="submit" class="btn btn-primary" value="Salvar" name="submit">Salvar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /#wrapper -->

	<?php
		if(isset($_POST['submit'])){
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
			$id_filial = mysqli_fetch_array( mysqli_query($conexao, $sql) )['id_filial'];

			$sql = "SELECT id_pessoa
					FROM pessoa
					WHERE nome='$nome_cliente'
					LIMIT 1";
			$id_cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) )['id_pessoa'];

			$sql = "UPDATE evento 
					SET data='$data', duracao='$duracao', preco='$preco', id_filial='$id_filial', id_cliente='$id_cliente'
					WHERE id_evento='$id_evento'";
			$resultado = mysqli_query($conexao, $sql);
			
			mysqli_close($conexao);

			header("Location: ../evento.php"); // redireciona de volta para a página de vizualização
		}
	?>
</body>
</html>