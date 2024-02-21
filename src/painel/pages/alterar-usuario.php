<?php
	verificaPermissaoMenu(2);

?>
<?php

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$usuario = Painel::select('tb_usuarios','id = ?',array($id));


	}else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}

?>

<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;" class="fa fa-pen"></i> Alterar Usuário</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 

			if(isset($_POST['acao'])){
				
				echo "<br/>";
					if(Painel::update_user($_POST)){
					
						Painel::alert('sucesso',' O usuário foi alterado com sucesso!');
						$usuario = Painel::select('tb_usuarios','id = ?',array($id));
						

					}else{
						Painel::alert('erro',' Esse E-mail já está cadastrado!');
					}
					
				}
		?>	





	<?php 
	$user = $usuario['Empresa'];
	
	echo "<br/>";
	echo $usuario['Empresa'];
	echo "<br/>";





	$explode = explode(', ',$user);
	




	?>





		<div class="form-group">
			<label>E-mail: </label>
			<input type="email" name="user" value="<?php echo $usuario['user']; ?>" required> 
		</div><!--form-group-->


		<div class="form-group">
			<label>Nome: </label>
			<input maxlength="25" type="text" name="nome" value="<?php echo $usuario['Nome']; ?>"required> 
		</div><!--form-group-->

		<div class="form-group">
			<label>Tipo: </label>
			<select name ="tipo">
				<?php 

					foreach (Painel::$tipos as $key => $value) {
						 //if($key == $usuario['tipo']) echo 'selected';
						 echo '';


					

				?>
				<option <?php if($key == $usuario['tipo'] ) echo 'selected';?> value="<?php echo $key;?>"><?php echo $value?></option>
			<?php }?>
			</select>
		</div><!--form-group-->

		

		<div class="form-group">
			<label>Senha: </label>
			<input type="text" name="password" value="<?php echo $usuario['password']; ?>" required>
		</div><!--form-group-->

		<div class ="form-group">
		<label>Status:</label>
		<select name="status">
			<?php 
				if($usuario['Status'] == "Ativo"){
						echo '<option>Ativo</option>';
						echo '<option>Inativo</option>';
								
				}

				else if($usuario['Status'] == "Inativo"){
						echo '<option>Inativo</option>';
						echo '<option>Ativo</option>';
				}

			?>
		</select>
		</div>
	
		<div class="form-group">
			<label>Empresa: </label>
			<select multiple  name="empresa[]" id="pasta" required>
			<?php  
				$pasta_id = Painel::selectAll('tb_pastas');
				
				
					
				
				

				foreach ($pasta_id as $key => $value) {
					
				foreach ($explode as $separar) {
					
				 if($value['nome'] == $separar){
			          $selected = ' selected';
			          break;
				}else{
					$selected  = '';
				}
				
					
				
				
					
					

					

					
					
			?>

			

			<?php 
			
			}
			
			
			?>
			<option <?php if($value['nome'] == $separar) echo 'selected'; ?> value = "<?php echo $value['nome']?>"><?php echo $value['nome']?></option>
			<?php }

			?>
			

			
		</select>
		</div><!--form-group-->
		
	
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type ="hidden" name = "nome_tabela" value = "tb_usuarios"/>
			<input style="background:#045a88; font-weight: bold;" type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->

	</form>
	


</div>