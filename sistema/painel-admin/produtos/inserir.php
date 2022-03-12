<?php
	require_once('../../conexao.php');

	$id 			= $_POST['id'];
	$nome 			= $_POST['nome'];
	$descricao 		= $_POST['descricao'];
	$valor_compra 	= $_POST['valor_compra'];
	$valor_venda 	= $_POST['valor_venda'];
	$categoria 		= $_POST['categoria'];
	$fornecedor 	= $_POST['fornecedor'];
	$estoque 		= $_POST['estoque'];
	$imagem			= $_POST['imagem'];
	
	//BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
	$query = $pdo->query("SELECT * FROM produtos WHERE id  = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_banco = @$res[0]['nome'];

	if($id == ""){
		$query = $pdo->prepare("INSERT INTO produtos VALUES (:nome, :descricao, :valor_compra, :valor_venda, :categoria, :fornecedor, :estoque, :imagem)");
	}else{
		$query = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, valor_compra = :valor_compra, valor_venda = :valor_venda, categoria = :categoria. fornecedor = :fornecedor, estoque = :estoque, imagem = :imagem WHERE id = '$id'");
	}	
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":descricao", "$descricao");
	$query->bindValue(":valor_compra", "$valor_compra");
	$query->bindValue(":valor_venda", "$valor_venda");
	$query->bindValue(":categoria", "$categoria");
	$query->bindValue(":fornecedor", "$fornecedor");
	$query->bindValue(":estoque", "$estoque");
	$query->bindValue(":imagem", "$imagem");

	$query->execute();

	//TRAZER O NOME DA CATEGORIA
	$query = $pdo->query("SELECT * FROM categorias WHERE id = '$categoria'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	$nome_categoria = @$res[0]['nome'];

	//TRAZER O NOME DO FORNECEDOR
	$query = $pdo->query("SELECT * FROM fornecedores WHERE id = '$fornecedor'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	$nome_fornecedor = @$res[0]['nome'];

	echo "Salvo com sucesso!";
 ?>