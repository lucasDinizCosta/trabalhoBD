<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Editar Cliente</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");

			$id_pessoa = $_GET['id'];
			$sql = "SELECT 		c.id_pessoa, p.nome, p.email, p.telefone, 
								p.cpf, p.rua, p.numero, p.cidade, p.cep, 
								c.credito_disponivel
					FROM cliente c
					INNER JOIN pessoa p
						on c.id_pessoa=p.id_pessoa
					WHERE c.id_pessoa='$id_pessoa'";
			$cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) );
		?>
		<!-- /#sidebar-wrapper -->
		<div id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="filial" name="filial" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Editar Cliente</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" name="nome" id="nome" class="form-control" required <?php echo 'value="'.$cliente['nome'].'"'?>>
							</div>
							<div class="form-group">
								<label>CPF</label>
								<input type="text" name="cpf" id="cpf" class="form-control"  onkeypress="mascara(this, '###.###.###-##')" maxlength="14" required <?php echo 'value="'.$cliente['cpf'].'"'?>>
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="text" name="email" id="email" class="form-control" required <?php echo 'value="'.$cliente['email'].'"'?>>
							</div>
							<div class="form-group">
								<label>Telefone</label>
								<input type="text" name="telefone" id="telefone" class="form-control"  onkeypress="mascara(this, '## ####-####')" maxlength="12" required <?php echo 'value="'.$cliente['telefone'].'"'?>>
							</div>
							<div class="form-group">
								<label>Rua</label>
								<input type="text" name="rua" id="rua" class="form-control" required <?php echo 'value="'.$cliente['rua'].'"'?>>
							</div>
							<div class="form-group">
								<label>Número</label>
								<input type="number" name="numero" id="numero" class="form-control" required <?php echo 'value="'.$cliente['numero'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Cidade</label>
								<input type="text" name="cidade" id="cidade" class="form-control" required <?php echo 'value="'.$cliente['cidade'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>CEP</label>
								<input type="text" name="cep" id="cep" class="form-control" onkeypress="mascara(this, '#####-###')" maxlength="9" required <?php echo 'value="'.$cliente['cep'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Crédito Disponível</label>
								<input type="text" name="credito_disponivel" id="credito_disponivel" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required <?php echo 'value="'.$cliente['credito_disponivel'].'"'?>></textarea>
							</div>
							<div class="modal-footer">
								<a href="../cliente.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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
			$nome 		= $_POST['nome'];
			$cpf 		= $_POST['cpf'];
			$email 		= $_POST['email'];
			$telefone 	= $_POST['telefone'];

			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$credito_disponivel = $_POST['credito_disponivel'];

			$sql = "UPDATE pessoa 
					SET nome='$nome', email='$email', telefone='$telefone', cpf='$cpf', rua='$rua', numero='$numero', cidade='$cidade', cep='$cep'
					WHERE id_pessoa='$id_pessoa'";
			$resultado = mysqli_query($conexao, $sql);

			$sql = "UPDATE cliente 
					SET credito_disponivel='$credito_disponivel'
					WHERE id_pessoa='$id_pessoa'";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../cliente.php"); // redireciona de volta para a página de vizualização
		}
	?>
</body>
</html>