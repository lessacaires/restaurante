<?php
require_once('verificar.php');
require_once('../conexao.php');
@session_start();

  //MENUS PARA O PAINEL
$menu1 = 'home';
$menu2 = 'usuarios';
$menu3 = 'funcionarios';
$menu4 = 'cargos';
$menu5 = 'mesas';
$menu6 = 'fornecedores';
$menu7 = 'categorias';
$menu8 = 'produtos';
$menu9 = 'pratos';


  //RECUPERAR OS DADOS DO USUÁRIO
$id_usuario = $_SESSION['id'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '".$id_usuario."'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
  $nome_usu   = $res[0]['nome'];
  $cpf_usu    = $res[0]['cpf'];
  $email_usu  = $res[0]['email'];
  $senha_usu  = $res[0]['senha'];
  $nivel_usu  = $res[0]['nivel'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Administrativo</title>
  <link rel="shortcut icon" href="../img/icone2.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="../vendor/css/style.css">

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../vendor/DataTables/datatables.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="../img/logo.png" width="150"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="index.php?page=<?php echo $menu1; ?>">Home</a>
          </li>
          <li class="nav-item">
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pessoas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu2; ?>">Usuários</a></li>
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu3; ?>">Funcionários</a></li>
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu6; ?>">Fornecedores</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu4; ?>">Cargos</a></li>
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu7; ?>">Categorias</a></li>
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu5; ?>">Mesas</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Produtos / Pratos</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu8; ?>">Produtos</a></li>
              <li><a class="dropdown-item" href="index.php?page=<?php echo $menu9; ?>">Pratos</a></li>
            </ul>
          </li>
        </ul>
        <ul class="d-flex">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $nome_usu;?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#perfil">Editar Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-3">
    <?php 
      if(@$_GET['page'] == $menu1){
        require_once($menu1.'.php');
      }else if(@$_GET['page'] == $menu2){
        require_once($menu2.'.php');
      }else if(@$_GET['page'] == $menu3){
        require_once($menu3.'.php');
      }else if(@$_GET['page'] == $menu4){
        require_once($menu4.'.php');
      }else if(@$_GET['page'] == $menu5){
        require_once($menu5.'.php');
      }else if(@$_GET['page'] == $menu6){
        require_once($menu6.'.php');
      }else if(@$_GET['page'] == $menu7){
        require_once($menu7.'.php');
      }else if(@$_GET['page'] == $menu8){
        require_once($menu8.'.php');
      }else if(@$_GET['page'] == $menu9){
        require_once($menu9.'.php');
      }else{
        require_once($menu1.'.php');
      }
     ?>
  </div>


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-perfil">
        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome_perfil" placeholder="Nome" name="nome_perfil" value="<?php echo $nome_usu; ?>">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" class="form-control" id="email_perfil" placeholder="email@seuemail.com.br" name="email_perfil" value="<?php echo $email_usu; ?>">
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf_perfil" placeholder="000.000.000-00" name="cpf_perfil" maxlength="14" value="<?php echo $cpf_usu; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha_perfil" placeholder="Senha" name="senha_perfil" value="<?php echo $senha_usu; ?>">
              </div>
              <input type="hidden" id="id_perfil" name="id_perfil" value="<?php echo $id_usuario; ?>">
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nivel</label>
            <select class="form-select" aria-label="Default select example" name="nivel-perfil" <?php if($nivel_usu != 'Admin'){echo 'disabled="disabled"';} ?>>
              <option value="Admin" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Administrador</option>
              <option value="Recep" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Recepcionista</option>
              <option value="Garcom" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Garçom</option>
              <option value="Chef" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Chefe</option>
            </select>
          </div>
          <small><div align="center" id="mensagem-perfil"></div></small>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn-fechar-perfil">Fechar</button>
            <button type="submit" class="btn btn-success">Gravar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "ordering": false
    });
  } );
</script>  
</body>
</html>