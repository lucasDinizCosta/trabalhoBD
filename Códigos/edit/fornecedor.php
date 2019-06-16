<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Editar Fornecedor</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");

			$id_fornecedor = $_GET['id'];
			$sql = "SELECT 	*
					FROM fornecedor 
					WHERE id_fornecedor='$id_fornecedor'";
			$fornecedor = mysqli_fetch_array( mysqli_query($conexao, $sql) );
		?>
		<!-- /#sidebar-wrapper -->
		<div id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="filial" name="filial" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Editar Fornecedor</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Razão Social</label>
								<input type="text" name="razao_social" id="razao_social" class="form-control" required <?php echo 'value="'.$fornecedor['razao_social'].'"'?>>
							</div>
							<div class="form-group">
								<label>CNPJ</label>
								<input type="text" name="cnpj" id="cnpj" class="form-control"  onkeypress="mascara(this, '##.###.###/####-##')" maxlength="18" required <?php echo 'value="'.$fornecedor['cnpj'].'"'?>>
							</div>
							<div class="form-group">
								<label>Rua</label>
								<input type="text" name="rua" id="rua" class="form-control" required <?php echo 'value="'.$fornecedor['rua'].'"'?>>
							</div>
							<div class="form-group">
								<label>Número</label>
								<input type="number" name="numero" id="numero" class="form-control" required <?php echo 'value="'.$fornecedor['numero'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Cidade</label>
								<input type="text" name="cidade" id="cidade" class="form-control" required <?php echo 'value="'.$fornecedor['cidade'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>CEP</label>
								<input type="text" name="cep" id="cep" class="form-control" onkeypress="mascara(this, '#####-###')" maxlength="9" required <?php echo 'value="'.$fornecedor['cep'].'"'?>></textarea>
							</div>
							<div class="modal-footer">
								<a href="../fornecedor.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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
			$razao_social 	= $_POST['razao_social'];
			$cnpj 			= $_POST['cnpj'];

			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$sql = "UPDATE fornecedor 
					SET razao_social='$razao_social', cnpj='$cnpj', rua='$rua', numero='$numero', cidade='$cidade', cep='$cep'
					WHERE id_fornecedor='$id_fornecedor'";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../fornecedor.php"); // redireciona de volta para a página de vizualização
		}
	?>
</body>
</html>