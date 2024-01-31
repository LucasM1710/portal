<?php
	verificaPermissaoMenu(2);

?>
<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i  style="color:#fa9d23;" class="fas fa-user-plus"></i> Adicionar Usuário</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$tipo = $_POST['tipo'];
				//$email = $_POST['email'];
				$senha = $_POST['senha'];
				$status = $_POST['status'];
				@$empresa = $_POST['empresa'];
				
				

				if($nome == ''){
					Painel::alert('erro',' O campo nome está vazio!');
				}else if($senha == ''){
					Painel::alert('erro',' Insira uma senha');
				}
				else if($empresa == ''){
					Painel::alert('erro',' Você precisa adicionar uma empresa');
				}
				else if(usuario::userExists($login)){
					Painel::alert('erro',' O E-mail já existe, selecione outro por favor!');
				}
			
					//Podemos cadastrar!
	
				else{
						//Apenas cadastrar no banco de dados!
						//$novo_nome = Painel::uploadFile($novo_nome);
						$usuario = new Usuario();
						$usuario->cadastrarUsuario($login,$nome,$tipo,$senha,$status,$empresa);
						Painel::alert('sucesso',' O cadastro foi feito com sucesso!');
					
					}
				}
			

				
			
		?>


		<div class="form-group">
			<label>E-mail: </label>
			<input type="email" name="login" maxlength="99" required>
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome: </label>
			<input type="text" name="nome" maxlength="40" required> 
		</div><!--form-group-->

		<div class="form-group">
			<label>Tipo: </label>
			<select name ="tipo">
				<?php 

					foreach (Painel::$tipos as $key => $value) {
				
						 echo '<option value="'.$key.'">'.$value.'</option>';


					}

				?>

			</select>
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha: </label>
			<input type="text" name="senha" required>
		</div><!--form-group-->

		<div class ="form-group">
		<label>Status:</label>
		<select name="status">
			<option>Ativo</option>
			<option>Inativo</option>
		</select>
		</div>



		<div class="form-group">
			<label>Empresa: </label>
			<select multiple id="pasta" name="empresa[]" required>
			<?php  
				$empresa = Painel::selectAll('tb_pastas');
				foreach ($empresa as $key => $value) {
					
				
			?>
			<option <?php if($value['nome'] == @$_POST['empresa']) echo 'selected'; ?> value = "<?php echo $value['nome']?>"><?php echo $value ['nome'];?></option>
			<?php }?>
		</select>
		</div><!--form-group-->
		
		<div class="form-group">
			<input style="background:#045a88; font-weight: bold;" type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->

	</form>
	


</div>
