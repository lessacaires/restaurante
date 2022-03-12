<?php
	require_once('../../conexao.php');

	$id 	= $_POST['id'];
	$nome 	= $_POST['nome'];
	
	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($nome != $nome_banco){
		$query = $pdo->prepare("SELECT * FROM categorias WHERE nome = :nome");
		$query->bindValue(":nome", "$nome");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Categoria já cadastrado.";
			exit();
		}
	}
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO categorias(nome) VALUES (:nome)");
	}else{
		$query = $pdo->prepare("UPDATE categorias SET nome = :nome WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->execute();

	echo "Salvo com sucesso!";
 ?>