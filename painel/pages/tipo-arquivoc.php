<?php
	verificaPermissaoMenu(2);
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$arquivo = Painel::select('tb_pastas','id = ?',array($id));

	}
	else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="box-content">
		<h2 style="margin: 10px;"><i style="color:#fa9d23 ; "class="fas fa-file-alt"></i> Selecione o tipo de arquivo que deseja carregar:</h2>
		<br/>
		<div class="botao-add-tipo">
		<a <?php selecionadoMenu('certificado-padraoc');?> href="<?php echo INCLUDE_PATH_PAINEL?>certificado-padraoc?id=<?php echo $arquivo['id']; ?>">Certificado de Padrão</a>
		</div>
		<br/>
		<br/>
		<div class="botao-add-tipo">
		<a <?php selecionadoMenu('certificado-calibracaoc');?> href="<?php echo INCLUDE_PATH_PAINEL?>certificado-calibracaoc?id=<?php echo $arquivo['id']; ?>">Certificado de Calibração</a>
		</div>
		<br/>
		<br/>
		<div class="botao-add-tipo">
		<a <?php selecionadoMenu('controle-equipamentoc');?> href="<?php echo INCLUDE_PATH_PAINEL?>controle-equipamentoc?id=<?php echo $arquivo['id']; ?>">Controle de Equipamento</a>
		</div>
		<br/>
		<br/>
		<a <?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas"><i class="fas fa-arrow-left"></i> Voltar</a>
		

</div>
