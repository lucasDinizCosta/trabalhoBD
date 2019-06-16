<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_fornecedor = $_GET['id'];

	$sql = "DELETE FROM fornecedor WHERE id_fornecedor='$id_fornecedor'";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../fornecedor.php"); // redireciona de volta para a página de vizualização
}

?>