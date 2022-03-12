<?php 
  	require_once('../../conexao.php');
	$id = $_POST['id-excluir'];
	
	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$query = $pdo->query("SELECT * FROM produtos WHERE id  = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$cpf_banco = @$res[0]['cpf'];

	$query = $pdo->query("DELETE FROM produtos WHERE id = '$id'");

	echo "Excluido com sucesso!";
?>