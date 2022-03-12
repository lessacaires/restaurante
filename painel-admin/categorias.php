<?php 
require_once("../conexao.php");

$query = $pdo->query("SELECT * FROM categorias ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
?>

<?php $pagina = 'categorias'; ?>
<div class="marca-dagua">
<a href="index.php?page=<?php echo $pagina?>&funcao=novo" type="button" class="btn btn-secondary mt-2 mb-4">Nova Categoria</a>
<table id="example" class="display table-hover table-sm my-4 mx-2" style="width:100%">
    <thead>
        <tr>
            <th>Nome</th>
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
                <td>
                	<a href="index.php?page=<?php echo $pagina?>&funcao=editar&id=<?php echo $res[$i]['id'];?>" type="button" class="text-light"><i class="bi bi-pencil-square text-primary"></i></a>
                	<a href="index.php?page=<?php echo $pagina?>&funcao=excluir&id=<?php echo $res[$i]['id'];?>"><i class="bi bi-trash text-danger"></i></a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>

</script>

<!-- Modal -->
<div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<?php if(@$_GET['funcao'] == 'novo'){
					$titulo_modal = 'Inserir Registro';
				}else{
					$titulo_modal = 'Editar Registro';
					$id = @$_GET['id'];
					$query = $pdo->query("SELECT * FROM categorias WHERE id = '$id'");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$total_reg = @count($res);
					$nome = @$res[0]['nome'];
				} 

				?>
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal; ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nome</label>
						<input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo @$nome; ?>">
					</div>
					<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
				</div>
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
					Deseja realmente excluir este registro?
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
            $('#mensagem-excluir').addClass('text-danger');
            //window.location="index.php?page="+pag;
          }

        $('#mensagem-excluir').text(mensagem);
      },

      cache: false,
      contentType: false,
      processData: false,

      });
    });
</script>