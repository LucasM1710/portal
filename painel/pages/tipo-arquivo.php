<?php
	verificaPermissaoMenu(2);
	

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="box-content">
	<h2 style="margin: 10px;"><i style="color:#fa9d23 ; "class="fas fa-file-alt"></i> Selecione o tipo de arquivo que deseja carregar:</h2>
	<br/>
		<div class="botao-add-tipo">
		<br/>
		<a <?php selecionadoMenu('certificado-padrao');?> href="<?php echo INCLUDE_PATH_PAINEL?>certificado-padrao">Certificado de Padrão</a>
		</div>
		<br/>
		<br/>
		<div class="botao-add-tipo">
		<a <?php selecionadoMenu('certificado-calibracao');?> href="<?php echo INCLUDE_PATH_PAINEL?>certificado-calibracao">Certificado de Calibração</a>
		</div>
		<br/>
		<br/>
		<div class="botao-add-tipo">
		<a <?php selecionadoMenu('controle-equipamento');?> href="<?php echo INCLUDE_PATH_PAINEL?>controle-equipamento">Controle de Equipamento</a>
		</div>
		<br/>
		<br/>
		<a style="margin:10px;"<?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas"><i class="fas fa-arrow-left"></i> Voltar</a>
		

</div>
