<?php

include_once("../conection.php");

if (isset($_GET['id'])){
	$id_evento = $_GET['id'];

	$sql = "DELETE FROM convidado WHERE id_evento='$id_evento'";
	$resultado = mysqli_query($conexao, $sql);

	$sql = "DELETE FROM evento WHERE id_evento='$id_evento'";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: ../evento.php"); // redireciona de volta para a página de vizualização
}

?>