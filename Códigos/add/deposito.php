<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Depósito</title>
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
					<form id="deposito" name="deposito" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Depósito</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Rua</label>
								<input type="text" name="rua" id="rua" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Número</label>
								<input type="number" name="numero" id="numero" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Cidade</label>
								<input type="text" name="cidade" id="cidade" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>CEP</label>
								<input type="text" name="cep" id="cep" class="form-control" onkeypress="mascara(this, '#####-###')" maxlength="9" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<a href="../deposito.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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
			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$sql = "INSERT INTO deposito (rua, numero, cidade, cep) 
					VALUES ('$rua', '$numero', '$cidade', '$cep')";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../deposito.php"); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>