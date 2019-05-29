<?php
	if(isset($_POST['submit'])){
		if($_POST['submit'] == "Adicionar"){
			include_once("conection.php");	/* Estabelece a conexão */

			$nome 	= $_POST['nome'];
			$rua 	= $_POST['rua'];
			$numero = $_POST['numero'];
			$cidade = $_POST['cidade'];
			$cep 	= $_POST['cep'];

			$sql = "INSERT INTO filial (nome, rua, numero, cidade, cep) VALUES ('$nome', '$rua', '$numero', '$cidade', '$cep')";
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);
		}
		elseif($_POST['submit'] == "Editar"){
			include_once("conection.php");	/* Estabelece a conexão */

			$id = $_POST['id_filial'];

			$sql = "SELECT * FROM filial WHERE id_filial=" . $id;
			$filial = mysqli_fetch_array( mysqli_query($conexao, $sql) );

			echo json_encode($filial);
		}
		elseif($_POST['submit'] == "Salvar"){
			include_once("conection.php");	/* Estabelece a conexão */

			$id_filial 	= $_POST['id_filial'];
			$nome 		= $_POST['nome'];
			$rua 		= $_POST['rua'];
			$numero 	= $_POST['numero'];
			$cidade 	= $_POST['cidade'];
			$cep 		= $_POST['cep'];

			$sql = "UPDATE filial 
					SET nome='".$nome."', rua='".$rua."', numero='".$numero."', cidade='".$cidade."', cep='".$cep."'
					WHERE id_filial=".$id_filial;

			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);
		}
		elseif($_POST['submit'] == "Deletar"){
			include_once("conection.php");	/* Estabelece a conexão */

			$id_filial = $_POST['id_filial'];

			$sql = "DELETE FROM filial WHERE id_filial=".$id_filial;
			$resultado = mysqli_query($conexao, $sql);

			mysqli_close($conexao);
		}
	}
?>