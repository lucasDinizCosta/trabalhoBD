<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_pessoa = $_GET['id'];

	$sql = "DELETE FROM gerente WHERE id_pessoa='$id_pessoa'";
	$resultado = mysqli_query($conexao, $sql);

	$sql = "DELETE FROM funcionario WHERE id_pessoa='$id_pessoa'";
	$resultado = mysqli_query($conexao, $sql);

	$sql = "DELETE FROM pessoa WHERE id_pessoa='$id_pessoa'";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../gerente.php"); // redireciona de volta para a página de vizualização
}

?>