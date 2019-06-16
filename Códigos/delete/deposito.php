<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_deposito = $_GET['id'];

	$sql = "DELETE FROM deposito WHERE id_deposito='$id_deposito'";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../deposito.php"); // redireciona de volta para a página de vizualização
}

?>