<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Depósitos</title>
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
								<h2>Depóstio</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/deposito.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Depóstio</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>

								<th>Rua</th>
								<th>Número</th>
								<th>Cidade</th>
								<th>CEP</th>

								<th>Ações</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT *
										FROM deposito
										ORDER BY id_deposito";
								$depositos = mysqli_query($conexao, $sql);

								foreach($depositos as $deposito){
									echo "<tr>";
										echo '<td>' . $deposito['id_deposito'] . '</td>';

										echo '<td>' . $deposito['rua'] . '</td>';
										echo '<td>' . $deposito['numero'] . '</td>';
										echo '<td>' . $deposito['cidade'] . '</td>';
										echo '<td>' . $deposito['cep'] . '</td>';

										echo '<td>';
											echo '<a href="edit/deposito.php?id='.$deposito['id_deposito'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/deposito.php?id='.$deposito['id_deposito'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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