<!DOCTYPE html>
<?php require_once('conexao.php');

//INSERIR UM USUÁRIO ADMINISTRADOR CASO NÃO EXISTA NENHUM
$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg == 0){
    $pdo->query("INSERT INTO usuarios SET nome = 'syscontrol', cpf = '00198223595', email = '".$email_adm."', senha = '123mudar', nivel = 'Administrador'");
}
	
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/icone2.ico" type="image/x-icon">

	<title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/css/login.css">
</head>
<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <img src="img/logo.png" class="col-md-12">
                    <div id="login-box" class="col-md-12 mt-4">
                        <form id="login-form" class="form" action="autenticar.php" method="post">

                            <h3 class="text-center"><img src="img/logo-icone.png" width="50"></h3>
                            <div class="form-group">
                                <label for="usuario" class="">Usuário:</label><br>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="senha" class="">Senha:</label><br>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <div class="form-group mt-4">
                                <input type="submit" name="submit" class="btn btn-light btn-md" value="Logar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>