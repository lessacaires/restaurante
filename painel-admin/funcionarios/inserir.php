<?php
	require_once('../../conexao.php');

	$id 		= $_POST['id'];
	$nome 		= $_POST['nome'];
	$cpf 		= $_POST['cpf'];
	$email 		= $_POST['email'];
	$telefone 	= $_POST['telefone'];
	$cargo 		= $_POST['cargo'];
	$endereco 	= $_POST['endereco'];
	$datacad 	= $_POST['datacad'];
	
	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$query = $pdo->query("SELECT * FROM funcionarios WHERE id  = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$cpf_banco = @$res[0]['cpf'];
	$email_banco = @$res[0]['email'];

	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($cpf != $cpf_banco){
		$query = $pdo->prepare("SELECT * FROM funcionarios WHERE cpf = :cpf");
		$query->bindValue(":cpf", "$cpf");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "CPF já cadastrado.";
			exit();
		}
	}
	//VERIFICA SE JÁ EXISTE O REGISTRO CADASTRADO
	if($email != $email_banco){
		$query = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email");
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
		$query = $pdo->prepare("INSERT INTO funcionarios(nome, cpf, email, telefone, cargo, endereco, datacad) VALUES (:nome, :cpf, :email, :telefone, :cargo, :endereco, curDate())");
	}else{
		$query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cargo = :cargo, endereco = :endereco, datacad = curDate() WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":email", "$email");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":cargo", "$cargo");
	$query->bindValue(":endereco", "$endereco");

	$query->execute();

	//TRAZER O NOME DO CARGO
	$query = $pdo->query("SELECT * FROM cargos WHERE id = '$cargo'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	$nome_cargo = @$res[0]['nome'];

	//LANÇAR OU EDITAR DADOS NA TABELA DOS USUÁRIOS
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = '123mudar', nivel = :cargo");
	}else{
		$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = '123mudar', nivel = :cargo WHERE cpf = '$cpf_banco'");
	}
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":email", "$email");
	$query->bindValue(":cargo", "$nome_cargo");
	$query->execute();

	echo "Salvo com sucesso!";
 ?>