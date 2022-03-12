<?php 
	require_once('../../conexao.php');
	$id = $_POST['id-excluir'];

	$query = $pdo->query("DELETE FROM mesas WHERE id = '$id'");

	echo "Excluido com sucesso!";
?>