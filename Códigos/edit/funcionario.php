<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("../header.php");
	?>
	<title>Editar Funcionário</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../conection.php");	/* Estabelece a conexão */
			include("../sidebar_aux.php");

			$id_pessoa = $_GET['id'];
			$sql = "SELECT 		f.id_pessoa, p.nome, p.email, p.telefone, 
								p.cpf, p.rua, p.numero, p.cidade, p.cep, 
								f.cargo, f.salario, f.login, f.senha, 
								f.status, fi.nome as 'nome_filial'
					FROM funcionario f
					INNER JOIN pessoa p
						on f.id_pessoa=p.id_pessoa
					INNER JOIN filial fi
						on f.id_filial=fi.id_filial
					WHERE f.id_pessoa='$id_pessoa'";
			$funcionario = mysqli_fetch_array( mysqli_query($conexao, $sql) );
		?>
		<!-- /#sidebar-wrapper -->
		<div id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="filial" name="filial" action="" method="POST" target="_self">
						<div class="modal-header">
							<h4 class="modal-title">Editar Filial</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" name="nome" id="nome" class="form-control" required <?php echo 'value="'.$funcionario['nome'].'"'?>>
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
											if($filial['nome'] == $funcionario['nome_filial']){
												echo '<option selected>' . $filial['nome'] . '</option>';
											}
											else{
												echo '<option>' . $filial['nome'] . '</option>';
											}
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>CPF</label>
								<input type="text" name="cpf" id="cpf" class="form-control"  onkeypress="mascara(this, '###.###.###-##')" maxlength="14" required <?php echo 'value="'.$funcionario['cpf'].'"'?>>
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="text" name="email" id="email" class="form-control" required <?php echo 'value="'.$funcionario['email'].'"'?>>
							</div>
							<div class="form-group">
								<label>Telefone</label>
								<input type="text" name="telefone" id="telefone" class="form-control"  onkeypress="mascara(this, '## ####-####')" maxlength="12" required <?php echo 'value="'.$funcionario['telefone'].'"'?>>
							</div>
							<div class="form-group">
								<label>Rua</label>
								<input type="text" name="rua" id="rua" class="form-control" required <?php echo 'value="'.$funcionario['rua'].'"'?>>
							</div>
							<div class="form-group">
								<label>Número</label>
								<input type="number" name="numero" id="numero" class="form-control" required <?php echo 'value="'.$funcionario['numero'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Cidade</label>
								<input type="text" name="cidade" id="cidade" class="form-control" required <?php echo 'value="'.$funcionario['cidade'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>CEP</label>
								<input type="text" name="cep" id="cep" class="form-control" onkeypress="mascara(this, '#####-###')" maxlength="9" required <?php echo 'value="'.$funcionario['cep'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Cargo</label>
								<input type="text" name="cargo" id="cargo" class="form-control" required <?php echo 'value="'.$funcionario['cargo'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Salário</label>
								<input type="text" name="salario" id="salario" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11" required <?php echo 'value="'.$funcionario['salario'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Login</label>
								<input type="text" name="login" id="login" class="form-control" required <?php echo 'value="'.$funcionario['login'].'"'?>></textarea>
							</div>
							<div class="form-group">
								<label>Senha</label>
								<input type="password" name="senha" id="senha" class="form-control" required <?php echo 'value="'.$funcionario['senha'].'"'?>></textarea>
							</div>
							<input type="checkbox" name="status" value="1" <?php if($funcionario['status'] == 1) echo 'checked'; ?> >Ativo<br>
							</div>
							<div class="modal-footer">
								<a href="../funcionario.php"><span class="btn btn-default" value="Cancelar">Cancelar</span></a>
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

			$sql = "UPDATE pessoa 
					SET nome='$nome', email='$email', telefone='$telefone', cpf='$cpf', rua='$rua', numero='$numero', cidade='$cidade', cep='$cep'
					WHERE id_pessoa='$id_pessoa'";
			$resultado = mysqli_query($conexao, $sql);

			$sql = "UPDATE funcionario 
					SET cargo='$cargo', salario='$salario', login='$login', senha='$senha', status='$status', id_filial='$id_filial'
					WHERE id_pessoa='$id_pessoa'";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);

			header("Location: ../funcionario.php"); // redireciona de volta para a página de vizualização
		}
	?>
</body>
</html>