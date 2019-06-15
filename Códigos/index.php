<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Filiais</title>
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
								<h2>Filial</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/filial.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Nova Filial</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<!--
								<th>
									<span class="custom-checkbox">
										<input type="checkbox" id="selectAll">
										<label for="selectAll"></label>
									</span>
								</th>
								-->
								<th>ID</th>
								<th>Nome</th>
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
										FROM filial
										ORDER BY id_filial";
								$filiais = mysqli_query($conexao, $sql);

								foreach($filiais as $filial){
									echo "<tr>";
										/*
										echo "<td>";
											echo "<span class='custom-checkbox'>";
												echo "<input type='checkbox' id='checkbox".$filial['id_filial']."' name='type' value='".$filial['id_filial']."'>";
												echo "<label for='checkbox".$filial['id_filial']."'></label>";
											echo "</span>";
										echo "</td>";
										*/
										echo '<td>' . $filial['id_filial'] . '</td>';
										echo '<td>' . $filial['nome'] . '</td>';
										echo '<td>' . $filial['rua'] . '</td>';
										echo '<td>' . $filial['numero'] . '</td>';
										echo '<td>' . $filial['cidade'] . '</td>';
										echo '<td>' . $filial['cep'] . '</td>';
										echo '<td>';
											echo '<a href="edit/filial.php?id='.$filial['id_filial'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/filial.php?id='.$filial['id_filial'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
										echo '</td>';
									echo "</tr>";
								}

							?>
						</tbody>
					</table>
					<!--
					<div class="clearfix">
						<div class="hint-text">Mostrando <b>5</b> de <b>25</b> entradas</div>
						<ul class="pagination">
							<li class="page-item disabled"><a href="#">Anterior</a></li>
							<li class="page-item"><a href="#" class="page-link">1</a></li>
							<li class="page-item"><a href="#" class="page-link">2</a></li>
							<li class="page-item active"><a href="#" class="page-link">3</a></li>
							<li class="page-item"><a href="#" class="page-link">4</a></li>
							<li class="page-item"><a href="#" class="page-link">5</a></li>
							<li class="page-item"><a href="#" class="page-link">Próxima</a></li>
						</ul>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</body>
</html>