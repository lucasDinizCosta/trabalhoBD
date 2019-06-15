<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Gerentes</title>
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
								<h2>Gerente</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/gerente.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Gerente</span>
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

								<th>Turno</th>
								<th>Grau</th>

								<th>Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT 		g.id_pessoa, p.nome, p.email, p.telefone, 
													p.cpf, p.rua, p.numero, p.cidade, p.cep, 
													f.cargo, f.salario, f.login, f.senha, 
													f.status, g.turno, g.grau, 
													fi.nome as 'nome_filial'
										FROM gerente g
										INNER JOIN funcionario f
											on g.id_pessoa=f.id_pessoa
										INNER JOIN pessoa p
											on f.id_pessoa=p.id_pessoa
										INNER JOIN filial fi
											on f.id_filial=fi.id_filial
										ORDER BY f.id_pessoa";
								$gerentes = mysqli_query($conexao, $sql);

								foreach($gerentes as $gerente){
									echo "<tr>";
										echo '<td>' . $gerente['id_pessoa'] . '</td>';
										echo '<td>' . $gerente['nome'] . '</td>';
										echo '<td>' . $gerente['email'] . '</td>';
										echo '<td>' . $gerente['telefone'] . '</td>';
										echo '<td>' . $gerente['cpf'] . '</td>';
										/*
										echo '<td>' . $gerente['rua'] . '</td>';
										echo '<td>' . $gerente['numero'] . '</td>';
										echo '<td>' . $gerente['cidade'] . '</td>';
										echo '<td>' . $gerente['cep'] . '</td>';
										*/
										echo '<td>' . $gerente['cargo'] . '</td>';
										echo '<td>' . $gerente['salario'] . '</td>';
										echo '<td>' . $gerente['login'] . '</td>';
										echo '<td>' . $gerente['senha'] . '</td>';
										if($gerente['status']){
											echo '<td>Ativo</td>';
										}
										else{
											echo '<td>Inativo</td>';
										}
										
										echo '<td>' . $gerente['nome_filial'] . '</td>';

										echo '<td>' . $gerente['turno'] . '</td>';
										echo '<td>' . $gerente['grau'] . '</td>';

										echo '<td>';
											echo '<a href="edit/gerente.php?id='.$gerente['id_pessoa'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/gerente.php?id='.$gerente['id_pessoa'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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