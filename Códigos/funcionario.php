<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Funcionários</title>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("conection.php");	/* Estabelece a conexão */
			include("sidebar.php");
		?>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Funcionário</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/funcionario.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Funcionário</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-Mail</th>
								<th>Telefone</th>
								<th>CPF</th>
							<!--
								<th>Rua</th>
								<th>Número</th>
								<th>Cidade</th>
								<th>CEP</th>
							-->

								<th>Cargo</th>
								<th>Salário</th>
								<th>Login</th>
								<th>Senha</th>
								<th>Status</th>
								<th>Filial</th>

								<th>Ações</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT f.id_pessoa, p.nome, p.email, p.telefone, p.cpf, p.rua, p.numero, p.cidade, p.cep, f.cargo, f.salario, f.login, f.senha, f.status, fi.nome as 'nome_filial'
										FROM funcionario f
										INNER JOIN pessoa p
											on f.id_pessoa=p.id_pessoa
										INNER JOIN filial fi
											on f.id_filial=fi.id_filial
										ORDER BY f.id_pessoa";
								$funcionarios = mysqli_query($conexao, $sql);

								foreach($funcionarios as $funcionario){
									echo "<tr>";
										echo '<td>' . $funcionario['id_pessoa'] . '</td>';
										echo '<td>' . $funcionario['nome'] . '</td>';
										echo '<td>' . $funcionario['email'] . '</td>';
										echo '<td>' . $funcionario['telefone'] . '</td>';
										echo '<td>' . $funcionario['cpf'] . '</td>';
										/*
										echo '<td>' . $funcionario['rua'] . '</td>';
										echo '<td>' . $funcionario['numero'] . '</td>';
										echo '<td>' . $funcionario['cidade'] . '</td>';
										echo '<td>' . $funcionario['cep'] . '</td>';
										*/
										echo '<td>' . $funcionario['cargo'] . '</td>';
										echo '<td>' . $funcionario['salario'] . '</td>';
										echo '<td>' . $funcionario['login'] . '</td>';
										echo '<td>' . $funcionario['senha'] . '</td>';
										if($funcionario['status']){
											echo '<td>Ativo</td>';
										}
										else{
											echo '<td>Inativo</td>';
										}
										
										echo '<td>' . $funcionario['nome_filial'] . '</td>';

										echo '<td>';
											echo '<a href="edit/funcionario.php?id='.$funcionario['id_pessoa'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/funcionario.php?id='.$funcionario['id_pessoa'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
										echo '</td>';
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>