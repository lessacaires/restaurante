<?php 
require_once("../conexao.php");

$query = $pdo->query("SELECT * FROM fornecedores ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$id_excluir = $res[0]['id'];
?>

<?php $pagina = 'fornecedores'; ?>

<a href="index.php?page=<?php echo $pagina?>&funcao=novo" type="button" class="btn btn-secondary mt-2 mb-4">Novo Fornecedor</a>

<table id="example" class="display table-hover table-sm my-4 mx-2" style="width:100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Produto</th>
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
                <td><?php echo $res[$i]['telefone']; ?></td>
                <td><?php echo $res[$i]['produto']; ?></td>
                <td><?php echo $data ?></td>
                <td>
                    <a href="index.php?page=<?php echo $pagina?>&funcao=editar&id=<?php echo $res[$i]['id'];?>" type="button" class="text-light"><i class="bi bi-pencil-square text-primary"></i></a>
                    <a href="index.php?page=<?php echo $pagina?>&funcao=excluir&id=<?php echo $res[$i]['id'];?>"><i class="bi bi-trash text-danger"></i></a>
                    <a href="" onclick="dados(
                        '<?php echo $res[$i]['nome']; ?>',
                        '<?php echo $res[$i]['email']; ?>',
                        '<?php echo $res[$i]['telefone']; ?>',
                        '<?php echo $res[$i]['endereco']; ?>'
                        '<?php echo $res[$i]['produto']; ?>'
                        )" title="Ver informações"><i class="bi bi-info-circle-fill text-secondary"></i></a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>
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
                $query = $pdo->query("SELECT * FROM fornecedores WHERE id = '$id'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $total_reg = @count($res);
                $nome         = $res[0]['nome'];
                $email        = $res[0]['email'];
                $telefone     = $res[0]['telefone'];
                $endereco     = $res[0]['endereco'];
                $produto        = $res[0]['produto'];
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
                            <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" placeholder="(00)0 0000-0000" name="telefone" value="<?php echo @$telefone; ?>">
                        </div>
                    </div> 
                    <div class="col-4">  
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" placeholder="Digite aqui o seu endereço" name="endereco" value="<?php echo @$endereco; ?>">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Produto</label>
                                <input type="text" class="form-control" id="produto" placeholder="Digite aqui o seu produto" name="produto" value="<?php echo @$produto; ?>">
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                        <small><div align="center" id="mensagem"></div></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                        <button type="submit" class="btn btn-success">Gravar</button>
                    </div>
                </div>
            </form>
        </div>


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
                            <input type="hidden" id="id-excluir" name="id-excluir" value="<?php echo $id_excluir;?>">
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
        <!-- MODAL PARA APRESENTAR REGISTRO -->
        <!-- Modal -->
        <div class="modal fade" id="modal-dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="nome_registro"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <span><b>Nome: </b><span id="nome_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Email: </b><span id="email_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Telefone: </b><span id="telefone_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Endereço: </b><span id="endereco_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Produto: </b><span id="produto_registro"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
                //SCRIPT PARA CHAMAR MODAL
        if(@$_GET['funcao'] == 'novo'){?>
            <script type="text/javascript">
                var myModal = new bootstrap.Modal(document.getElementById('cadastro'),{
                    backdrop: 'static'
                })

                myModal.show();
            </script>
        <?php } ?>
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
        <!-- FIM DA CAHAMADA DA MODAL -->

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
                    $('#mensagem').addClass('text-danger');
                            //window.location="index.php?page="+pag;
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
  <script type="text/javascript">
function dados(nome, cpf, email, telefone, cargo, endereco){
    event.preventDefault();
    var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {
                    
                });

    myModal.show();
    $('#nome_registro').text(nome);
    $('#cpf_registro').text(cpf);
    $('#email_registro').text(email);
    $('#telefone_registro').text(telefone);
    $('#cargo_registro').text(cargo);
    $('#endereco_registro').text(endereco);
}
</script>