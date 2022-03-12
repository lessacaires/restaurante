<?php
	require_once('../../conexao.php');

	$id 		= $_POST['id'];
	$nome 		= $_POST['nome'];
	$descricao 	= $_POST['descricao'];
	
	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($nome != $nome_banco){
		$query = $pdo->prepare("SELECT * FROM mesas WHERE nome = :nome");
		$query->bindValue(":nome", "$nome");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Mesa já cadastrada.";
			exit();
		}
	}
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO mesas SET nome = :nome, descricao = :descricao");
	}else{
		$query = $pdo->prepare("UPDATE mesas SET nome = :nome, descricao = :descricao WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":descricao", "$descricao");
	$query->execute();

	echo "Salvo com sucesso!";
 ?>