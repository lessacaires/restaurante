<?php 
require_once("../conexao.php");

$query = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

$nome     = $res[0]['nome'];
$cpf      = $res[0]['cpf'];
$email    = $res[0]['email'];
$senha    = $res[0]['senha'];
$nivel    = $res[0]['nivel'];
$datacad  = $res[0]['datacad'];

?>

<?php $pagina = 'usuarios'; ?>

<a href="index.php?page=<?php echo $pagina?>&funcao=novo" type="button" class="btn btn-secondary mt-2 mb-4">Novo Usuário</a>

<table id="example" class="display mx-2" style="width:100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Senha</th>
            <th>Nível</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php  
        for($i = 0; $i < @count($res); $i ++){
            foreach($res[$i] as $key => $value){ }
                ?>
            <tr>
                <td><?php echo $res[$i]['nome']; ?></td>
                <td><?php echo $res[$i]['email']; ?></td>
                <td><?php echo $res[$i]['cpf']; ?></td>
                <td><?php echo md5($res[$i]['senha']); ?></td>
                <td><?php echo $res[$i]['nivel']; ?></td>
                <td>
                    <a href="index.php?page=<?php echo $pagina?>&funcao=editar&id=<?php echo $res[$i]['id'];?>" type="button" class="text-light"><i class="bi bi-pencil-square text-primary"></i></a>
                    <a href="index.php?page=<?php echo $pagina?>&funcao=excluir&id=<?php echo $res[$i]['id'];?>"><i class="bi bi-trash text-danger"></i></a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>
<!-- MODAL PARA EXCLUIR REGISTRO -->
<!-- Modal -->
<div class="modal fade" id="excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-excluir">
                <div class="modal-body">
                    Tem certeza que dejesa excluir este registro?
                    <input type="hidden" id="id-excluir" name="id-excluir" value="<?php echo $id; ?>">
                </div>
                <small><div align="center" id="mensagem-excluir"></div></small>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <?php if(@$_GET['funcao'] == 'novo'){
            $titulo_modal = 'Inserir Registro';
        }else{
            $titulo_modal = 'Editar Registro';
            $id = @$_GET['id'];
            $query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id'");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            $total_reg = @count($res);
            $nome       = @$res[0]['nome'];
            $cpf        = @$res[0]['cpf'];
            $email      = @$res[0]['email'];
            $senha      = @$res[0]['senha'];
            $nivel      = @$res[0]['nivel'];
            $datacad    = @$res[0]['datacad'];
        } 

        ?>
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form method="post" id="form">
        <div class="modal-body">

            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo @$nome; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo @$email; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" placeholder="000.000.000-00" name="cpf" value="<?php echo @$cpf; ?>">
                    </div>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="Sua senha aqui." name="senha" value="<?php echo @$senha; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-labe l">Nivel</label>
                        <select class="form-select" aria-label="Default select example" name="nivel" <?php if($nivel_usu != 'Admin'){echo 'disabled="disabled"';} ?>>
                          <option value="Admin" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Administrador</option>
                          <option value="Recep" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Recepcionista</option>
                          <option value="Garcom" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Garçom</option>
                          <option value="Chef" <?php if($nivel_usu == 'Admin'){echo 'select="selected"';}else if($nivel_usu == 'Recep'){echo 'select="selected"';}else if($nivel_usu == 'Garcom'){echo 'select="selected"';}else if($nivel_usu == 'Chef'){echo 'select="selected"';}?>>Chefe</option>
                      </select>
                  </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Data Cadastro</label>
                    <input type="text" class="form-control" readonly id="cadastro" placeholder="00/00/0000." name="cadastro" value="<?php echo date($datacad); ?>">
                </div>
            </div>
        </div>
    </div>   
    <small><div align="center" id="mensagem"></div></small>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
        <button type="submit" class="btn btn-success">Gravar</button>
    </div>
</form>
</div>
<!-- Modal -->
<div class="modal fade" id="dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="nome_registro"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <span><b>CPF: </b><span id="cpf_registro"></span></span>
                </div>
                <div class="mb-2">
                    <span><b>Email: </b><span id="email_registro"></span></span>
                </div>
                <div class="mb-2">
                    <span><b>Telefone: </b><span id="telefone_registro"></span></span>
                </div>
                <div class="mb-2">
                    <span><b>Cargo: </b><span id="cargo_registro"></span></span>
                </div>
                <div class="mb-2">
                    <span><b>Endereço: </b><span id="endereco_registro"></span></span>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $('#form').submit(function(){
      event.preventDefault();
      var formData = new FormData(this);
      var pag = "<?=$pagina;?>";
      $.ajax({
        url: pag + "/inserir.php",
        type: "POST",
        data: formData,

        success: function (mensagem){
          $("#mensagem").removeClass()
          if(mensagem.trim() == "Salvo com sucesso!"){
            $('#btn-fechar').click();
            window.location="index.php?page="+pag;
        }else{
            $('#mensagem').addClass('text-success');
        }

        $('#mensagem').text(mensagem);
    },

    cache: false,
    contentType: false,
    processData: false,

    });
  });
</script>
<!-- AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
    $('#form-excluir').submit(function(){
      event.preventDefault();
      var formData = new FormData(this);
      var pag = "<?=$pagina;?>";
      $.ajax({
        url: pag + "/excluir.php",
        type: "POST",
        data: formData,

        success: function (mensagem){
          $("#mensagem-excluir").removeClass()
          if(mensagem.trim() == "Excluido com sucesso!"){
            $('#btn-fechar-excluir').click();
            window.location="index.php?page="+pag
          }else{
            $('#mensagem-excluir').addClass('text-success');
            window.location="index.php?page="+pag;
          }

        $('#mensagem-excluir').text(mensagem);
      },

      cache: false,
      contentType: false,
      processData: false,

      });
    });
</script>
<?php 
  //SCRIPT PARA CHAMADA DA MODAL
if(@$_GET['funcao'] == 'novo'){?>

    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('cadastro'),{backdrop: 'static'})

        myModal.show();
    </script>
<?php }?>
<?php 
  //SCRIPT PARA CHAMADA DA MODAL
if(@$_GET['funcao'] == 'editar'){?>

    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('cadastro'),{backdrop: 'static'})

        myModal.show();
    </script>
<?php }?>
<?php 
  //SCRIPT PARA CHAMADA DA MODAL
if(@$_GET['funcao'] == 'excluir'){?>

    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('excluir'))

        myModal.show();
    </script>
<?php }?>
<!-- FIM DA MODAL PARA EXCLUIR REGISTRO -->
<script type="text/javascript">
    function dados(nome, cpf, email, telefone, cargo, endereco){
        event.preventDefault();
        var myModal = new bootstrap.Modal(document.getElementById('dados'))

        $('#nome_registro').text(nome);
        $('#cpf_registro').text(cpf);
        $('#email_registro').text(email);
        $('#telefone_registro').text(telefone);
        $('#cargo_registro').text(cargo);
        $('#endereco_registro').text(endereco);

        myModal.show();
    }
</script>