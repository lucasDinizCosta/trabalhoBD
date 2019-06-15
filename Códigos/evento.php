<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("header.php");
	?>
	<title>Eventos</title>
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
								<h2>Evento</h2>
							</div>
							<div class="col-sm-6">
								<a href="add/evento.php" class="btn btn-success">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novo Evento</span>
								</a>
								<a href="add/convidado.php" class="btn btn-primary">
									<i class="material-icons">&#xE147;</i> 
									<span>Adicionar Novos Convidados</span>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Cliente</th>
								<th>Data</th>
								<th>Duração</th>
								<th>Preço</th>
								<th>Filial</th>
								<th>Ações</th>
								<th>Convidados</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT 	e.data, e.duracao, e.preco,
												e.id_evento, f.nome as 'nome_filial', 
												p.nome as 'nome_cliente'
										FROM evento e
										INNER JOIN filial f
											on e.id_filial=f.id_filial
										INNER JOIN cliente c
											on e.id_cliente=c.id_pessoa
										INNER JOIN pessoa p
											on c.id_pessoa=p.id_pessoa
										ORDER BY id_evento";
								$eventos = mysqli_query($conexao, $sql);

								foreach($eventos as $evento){
									$sql = "SELECT 	c.nome
											FROM convidado c
											WHERE c.id_evento=".$evento['id_evento'].
											" ORDER BY c.nome";
									$convidados = mysqli_query($conexao, $sql);

									echo "<tr>";
										echo '<td>' . $evento['id_evento'] . '</td>';
										echo '<td>' . $evento['nome_cliente'] . '</td>';
										echo '<td>' . $evento['data'] . '</td>';
										echo '<td>' . $evento['duracao'] . '</td>';
										echo '<td>' . $evento['preco'] . '</td>';
										echo '<td>' . $evento['nome_filial'] . '</td>';
										echo '<td>';
											echo '<a href="edit/evento.php?id='.$evento['id_evento'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="delete/evento.php?id='.$evento['id_evento'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
										echo '</td>';

										echo '<td>';
											echo '<select>';
											foreach($convidados as $convidado){
												echo '<option>'.$convidado['nome'].'</option>';
											}
											echo '</select>';
										echo '</td>';
										echo '<td>';
											echo '<a href="edit/convidado.php?id='.$evento['id_evento'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											//echo '<a href="delete/convidado.php?id='.$evento['id_evento'].'" class="delete"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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