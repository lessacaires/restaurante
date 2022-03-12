<?php
	require_once('../../conexao.php');

	$id 	= $_POST['id'];
	$nome 	= $_POST['nome'];
	
	//BUSCAR O CPF JÁ CADASTRADO NO BANCO
	$query = $pdo->prepare("SELECT * FROM cargos WHERE id = :id");
	$query->bindValue(":id", "$id");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_banco = $res[0]['nome'];


	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($nome != $nome_banco){
		$query = $pdo->prepare("SELECT * FROM cargos WHERE nome = :nome");
		$query->bindValue(":nome", "$nome");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Cargo já cadastrado.";
			exit();
		}
	}
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO cargos SET nome = :nome");
	}else{
		$query = $pdo->prepare("UPDATE cargos SET nome = :nome WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->execute();

	echo "Salvo com sucesso!";
 ?>