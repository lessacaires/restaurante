<?php
	require_once('../conexao.php');
	$id 	= $_POST['id_perfil'];
	$nome 	= $_POST['nome_perfil'];
	$cpf 	= $_POST['cpf_perfil'];
	$email 	= $_POST['email_perfil'];
	$senha 	= $_POST['senha_perfil'];
	
	//BUSCAR O CPF JÁ CADASTRADO NO BANCO
	$query = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
	$query->bindValue(":id", "$id");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$cpf_banco = $res[0]['cpf'];
	$email_banco = $res[0]['email'];


	//VERIFICA SE JÁ EXISTE O CPF CADASTRADO
	if($cpf != $cpf_banco){
		$query = $pdo->prepare("SELECT * FROM usuários  WHERE cpf = :cpf");
		$query->bindValue(":cpf", "$cpf");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "CPF já cadastrado.";
			exit();
		}
	}

	//VERIFICA SE JÁ EXISTE O EMAIL CADASTRADO
	if($email != $email_banco){
		$query = $pdo->prepare("SELECT * FROM usuários  WHERE email = :email");
		$query->bindValue(":email", "$email");
		$query->execute();
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			echo "Email já cadastrado.";
			exit();
		}
	}

	$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE id = :id");
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":email", "$email");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":senha", "$senha");
	$query->bindValue(":id", "$id");
	$query->execute();

	echo "Salvo com sucesso!";
 ?>