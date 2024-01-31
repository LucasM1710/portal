<?php
	verificaPermissaoMenuC(1);

	if(isset($_GET['loggout'])){
		Painel::loggout();
	}


?>
<div class="box-content">
<h2><i style=" margin:10px; color: #fa9d23;"class="fas fa-tools"></i> Nossos serviços</h2>
<br/>
<a style="margin:10px; font-size:16px; text-decoration: none;" target="_blank" href="../Catálogos/Alimentos e Bebidas.pdf"><i class="fas fa-hand-point-right"></i> Alimentos e Bebidas</a>
<br/>
<br/>
<a style="margin:10px; font-size:16px; text-decoration: none;" target="_blank" href="../Catálogos/Indústria Química.pdf"><i class="fas fa-hand-point-right"></i> Indústria Química</a>
<br/>
<br/>
<a style="margin:10px; font-size:16px; text-decoration: none;" target="_blank" href="../Catálogos/Saneamento e Meio Ambiente.pdf"><i class="fas fa-hand-point-right"></i> Saneamento e Meio Ambiente</a>
	
</div>