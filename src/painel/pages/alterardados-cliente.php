<?php
	verificaPermissaoMenuC(1);

	if(isset($_GET['loggout'])){
		Painel::loggout();
	}

		if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$usuario = Painel::select('tb_usuarios','id = ?',array($id));

	}else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}

?>
<div class="box-content">
	<h2><i class="fa fa-pen"></i> Alterar Dados</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
					if(Painel::update($_POST)){

						Painel::alert('sucesso',' O usuário foi alterado com sucesso!');
						$usuario = Painel::select('tb_usuarios','id = ?',array($id));
					}else{
						Painel::alert('erro',' Campos vázios não são permitidos');
					}
					
				}
		?>	

	
	<div class="form-group">
			<label>Login: </label>
			<input type="text" name="user" maxlength="15" value="<?php echo $usuario['user']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome: </label>
			<input type="text" name="nome" value="<?php echo $usuario['Nome']; ?>"> 
		</div><!--form-group-->

		<div class="form-group">
			<label>E-mail: </label>
			<input type="text" name="email" value="<?php echo $usuario['Email']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha: </label>
			<input type="text" name="password" value="<?php echo $usuario['password']; ?>">
		</div><!--form-group-->


		<div class="form-group">
			<label>Cnpj: </label>
			<input type="text" name="cnpj" value="<?php echo $usuario['Cnpj']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Telefone: </label>
			<input type="text" name="telefone" value="<?php echo $usuario['Telefone']; ?>">
		</div><!--form-group-->
		
		<div class="form-group">
			<label>Endereço: </label>
			<input type="text" name="endereco" value="<?php echo $usuario['Endereco']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Cidade: </label>
			<input type="text" name="cidade" value="<?php echo $usuario['Cidade']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Estado: </label>
			<select id="pasta2" name="estado">
			<?php  
				$estado = Painel::selectAll('tb_estado');
				foreach ($estado as $key => $value) {
				
				
			?>

			<option <?php if($value['nome'] == $usuario['Estado']) echo 'selected'; ?> value = "<?php echo $value['nome']?>"><?php echo $value ['nome'];?></option>
			<?php }?>
		</select>
		</div><!--form-group-->
	
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type ="hidden" name = "nome_tabela" value = "tb_usuarios"/>
			<input style="background: #00284f;"type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>
	


</div>