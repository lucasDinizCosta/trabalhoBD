<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_filial = $_GET['id'];

	$sql = "DELETE FROM filial WHERE id_filial=".$id_filial;
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../index.php"); // redireciona de volta para a página de vizualização
}

?>