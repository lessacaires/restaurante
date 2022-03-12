<?php 
	require_once('../../conexao.php');
	$id = $_POST['id-excluir'];

	$query = $pdo->query("DELETE FROM categorias WHERE id = '$id'");
	
	echo "Excluido com sucesso!";
?>