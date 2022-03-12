<?php 
$pagina = 'funcionarios'; 
?>

<a href="index.php?page=<?php echo $pagina?>&funcao=novo" type="button" class="btn btn-secondary mt-2 mb-4">Novo Funcionário</a>

<small>
    <table id="example" class="display table-hover table-sm my-4 mx-2" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Endereço</th>
                <th>Data cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $pdo->query("SELECT * FROM funcionarios ORDER BY id DESC");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < @count($res); $i ++){
                foreach($res[$i] as $key => $value){ }

                    $id_cargo = $res[$i]['cargo'];
//BUSCAR O NOME RELACIONADO
                $query2 = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $nome_cargo = $res2[0]['nome'];

                $data = implode('/', array_reverse(explode('-', $res[$i]['datacad'])));

                ?>
                <tr>
                    <td><?php echo $res[$i]['nome']; ?></td>
                    <td><?php echo $res[$i]['email']; ?></td>
                    <td><?php echo $res[$i]['cpf']; ?></td>
                    <td><?php echo $res[$i]['telefone']; ?></td>
                    <td><?php echo $nome_cargo; ?></td>
                    <td><?php echo $res[$i]['endereco']; ?></td>
                    <td><?php echo $data ?></td>
                    <td>
                        <a href="index.php?page=<?php echo $pagina?>&funcao=editar&id=<?php echo $res[$i]['id'];?>" type="button" class="text-light"><i class="bi bi-pencil-square text-primary"></i></a>
                        <a href="index.php?page=<?php echo $pagina?>&funcao=excluir&id=<?php echo $res[$i]['id'];?>"><i class="bi bi-trash text-danger"></i></a>
                        <a href="" onclick="dados(
                            '<?php echo $res[$i]['nome']; ?>',
                            '<?php echo $res[$i]['cpf']; ?>',
                            '<?php echo $res[$i]['email']; ?>',
                            '<?php echo $res[$i]['telefone']; ?>',
                            '<?php echo $nome_cargo; ?>',
                            '<?php echo $res[$i]['endereco']; ?>'
                            )" title="Ver informações"><i class="bi bi-info-circle-fill text-secondary"></i></a>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </small>

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
                        $query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id'");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        $total_reg = @count($res);
                        $nome         = $res[0]['nome'];
                        $cpf          = $res[0]['cpf'];
                        $email        = $res[0]['email'];
                        $telefone     = $res[0]['telefone'];
                        $cargo        = $res[0]['cargo'];
                        $endereco     = $res[0]['endereco'];
                        $datacad      = $res[0]['datacad'];
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
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" placeholder="(00)0 0000-0000" name="telefone" value="<?php echo @$telefone; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Data Cadastro</label>
                                    <input type="text" readonly class="form-control" id="datacad" name="datacad" value="<?php echo date('Y-m-d h:i:s'); ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Cargo</label>
                                    <select class="form-select" aria-label="Default select example" name="cargo"?>>
                                        <option>Selecione uma das opções</option>
                                        <?php 
                                        $query = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = @count($res); 
                                        for($i = 0; $i < @count($res); $i ++){
                                            foreach($res[$i] as $key => $value){ }

                                                $id_cargo = $res[$i]['id'];
                                            $nome_cargo = $res[$i]['nome'];

                                            ?>
                                            <option <?php if( @$id_cargo == @$cargo){echo "selected='selected' ";} ?>value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>   
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" placeholder="Digite aqui o seu endereço" name="endereco" value="<?php echo $endereco; ?>">
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                        <small><div align="center" id="mensagem"></div></small>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
                            <button type="submit" class="btn btn-success">Gravar</button>
                        </div>
                    </form>
                </div>
            </div>
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
        <!-- FECHAMENTO DA MODAL PARA EXCLUIR REGISTRO -->

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
    </script>
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
                        window.location="index.php?page="+pag;
                    }

                    $('#mensagem').text(mensagem);
                },

                cache: false,
                contentType: false,
                processData: false

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
                processData: false

            });
        });
    </script>
    <script type="text/javascript">
        function dados(nome, cpf, email, telefone, cargo, endereco){
            event.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('modal-dados'))

            $('#nome_registro').text(nome);
            $('#cpf_registro').text(cpf);
            $('#email_registro').text(email);
            $('#telefone_registro').text(telefone);
            $('#cargo_registro').text(cargo);
            $('#endereco_registro').text(endereco);

            myModal.show();
        }

    </script>