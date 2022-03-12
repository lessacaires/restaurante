<?php
	require_once('../../conexao.php');

	$id 		= $_POST['id'];
	$nome 		= $_POST['nome'];
	$email 		= $_POST['email'];
	$telefone 	= $_POST['telefone'];
	$endereco 	= $_POST['endereco'];
	$produto 	= $_POST['produto'];
	
	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$query = $pdo->query("SELECT * FROM fornecedores WHERE id  = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_banco = @$res[0]['nome'];
	$email_banco = @$res[0]['email'];

	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($nome != $nome_banco){
		$query = $pdo->prepare("SELECT * FROM fornecedores WHERE nome = :nome");
		$query->bindValue(":nome", "$nome");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Nome já cadastrado.";
			exit();
		}
	}

	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($email != $email_banco){
		$query = $pdo->prepare("SELECT * FROM fornecedores WHERE email = :email");
		$query->bindValue(":email", "$email");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Email já cadastrado.";
			exit();
		}
	}
	

	if($id == ""){
		$query = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, produto = :produto");
	}else{
		$query = $pdo->prepare("UPDATE fornecedores SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, produto = :produto WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":email", "$email");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":endereco", "$endereco");
	$query->bindValue(":produto", "$produto");

	$query->execute();

	echo "Salvo com sucesso!";
 ?>