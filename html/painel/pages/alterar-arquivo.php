<?php
	verificaPermissaoMenu(2);

?>
<?php

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$arquivo = Painel::select('tb_arquivos','id = ?',array($id));

	}else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}

?>

<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;" class="fas fa-edit"></i> Alterar Arquivo</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
					if(Painel::update($_POST)){

						Painel::alert('sucesso',' O arquivo foi alterado com sucesso!');
						$arquivo = Painel::select('tb_arquivos','id = ?',array($id));
					}else{
						Painel::alert('erro',' Campos vázios não são permitidos');
					}
					
				}
		?>	

	
		<div class="form-group">
			<label>Arquivo: </label>
			<input type="text" name="titulo" value="<?php echo $arquivo['titulo']; ?>">
		</div><!--form-group-->


		<div class ="form-group">
		<label>Descrição:</label>
		<select name="descricao" id="pasta3">
		    <?php 
				if($arquivo['descricao'] == "Certificado de Calibração"){
					echo '<option>Certificado de Calibração</option>';
					echo '<option>Certificado do Padrão</option>';
					echo '<option>Controle de Equipamentos</option>';
								
				}
				else if($arquivo['descricao'] == "Certificado do Padrão"){
					echo '<option>Certificado do Padrão</option>';
					echo '<option>Certificado de Calibração</option>';
					echo '<option>Controle de Equipamentos</option>';
				}
				else if($arquivo['descricao'] == "Controle de Equipamentos"){
					echo '<option>Controle de Equipamentos</option>';
					echo '<option>Certificado do Padrão</option>';
					echo '<option>Certificado de Calibração</option>';
				}

			?>
		</select>
		</div>

			<div class="form-group">
			<label>Pastas: </label>
			<select name="pasta" id="pasta">
			<?php  
				$pasta_id = Painel::selectAll('tb_pastas');
						
				

				foreach ($pasta_id as $key => $value) {
					
			
					
			?>

			

		
			
			?>
			<option <?php if($value['nome'] == $arquivo['pasta']) echo 'selected'; ?> value = "<?php echo $value['nome']?>"><?php echo $value['nome']?></option>
			<?php }

			?>
			

			
		</select>
		</div><!--form-group-->


		
	
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type ="hidden" name = "nome_tabela" value = "tb_arquivos"/>
			<input style=" background: #045a88; font-weight: bold;"type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->

	</form>
	


</div>