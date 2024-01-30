<?php
	verificaPermissaoMenu(2);

?>
<?php

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$pasta = Painel::select('tb_pastas','id = ?',array($id));

	}else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}

?>

<div class="box-content">
	<h2><i class="fa fa-pen"></i> Alterar Pasta</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
					if(Painel::update($_POST)){

						Painel::alert('sucesso',' A pasta foi alterada com sucesso!');
						$pasta = Painel::select('tb_pastas','id = ?',array($id));
					}else{
						Painel::alert('erro',' Campos vázios não são permitidos');
					}
					
				}
		?>	

		<div class="form-group">
			<label>Nome: </label>
			<input type="text" name="nome" value="<?php echo $pasta['nome']; ?>">
		</div><!--form-group-->
		<div class ="form-group">
		<label>Status:</label>
		<select name="status">
			<?php 
				if($pasta['status'] == "Ativo"){
						echo '<option>Ativo</option>';
						echo '<option>Inativo</option>';
								
				}
				else if($pasta['status'] == "Inativo"){
					echo '<option>Inativo</option>';
					echo '<option>Ativo</option>';
				}

			?>
		</select>
		</div>
	
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type ="hidden" name = "nome_tabela" value = "tb_pastas"/>
			<input style="background: #00284f;"type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>
	


</div>