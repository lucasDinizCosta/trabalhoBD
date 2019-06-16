<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Fornecedor</title>
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
					<form id="fornecedor" name="fornecedor" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Fornecedor</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Razão Social</label>
								<input type="text" name="razao_social" id="razao_social" class="form-control" required>
							</div>
							<div class="form-group">
								<label>CNPJ</label>
								<input type="text" name="cnpj" id="cnpj" class="form-control"  onkeypress="mascara(this, '##.###.###/####-##')" maxlength="18" required>
							</div>
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
							<a href="../fornecedor.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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
			$razao_social 	= $_POST['razao_social'];
			$cnpj 			= $_POST['cnpj'];

			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$sql = "INSERT INTO fornecedor (razao_social, cnpj, rua, numero, cidade, cep) 
					VALUES ('$razao_social', '$cnpj', '$rua', '$numero', '$cidade', '$cep')";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../fornecedor.php"); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>