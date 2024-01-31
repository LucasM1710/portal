<?php
	verificaPermissaoMenu(1);

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
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;"class="fa fa-pen"></i> Visualizar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label>E-mail: <?php echo $usuario['user']; ?></label>
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome: <?php echo $usuario['Nome']; ?></label>
		</div><!--form-group-->

		<div class="form-group">
			<label>Tipo: <?php
				if ($usuario['tipo'] == 1){
					echo "Cliente";
				}
				else{
					echo "Administrador";
				}
			 	

			 ?></label>
				
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha: <?php echo $usuario['password']; ?></label>
		</div><!--form-group-->

		<div class="form-group">
			<label>Status: <?php echo $usuario['Status']; ?></label>
		</div><!--form-group-->

		<div class="form-group">
			<label>Empresa: <?php echo $usuario['Empresa']; ?></label>
		</div><!--form-group-->
	</form>

		<div class="botao-add">
		<a <?php selecionadoMenu('adicionar-usuario');?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario"><i class="fas fa-user-plus"></i> Adicionar Usuário</a>
		</div>
		<br/>
		<br/>
		<div class="botao-add">
		<a <?php selecionadoMenu('alterar-usuario');?> href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-usuario?id=<?php echo $usuario['id'];?>"><i class="fa fa-pen"></i> Alterar Usuário</a>
		</div>


	</form>
	


</div>