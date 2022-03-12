<?php 
$pagina = 'produtos'; 
?>

<a href="index.php?page=<?php echo $pagina?>&funcao=novo" type="button" class="btn btn-secondary mt-2 mb-4">Novo Produto</a>

<small>
    <table id="example" class="display table-hover table-sm my-4 mx-2" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>R$ Compra</th>
                <th>R$ Venda</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
                <th>Estoque</th>
                <th>Thumb</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < @count($res); $i ++){
                foreach($res[$i] as $key => $value){ }

                 $id_fornecedor = $res[$i]['fornecedor'];
             	 $id_categoria = $res[$i]['categoria'];
				
				//BUSCAR O NOME FORNECEDOR RELACIONADO
                $query2 = $pdo->query("SELECT * FROM fornecedores WHERE id = '$id_fornecedor'");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $nome_fornecedor = $res2[0]['nome'];

                //BUSCAR O NOME DA CATEGORIA RELACIONADA
                $query3 = $pdo->query("SELECT * FROM categorias WHERE id = '$id_categoria'");
                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                $nome_categoria = $res3[0]['nome'];

                ?>
                <tr>
                    <td><?php echo $res[$i]['nome']; ?></td>
                    <td><?php echo $res[$i]['descricao']; ?></td>
                    <td><?php echo $res[$i]['valor_compra']; ?></td>
                    <td><?php echo $res[$i]['valor_venda']; ?></td>
                    <td><?php echo $nome_categoria; ?></td>
                    <td><?php echo $nome_fornecedor; ?></td>
                    <td><?php echo $res[$i]['estoque']; ?></td>
                    <td><?php echo $res[$i]['imagem']; ?></td>
                    <td>
                        <a href="index.php?page=<?php echo $pagina?>&funcao=editar&id=<?php echo $res[$i]['id'];?>" type="button" class="text-light"><i class="bi bi-pencil-square text-primary"></i></a>
                        <a href="index.php?page=<?php echo $pagina?>&funcao=excluir&id=<?php echo $res[$i]['id'];?>"><i class="bi bi-trash text-danger"></i></a>
                        <a href="" onclick="dados(
                            '<?php echo $res[$i]['nome']; ?>',
                            '<?php echo $res[$i]['descricao']; ?>',
                            '<?php echo $res[$i]['valor_compra']; ?>',
                            '<?php echo $res[$i]['valor_venda']; ?>',
                            '<?php echo $nome_categoria; ?>',
                            '<?php echo $nome_fornecedor; ?>',
                            '<?php echo $res[$i]['estoque']; ?>',
                            '<?php echo $res[$i]['imagem']; ?>'
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
                        $query = $pdo->query("SELECT * FROM produtos WHERE id = '$id'");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        $total_reg 			= @count($res);
                        $nome         		= $res[0]['nome'];
                        $descricao          = $res[0]['descricao'];
                        $valor_compra       = $res[0]['valor_compra'];
                        $valor_venda     	= $res[0]['valor_venda'];
                        $categoria        	= $res[0]['categoria'];
                        $fornecedor     	= $res[0]['fornecedor'];
                        $estoque      		= $res[0]['estoque'];
                        $imagem      		= $res[0]['imagem'];
                    } 

                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form method="post" id="form">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" placeholder="Digite aqui o nome do seu produto" name="nome" value="<?php echo @$nome; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="form6Example7" rows="4" placeholder="Digite aqui a descrição do seu produto"><?php echo @$descricao; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">R$ Compra</label>
                                    <input type="text" class="form-control" id="valor_compra" placeholder="Digite aqui o valor de compra do seu produto" name="vslor_compra" value="<?php echo @$valor_compra; ?>">
                                </div>
                            </div>
                        
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">R$ Venda</label>
                                    <input type="text" class="form-control" id="valor_venda" placeholder="Digite aqui o valor de venda do seu produto" name="valor_venda" value="<?php echo @$valor_venda; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Categoria</label>
                                    <select class="form-select" aria-label="Default select example" name="cargo"?>>
                                        <option>Selecione uma das opções</option>
                                        <?php 
                                        $query = $pdo->query("SELECT * FROM categorias ORDER BY nome ASC");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = @count($res); 
                                        for($i = 0; $i < @count($res); $i ++){
                                            foreach($res[$i] as $key => $value){ }

                                            $id_categoria = $res[$i]['id'];
                                            $nome_categoria = $res[$i]['nome'];

                                            ?>
                                            <option <?php if( @$id_categoria == @$categoria){echo "selected='selected' ";} ?>value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Fornecedor</label>
                                    <select class="form-select" aria-label="Default select example" name="cargo"?>>
                                        <option>Selecione uma das opções</option>
                                        <?php 
                                        $query = $pdo->query("SELECT * FROM fornecedores ORDER BY nome ASC");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = @count($res); 
                                        for($i = 0; $i < @count($res); $i ++){
                                            foreach($res[$i] as $key => $value){ }

                                            $id_fornecedor = $res[$i]['id'];
                                            $nome_fornecedor = $res[$i]['nome'];

                                            ?>
                                            <option <?php if( @$id_fornecedor == @$fornecedor){echo "selected='selected' ";} ?>value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome']; ?></option>
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
                            <span><b>Descrição: </b><span id="descricao_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>R$ Compra: </b><span id="valor_compra_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>R$ Venda: </b><span id="valor_venda_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Categoria: </b><span id="categoria_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Fornecedor: </b><span id="fornecedor_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Estoque: </b><span id="estoque_registro"></span></span>
                        </div>
                        <div class="mb-2">
                            <span><b>Imagem: </b><span id="imagem_registro"></span></span>
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
        function dados(nome, descricao, valor_compra, valor_venda, categoria, fornecedor, estoque, imagem){
            event.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('modal-dados'))

            $('#nome_registro').text(nome);
            $('#descrica_registro').text(descrica);
            $('#valor_compra_registro').text(valor_compra);
            $('#valor_venda_registro').text(valor_venda);
            $('#categoria_registro').text(categoria);
            $('#foencedor_registro').text(fornecedor);
            $('#estoque_registro').text(estoque);
            $('#imagem_registro').text(imagem);

            myModal.show();
        }

    </script>