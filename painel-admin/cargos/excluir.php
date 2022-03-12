<?php 
	require_once('../../conexao.php');
	$id = $_POST['id-excluir'];

	$query = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) == 0){
		$query = $pdo->query("DELETE FROM cargos WHERE id = '$id'");		
	}else{
		echo "Existem '".count($res)."' funcionários associados a este cargo, exclua primeiramente estes funcionários, para depois excluir o cargo.";
		exit();
	}
?>