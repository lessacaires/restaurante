<?php require_once('config.php'); 

date_default_timezone_set('America/Recife');

try{
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8;", "$usuario", "$senha");
	if($pdo){
		echo "";
	}else{
		echo "Erro na conexão com o banco de dados.";
	}
}catch(Exception $e){
	echo 'Não conectado ao banco de dados!<br />'.$e;
}
?>

