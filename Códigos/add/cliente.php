<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Cliente</title>
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
					<form id="cliente" name="cliente" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Cliente</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" name="nome" id="nome" class="form-control" required>
							</div>
							<div class="form-group">
								<label>CPF</label>
								<input type="text" name="cpf" id="cpf" class="form-control"  onkeypress="mascara(this, '###.###.###-##')" maxlength="14" required>
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="text" name="email" id="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Telefone</label>
								<input type="text" name="telefone" id="telefone" class="form-control"  onkeypress="mascara(this, '## ####-####')" maxlength="12" required>
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
							<div class="form-group">
								<label>Crédito Disponível</label>
								<input type="text" name="credito_disponivel" id="credito_disponivel" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<a href="../cliente.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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
			$nome 		= $_POST['nome'];
			$cpf 		= $_POST['cpf'];
			$email 		= $_POST['email'];
			$telefone 	= $_POST['telefone'];

			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$credito_disponivel = $_POST['credito_disponivel'];

			$sql = "INSERT INTO pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) 
					VALUES ('$nome', '$email', '$telefone', '$cpf', '$rua', '$numero', '$cidade', '$cep')";
			$resultado = mysqli_query($conexao, $sql);

			$id_pessoa = mysqli_insert_id($conexao); // Último ID inserido

			$sql = "INSERT INTO cliente (credito_disponivel, id_pessoa) 
					VALUES ('$credito_disponivel', '$id_pessoa')";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../cliente.php"); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>