<?php 
  	require_once('../../conexao.php');
	$id = $_POST['id-excluir'];
	
	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$query = $pdo->query("SELECT * FROM funcionarios WHERE id  = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$cpf_banco = @$res[0]['cpf'];

	$query = $pdo->query("DELETE FROM funcionarios WHERE id = '$id'");

	$query = $pdo->query("DELETE FROM usuarios WHERE cpf = '$cpf_banco'");

	echo "Excluido com sucesso!";
?>