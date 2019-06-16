<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Fornecedores</title>
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
								<h2>Fornecedor</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/fornecedor.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Fornecedor</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Razão Social</th>
								<th>CNPJ</th>

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
										FROM fornecedor
										ORDER BY id_fornecedor";
								$fornecedores = mysqli_query($conexao, $sql);

								foreach($fornecedores as $fornecedor){
									echo "<tr>";
										echo '<td>' . $fornecedor['id_fornecedor'] . '</td>';
										echo '<td>' . $fornecedor['razao_social'] . '</td>';
										echo '<td>' . $fornecedor['cnpj'] . '</td>';

										echo '<td>' . $fornecedor['rua'] . '</td>';
										echo '<td>' . $fornecedor['numero'] . '</td>';
										echo '<td>' . $fornecedor['cidade'] . '</td>';
										echo '<td>' . $fornecedor['cep'] . '</td>';

										echo '<td>';
											echo '<a href="edit/fornecedor.php?id='.$fornecedor['id_fornecedor'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/fornecedor.php?id='.$fornecedor['id_fornecedor'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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