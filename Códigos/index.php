<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/simple-sidebar.css" rel="stylesheet">


	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Filial</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/form_process.js"></script>

	<!-- Latest minified bootstrap css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest minified bootstrap js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script type='text/javascript'>
		$(document).ready(function(){
			// Activate tooltip
			$('[data-toggle="tooltip"]').tooltip();
			
			// Select/Deselect checkboxes
			var checkbox = $('table tbody input[type="checkbox"]');
			$("#selectAll").click(function(){
				if(this.checked){
					checkbox.each(function(){
						this.checked = true;
					});
				} else{
					checkbox.each(function(){
						this.checked = false;
					});
				} 
			});
			checkbox.click(function(){
				if(!this.checked){
					$("#selectAll").prop("checked", false);
				}
			});
		});
		$(document).ready(function(){
			$('#addFilial').on('click', '.btn-success', function(e){
				var vnome 	= $('#addFilial #nome').val();
				var vrua 	= $('#addFilial #rua').val();
				var vnumero = $('#addFilial #numero').val();
				var vcidade = $('#addFilial #cidade').val();
				var vcep 	= $('#addFilial #cep').val();
				var vsubmit = "Adicionar";

				$.post("crud_filial.php", //Required URL of the page on server
					{ // Data Sending With Request To Server
						nome:vnome,
						rua:vrua,
						numero:vnumero,
						cidade:vcidade,
						cep:vcep,
						submit:vsubmit,
					},
					function(response,status){ // Required Callback Function
					$("#container").html(response);//"response" receives - whatever written in echo of above PHP script.

				});

				window.reload();
				$('#addFilial').modal('hide');
			});
		});
		$(document).ready(function(){
			$('#editFilial').on('click', '.btn-info', function(e){
				var vid_filial 	= $('#editFilial #id_filial').val();
				var vnome 		= $('#editFilial #nome').val();
				var vrua 		= $('#editFilial #rua').val();
				var vnumero 	= $('#editFilial #numero').val();
				var vcidade 	= $('#editFilial #cidade').val();
				var vcep 		= $('#editFilial #cep').val();
				var vsubmit 	= "Salvar";

				$.post("crud_filial.php", //Required URL of the page on server
					{ // Data Sending With Request To Server
						id_filial:vid_filial,
						nome:vnome,
						rua:vrua,
						numero:vnumero,
						cidade:vcidade,
						cep:vcep,
						submit:vsubmit,
					},
					function(response,status){ // Required Callback Function
					$("#container").html(response);//"response" receives - whatever written in echo of above PHP script.

				});

				window.reload();
				$('#editFilial').modal('hide');
			});
		});
		$(document).ready(function(){
			$('#deleteOneFilial').on('click', '.btn-danger', function(e){
				var vid_filial 	= $('#deleteOneFilial #id_filial').val();
				var vsubmit 	= "Deletar";

				$.post("crud_filial.php", //Required URL of the page on server
					{ // Data Sending With Request To Server
						id_filial:vid_filial,
						submit:vsubmit,
					},
					function(response,status){ // Required Callback Function
					$("#container").html(response);//"response" receives - whatever written in echo of above PHP script.

				});

				window.reload();
				$('#deleteOneFilial').modal('hide');
			});
		});
		$(document).ready(function(){
			$('#deleteMoreFilial').on('click', '.btn-danger', function(e){
				var vsubmit = "Deletar";
				var checkbox = $('table tbody input[type="checkbox"]');
				$(checkbox).each(function(){
					if($(this).prop('checked')){
						var vid_filial = $(this).val();

						$.post("crud_filial.php", //Required URL of the page on server
							{ // Data Sending With Request To Server
								id_filial:vid_filial,
								submit:vsubmit,
							},
							function(response,status){ // Required Callback Function
							$("#container").html(response);//"response" receives - whatever written in echo of above PHP script.

						});
					}
				});

				window.reload();
				$('#deleteMoreFilial').modal('hide');
			});
		});
		$(document).on('click', '.edit', function(){
			var vid_filial = $(this).attr("id");
			var vsubmit = "Editar";
			$.ajax({
				url:"crud_filial.php",
				method:"POST",
				data:{
					id_filial:vid_filial,
					submit:vsubmit
				},
				dataType:"json",
				success:function(data){
					$('#editFilial #id_filial').val(data.id_filial);
					$('#editFilial #nome').val(data.nome);
					$('#editFilial #rua').val(data.rua);
					$('#editFilial #numero').val(data.numero);
					$('#editFilial #cidade').val(data.cidade);
					$('#editFilial #cep').val(data.cep);
					$('#editFilial').modal('show');
				}
			});
		});
		$(document).on('click', '.delete', function(){
			var id_filial = $(this).attr("id");

			$('#deleteOneFilial #id_filial').val(id_filial);
			$('#deleteOneFilial').modal('show');
		});
		function mascara(t, mask){
			var i = t.value.length;				
			var saida = mask.substring(1,0);
			var texto = mask.substring(i)
			if (texto.substring(0,1) != saida){
				t.value += texto.substring(0,1);
			}
		}
		function mascaraDinheiro(t) {
			$('.dinheiro').mask('#.00', {reverse: true});
		}
	</script>
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
								<a href="#addFilial" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Nova Filial</span></a>
								<a href="#deleteMoreFilial" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Deletar</span></a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>
									<span class="custom-checkbox">
										<input type="checkbox" id="selectAll">
										<label for="selectAll"></label>
									</span>
								</th>
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

								$sql = "SELECT * FROM filial";
								$filiais = mysqli_query($conexao, $sql);

								$i = 0;

								foreach($filiais as $filial){
									$i += 1;

									echo "<tr>";
										echo "<td>";
											echo "<span class='custom-checkbox'>";
												echo "<input type='checkbox' id='checkbox".$filial['id_filial']."' name='type' value='".$filial['id_filial']."'>";
												echo "<label for='checkbox".$filial['id_filial']."'></label>";
											echo "</span>";
										echo "</td>";
										echo '<td>' . $filial['nome'] . '</td>';
										echo '<td>' . $filial['rua'] . '</td>';
										echo '<td>' . $filial['numero'] . '</td>';
										echo '<td>' . $filial['cidade'] . '</td>';
										echo '<td>' . $filial['cep'] . '</td>';
										echo '<td>';
											echo '<a href="#editFilial" id="'.$filial['id_filial'].'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>';
											echo '<a href="#deleteOneFilial" id="'.$filial['id_filial'].'" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>';
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
			<!-- Add Modal HTML -->
			<div id="addFilial" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="filial" name="filial">
							<div class="modal-header">						
								<h4 class="modal-title">Adicionar Filial</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">					
								<div class="form-group">
									<label>Nome</label>
									<input type="text" name="nome" id="nome" class="form-control" required>
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
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input id="submit" type="submit" value="Adicionar" class="btn btn-success" />
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Modal HTML -->
			<div id="editFilial" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="filial" name="filial">
							<div class="modal-header">
								<h4 class="modal-title">Editar Filial</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group" style="display: none;">
									<label>id_filial</label>
									<input type="text" name="id_filial" id="id_filial" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Nome</label>
									<input type="text" name="nome" id="nome" class="form-control" required>
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
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input id="submit" type="submit" name="Salvar" value="Salvar" class="btn btn-info" />
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Delete Modal HTML -->
			<div id="deleteOneFilial" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="filial">
							<div class="modal-header">						
								<h4 class="modal-title">Deletar Filial</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group" style="display: none;">
									<label>id_filial</label>
									<input type="text" name="id_filial" id="id_filial" class="form-control" required>
								</div>
								<p>Você tem certeza que deseja deletar esta Filial?</p>
								<p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input id="submit" type="submit" class="btn btn-danger" value="Deletar">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Delete Modal HTML -->
			<div id="deleteMoreFilial" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="filial">
							<div class="modal-header">						
								<h4 class="modal-title">Deletar Filiais</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<p>Você tem certeza que deseja deletar estas Filiais?</p>
								<p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input id="submit" type="submit" class="btn btn-danger" value="Deletar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->
</body>
</html>