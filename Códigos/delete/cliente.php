<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_pessoa = $_GET['id'];

	$sql = "DELETE FROM cliente WHERE id_pessoa='$id_pessoa'";
	$resultado = mysqli_query($conexao, $sql);

	$sql = "DELETE FROM pessoa WHERE id_pessoa='$id_pessoa'";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../cliente.php"); // redireciona de volta para a página de vizualização
}

?>