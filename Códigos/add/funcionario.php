<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Adicionar Funcionário</title>
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
					<form id="funcionario" name="funcionario" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Adicionar Funcionário</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" name="nome" id="nome" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Setor</label>
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
								<label>Cargo</label>
								<input type="text" name="cargo" id="cargo" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Salário</label>
								<input type="text" name="salario" id="salario" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required></textarea>
							</div>
							<div class="form-group">
								<label>Login</label>
								<input type="text" name="login" id="login" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Senha</label>
								<input type="password" name="senha" id="senha" class="form-control" required></textarea>
							</div>
							<input type="checkbox" name="status" value="1">Ativo<br>
						</div>
						<div class="modal-footer">
							<a href="../funcionario.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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

			$cargo 		= $_POST['cargo'];
			$salario 	= $_POST['salario'];
			$login 		= $_POST['login'];
			$senha 		= $_POST['senha'];

			$nome_filial = $_POST['nome_filial'];

			if(isset($_POST['status'])){
				$status = 1;
			}
			else{
				$status = 0;
			}

			$sql = "SELECT id_filial
					FROM filial
					WHERE nome='$nome_filial'
					LIMIT 1";
			$filial = mysqli_fetch_array( mysqli_query($conexao, $sql) );
			$id_filial = $filial['id_filial'];

			$sql = "INSERT INTO pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) 
					VALUES ('$nome', '$email', '$telefone', '$cpf', '$rua', '$numero', '$cidade', '$cep')";
			$resultado = mysqli_query($conexao, $sql);

			$id_pessoa = mysqli_insert_id($conexao); // Último ID inserido

			$sql = "INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) 
					VALUES ('$cargo', '$salario', '$login', '$senha', '$status', '$id_filial', '$id_pessoa')";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../funcionario.php"); // redireciona de volta para a página de vizualização
		}
	?>

</body>
</html>