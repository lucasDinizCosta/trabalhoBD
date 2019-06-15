<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Clientes</title>
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
								<h2>Cliente</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/cliente.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Cliente</span>
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

								<th>Rua</th>
								<th>Número</th>
								<th>Cidade</th>
								<th>CEP</th>

								<th>Crédito Disponível</th>

								<th>Ações</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT c.id_pessoa, p.nome, p.email, p.telefone, p.cpf, p.rua, p.numero, p.cidade, p.cep, c.credito_disponivel
										FROM cliente c
										INNER JOIN pessoa p
											on c.id_pessoa=p.id_pessoa
										ORDER BY c.id_pessoa";
								$clientes = mysqli_query($conexao, $sql);

								foreach($clientes as $cliente){
									echo "<tr>";
										echo '<td>' . $cliente['id_pessoa'] . '</td>';
										echo '<td>' . $cliente['nome'] . '</td>';
										echo '<td>' . $cliente['email'] . '</td>';
										echo '<td>' . $cliente['telefone'] . '</td>';
										echo '<td>' . $cliente['cpf'] . '</td>';

										echo '<td>' . $cliente['rua'] . '</td>';
										echo '<td>' . $cliente['numero'] . '</td>';
										echo '<td>' . $cliente['cidade'] . '</td>';
										echo '<td>' . $cliente['cep'] . '</td>';

										echo '<td>' . $cliente['credito_disponivel'] . '</td>';

										echo '<td>';
											echo '<a href="edit/cliente.php?id='.$cliente['id_pessoa'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/cliente.php?id='.$cliente['id_pessoa'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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