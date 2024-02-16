<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Certificados Área Do Cliente | ER Analítica</title>

	<meta charset="utf-8">
	<meta name="viewport" content= "width=device-width, initial-scale=1.0">
	<meta name="description" content="Consulte seus certificados emitidos e os padrões utilizados na sua calibração através da área do cliente.">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/all.css" > 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
	<link href="<?php echo INCLUDE_PATH_PAINEL?>css/style.css" rel="stylesheet"/>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="icon" href="../Img/logo3.png" type="image/x-icon" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SGEXYHZ2C9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-SGEXYHZ2C9');
    </script>
    <style>.cookieConsentContainer{z-index:999;width:350px;min-height:20px;box-sizing:border-box;padding:30px 30px 30px 30px;background:#232323;overflow:hidden;position:fixed;bottom:30px;right:30px;display:none}.cookieConsentContainer .cookieTitle a{font-family:OpenSans,arial,sans-serif;color:#fff;font-size:22px;line-height:20px;display:block}.cookieConsentContainer .cookieDesc p{margin:0;padding:0;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:13px;line-height:20px;display:block;margin-top:10px}.cookieConsentContainer .cookieDesc a{font-family:OpenSans,arial,sans-serif;color:#fff;text-decoration:underline}.cookieConsentContainer .cookieButton a{display:inline-block;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:14px;font-weight:700;margin-top:14px;background:#000;box-sizing:border-box;padding:15px 24px;text-align:center;transition:background .3s}.cookieConsentContainer .cookieButton a:hover{cursor:pointer;background:#3e9b67}@media (max-width:980px){.cookieConsentContainer{bottom:0!important;left:0!important;width:100%!important}}</style>
</head>

<body>
 
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N49WCPC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    
	<base base="<?php echo INCLUDE_PATH_PAINEL; ?>"/>
	
	<div class="menu">

		<div class="menu-wraper">
		<br/>
		<div class="logo">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 587.65 332.25"><defs><style>.cls-1{fill:#888787;}.cls-2{fill:#005a85;}.cls-3{fill:#009edd;}</style></defs><g id="Analítica"><path class="cls-1" d="M159,457.64a37.74,37.74,0,0,0,.56,7.05H153.3l-.63-3.71h-.24c-2.07,2.31-6.28,4.37-11.76,4.37-7.78,0-11.75-4.19-11.75-8.44,0-7.11,8.26-11,23.11-10.93v-.61c0-2.43-.87-6.86-8.74-6.8a22.84,22.84,0,0,0-10.08,2.19l-1.59-3.59a30.92,30.92,0,0,1,12.71-2.55c11.83,0,14.69,6.14,14.69,12Zm-6.83-8c-7.63-.12-16.28.91-16.28,6.62,0,3.53,3,5.11,6.51,5.11,5.08,0,8.34-2.43,9.45-4.92a4.32,4.32,0,0,0,.32-1.71Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M209.93,443.24a79,79,0,0,0-.32-7.95h6.2l.39,4.8h.16c1.91-2.74,6.36-5.47,12.71-5.47,5.32,0,13.58,2.43,13.58,12.51v17.56h-7V447.74c0-4.74-2.3-8.75-8.89-8.75-4.53,0-8.1,2.49-9.38,5.47a6.39,6.39,0,0,0-.47,2.49v17.74h-7Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M320.81,457.64a37.79,37.79,0,0,0,.55,7.05h-6.27l-.64-3.71h-.24c-2.06,2.31-6.27,4.37-11.75,4.37-7.79,0-11.76-4.19-11.76-8.44,0-7.11,8.26-11,23.12-10.93v-.61c0-2.43-.88-6.86-8.74-6.8A22.86,22.86,0,0,0,295,440.76l-1.59-3.59a31,31,0,0,1,12.71-2.55c11.84,0,14.7,6.14,14.7,12Zm-6.84-8c-7.62-.12-16.28.91-16.28,6.62,0,3.53,3,5.11,6.51,5.11,5.09,0,8.34-2.43,9.46-4.92a4.49,4.49,0,0,0,.31-1.71Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M371.71,421.56h7v43.13h-7Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M444.31,422.59l-9.7,8.69h-4.92l7-8.69Zm-14.14,42.1v-29.4h7v29.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M496.88,428.24v7.05h10v4.07h-10v15.79c0,3.64,1.35,5.71,5.24,5.71a16.55,16.55,0,0,0,4.06-.37l.31,4.07a24.14,24.14,0,0,1-6.19.73,11.79,11.79,0,0,1-7.55-2.24c-1.91-1.64-2.7-4.26-2.7-7.72v-16h-6v-4.07h6v-5.41Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M557.8,430.31c-2.54,0-4.21-1.52-4.21-3.28s1.74-3.34,4.37-3.34,4.28,1.46,4.28,3.34-1.66,3.28-4.36,3.28Zm-3.34,34.38v-29.4h7v29.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M640.16,463.59a34.19,34.19,0,0,1-11,1.7c-11.6,0-19.14-6-19.14-15s8.1-15.67,20.65-15.67a27.78,27.78,0,0,1,9.69,1.58l-1.59,4.07a21.46,21.46,0,0,0-8.1-1.4c-8.82,0-13.58,5-13.58,11.12,0,6.8,5.71,11,13.34,11a25.24,25.24,0,0,0,8.58-1.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M715.14,457.64a38.66,38.66,0,0,0,.55,7.05h-6.27l-.64-3.71h-.24c-2.06,2.31-6.27,4.37-11.75,4.37-7.79,0-11.76-4.19-11.76-8.44,0-7.11,8.26-11,23.12-10.93v-.61c0-2.43-.88-6.86-8.74-6.8a22.89,22.89,0,0,0-10.09,2.19l-1.59-3.59a31,31,0,0,1,12.71-2.55c11.84,0,14.7,6.14,14.7,12Zm-6.83-8c-7.63-.12-16.29.91-16.29,6.62,0,3.53,3,5.11,6.51,5.11,5.09,0,8.35-2.43,9.46-4.92a4.32,4.32,0,0,0,.32-1.71Z" transform="translate(-128.05 -133.1)"/></g><g id="R"><path class="cls-2" d="M649.14,267.35c2,0,8.5-.53,8.5-.53a67.18,67.18,0,0,0-1-132.9,81.51,81.51,0,0,0-9.35-.66H438v32.66h212a28.57,28.57,0,0,1,3.29.37c16.55,2.72,29.18,18,29.18,35.29A34.88,34.88,0,0,1,653.2,236a28.4,28.4,0,0,1-4.79.44H487.2v31.71L678.37,372.26H713.8L521.2,267.35Z" transform="translate(-128.05 -133.1)"/></g><g id="E"><path class="cls-3" d="M170,290.4h0a86.18,86.18,0,0,1-7.58-24H128.92a120.6,120.6,0,0,0,4.64,22.13h-.06c.18.55.38,1.1.56,1.65l.06.2h0a119.59,119.59,0,0,0,113.58,82H404.82V339.54h-157A86.16,86.16,0,0,1,170,290.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-3" d="M165.74,225.23c.07-.22.15-.44.24-.67,10.67-30.73,38.44-54.89,71.77-58.75,6.89-.13,167.07,0,167.07,0v-32.2s-152.11-.51-157.1-.51A119.68,119.68,0,0,0,128.05,252.76c0,.2,0,.4,0,.59h33.15v0H404.82V235.48H163c.45-2.19,1-4.34,1.6-6.46C164.93,227.75,165.31,226.49,165.74,225.23Z" transform="translate(-128.05 -133.1)"/></g></svg>
		</div>
		<br/>
		<div class ="items-menu">
		    
		    <a <?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas">Pastas</a>
			<a <?php selecionadoMenu('listar-arquivos');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos">Arquivos</a>
			<a <?php selecionadoMenu('listar-usuarios');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-usuarios">Usuários</a>
		
		</div><!--items-menu-->
		<div class ="items-menu2">
			<a <?php selecionadoMenu('area-cliente');?> href="<?php echo INCLUDE_PATH_PAINEL?>area-cliente" style="font-weight:200 !important;">Área do cliente</a>
			<a <?php selecionadoMenu('catalogo');?> href="<?php echo INCLUDE_PATH_PAINEL?>catalogo" style="font-weight:200 !important;">Nossos serviços</a>
			<a <?php selecionadoMenu('curso');?> href="<?php echo INCLUDE_PATH_PAINEL?>curso">Curso gratuito para nossos clientes, confira.</a>
		</div>
		</div><!--menu-wraper-->
	</div><!--menu-->

	<header>
	

		

		<div class="center">

			<div class="loggout">
			<div class="logado">
				<h4>Olá, <?php echo $_SESSION['Nome']; ?></h4>
			</div>
			<div class="menu-topo">
				<a href="https://eranalitica.com.br/servicos" target="_blank">Serviços</a>
				<a href="https://eranalitica.com.br/qualidade/" target="_blank">Qualidade</a>
				<a href="https://eranalitica.com.br/contato/" target="_blank">Fale Conosco</a>
			</div>
				<a <?php if(@$_GET['url'] == ''){?> style = "padding:15px;"<?php }?> href="<?php echo INCLUDE_PATH_PAINEL?>"><i class="fa fa-home"></i> <span>Página Inicial</span></a>
				<a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><i class="fas fa-sign-out-alt"></i> <span>Sair </span></a>
			</div><!--Loggout-->
			</div>


			<div class="clear"></div>

			



			
			<!--menu para adm-->
			 <nav class="mobile right">

			 	<div class="botao-menu-mobile">
			 	
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>

			 
				<ul>
					<li><a <?php if(@$_GET['url'] == ''){?> style = "padding:15px;"<?php }?> href="<?php echo INCLUDE_PATH_PAINEL?>"><i class="fa fa-home"></i> <span>Página Inicial</span></a></li>
					<li><a href="https://eranalitica.com.br/servicos" target="_blank">Serviços</a></li>
					<li><a href="https://eranalitica.com.br/qualidade/" target="_blank">Qualidade</a></li>
					<li><a href="https://eranalitica.com.br/contato/" target="_blank">Fale Conosco</a></li>
					<li><a <?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas">Pastas</a></li>
					<li><a <?php selecionadoMenu('listar-arquivos');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos">Arquivos</a></li>
					<li><a <?php selecionadoMenu('listar-usuarios');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-usuarios">Usuários</a></li>
					<li><a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><i class="fas fa-sign-out-alt"></i> <span>Sair </span></a></li>

				</ul>
				

				<div class="logado">

					
				</div>
			</nav>



			<!--menu do cliente-->
 			<nav class="mobile2 right">

			 	<div class="botao-menu-mobile2">
			 	
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>

			 
				<ul>
					<li><a <?php if(@$_GET['url'] == ''){?> style = "padding:15px;"<?php }?> href="<?php echo INCLUDE_PATH_PAINEL?>"><i class="fa fa-home"></i> <span>Página Inicial</span></a></li>
					<li><a href="https://eranalitica.com.br/servicos" target="_blank">Serviços</a></li>
					<li><a href="https://eranalitica.com.br/qualidade/" target="_blank">Qualidade</a></li>
					<li><a href="https://eranalitica.com.br/contato/" target="_blank">Fale Conosco</a></li>
					<li><a <?php selecionadoMenu('area-cliente');?> href="<?php echo INCLUDE_PATH_PAINEL?>area-cliente">Área do cliente</a></li>
					<li><a <?php selecionadoMenu('catalogo');?> href="<?php echo INCLUDE_PATH_PAINEL?>catalogo">Nossos serviços</a></li>
					<li><a <?php selecionadoMenu('curso');?> href="<?php echo INCLUDE_PATH_PAINEL?>curso">Curso gratuito para nossos clientes, confira.</a></li>
					<li><a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><i class="fas fa-sign-out-alt"></i> <span>Sair </span></a></li>

				</ul>
				

				<div class="logado2">

					
				</div>
			</nav>










	<div class="logo2">
			
<!-- Generator: Adobe Illustrator 25.3.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 120 80" style="enable-background:new 0 0 120 80;" xml:space="preserve">
<style type="text/css">
	.st0{fill:#FFFFFF;}
</style>
<g>
	<g>
		<path class="st0" d="M13.29,69.59c0,0.47,0.03,0.93,0.1,1.29h-1.15l-0.12-0.68h-0.04c-0.38,0.42-1.15,0.8-2.16,0.8
			c-1.43,0-2.16-0.77-2.16-1.55c0-1.31,1.52-2.02,4.25-2.01v-0.11c0-0.45-0.16-1.26-1.61-1.25c-0.67,0-1.36,0.15-1.85,0.4
			l-0.29-0.66c0.58-0.28,1.45-0.47,2.34-0.47c2.18,0,2.7,1.13,2.7,2.21V69.59z M12.03,68.13c-1.4-0.02-2.99,0.17-2.99,1.22
			c0,0.65,0.55,0.94,1.2,0.94c0.93,0,1.53-0.45,1.74-0.9c0.04-0.1,0.06-0.21,0.06-0.31V68.13z"/>
		<path class="st0" d="M22.64,66.94c0-0.57-0.01-1.02-0.06-1.46h1.14l0.07,0.88h0.03c0.35-0.5,1.17-1,2.34-1
			c0.98,0,2.5,0.45,2.5,2.3v3.23h-1.28v-3.11c0-0.87-0.42-1.61-1.64-1.61c-0.83,0-1.49,0.46-1.72,1c-0.06,0.12-0.09,0.3-0.09,0.46
			v3.26h-1.28V66.94z"/>
		<path class="st0" d="M43.02,69.59c0,0.47,0.03,0.93,0.1,1.29h-1.15l-0.12-0.68h-0.04c-0.38,0.42-1.15,0.8-2.16,0.8
			c-1.43,0-2.16-0.77-2.16-1.55c0-1.31,1.52-2.02,4.25-2.01v-0.11c0-0.45-0.16-1.26-1.61-1.25c-0.67,0-1.36,0.15-1.85,0.4
			l-0.29-0.66c0.58-0.28,1.45-0.47,2.34-0.47c2.18,0,2.7,1.13,2.7,2.21V69.59z M41.76,68.13c-1.4-0.02-2.99,0.17-2.99,1.22
			c0,0.65,0.55,0.94,1.2,0.94c0.93,0,1.53-0.45,1.74-0.9c0.04-0.1,0.06-0.21,0.06-0.31V68.13z"/>
		<path class="st0" d="M52.38,62.96h1.28v7.93h-1.28V62.96z"/>
		<path class="st0" d="M65.72,63.15l-1.78,1.6h-0.91l1.28-1.6H65.72z M63.12,70.88v-5.4h1.28v5.4H63.12z"/>
		<path class="st0" d="M75.38,64.19v1.29h1.84v0.75h-1.84v2.9c0,0.67,0.25,1.05,0.96,1.05c0.35,0,0.55-0.02,0.74-0.07l0.06,0.75
			C76.9,70.93,76.51,71,76.01,71c-0.6,0-1.08-0.16-1.39-0.41c-0.35-0.3-0.5-0.78-0.5-1.42v-2.94h-1.09v-0.75h1.09v-0.99L75.38,64.19
			z"/>
		<path class="st0" d="M86.58,64.57c-0.47,0-0.77-0.28-0.77-0.6c0-0.35,0.32-0.61,0.8-0.61c0.47,0,0.79,0.27,0.79,0.61
			c0,0.32-0.31,0.6-0.8,0.6H86.58z M85.96,70.88v-5.4h1.28v5.4H85.96z"/>
		<path class="st0" d="M101.72,70.68c-0.34,0.12-1.08,0.31-2.03,0.31c-2.13,0-3.52-1.1-3.52-2.76c0-1.66,1.49-2.88,3.8-2.88
			c0.76,0,1.43,0.15,1.78,0.29l-0.29,0.75c-0.31-0.12-0.79-0.26-1.49-0.26c-1.62,0-2.5,0.93-2.5,2.04c0,1.25,1.05,2.02,2.45,2.02
			c0.73,0,1.21-0.13,1.58-0.26L101.72,70.68z"/>
		<path class="st0" d="M115.5,69.59c0,0.47,0.03,0.93,0.1,1.29h-1.15l-0.12-0.68h-0.04c-0.38,0.42-1.15,0.8-2.16,0.8
			c-1.43,0-2.16-0.77-2.16-1.55c0-1.31,1.52-2.02,4.25-2.01v-0.11c0-0.45-0.16-1.26-1.61-1.25c-0.67,0-1.36,0.15-1.85,0.4
			l-0.29-0.66c0.58-0.28,1.45-0.47,2.34-0.47c2.18,0,2.7,1.13,2.7,2.21V69.59z M114.24,68.13c-1.4-0.02-2.99,0.17-2.99,1.22
			c0,0.65,0.55,0.94,1.2,0.94c0.93,0,1.53-0.45,1.74-0.9c0.04-0.1,0.06-0.21,0.06-0.31V68.13z"/>
	</g>
</g>
<path class="st0" d="M100.49,34.61c0.36,0,1.56-0.1,1.56-0.1c3.58-0.55,6.65-2.65,8.51-5.59c1.22-1.91,1.92-4.18,1.92-6.61
	c0-2.25-0.6-4.36-1.66-6.18c-1.86-3.22-5.13-5.52-8.97-6.04c0,0-0.9-0.12-1.72-0.12c-0.82,0-38.47,0-38.47,0v6h38.08h0.88
	c0.28,0.01,0.6,0.07,0.6,0.07c3.04,0.5,5.36,3.3,5.36,6.49c0,3.18-2.32,5.82-5.36,6.32c0,0-0.42,0.08-0.88,0.08h-0.33h-29.3v5.74
	v0.09l35.14,19.14h0.17h6.34l-35.4-19.28C85.67,34.61,100.24,34.61,100.49,34.61z"/>
<g>
	<path class="st0" d="M12.43,38.85L12.43,38.85c-0.66-1.37-1.14-2.85-1.39-4.41H4.88c0.17,1.4,0.44,2.76,0.85,4.07H5.72
		c0.03,0.1,0.07,0.2,0.1,0.3c0,0.01,0.01,0.02,0.01,0.04h0c1.56,4.7,4.65,8.7,8.7,11.4c3.49,2.33,7.68,3.68,12.18,3.68
		c0.48,0,28.88,0,28.88,0v-6.04c0,0-28.11,0-28.86,0C20.42,47.88,14.97,44.19,12.43,38.85z"/>
	<path class="st0" d="M11.64,26.87c0.01-0.04,0.03-0.08,0.04-0.12c1.96-5.65,7.06-10.09,13.19-10.8c1.27-0.02,30.71,0,30.71,0v-5.92
		c0,0-27.96-0.09-28.87-0.09c-4.97,0-9.56,1.65-13.24,4.43c-5.32,4.01-8.76,10.38-8.76,17.56c0,0.04,0,0.07,0,0.11h0.03h6.06l0,0
		h44.77v-3.28H11.14c0.08-0.4,0.18-0.8,0.29-1.19C11.5,27.34,11.57,27.1,11.64,26.87z"/>
</g>
</svg>

		</div>











	</header>
	<div class="content">
		<?php Painel::carregarPagina();?>

	</div><!--content-->
	
	<script src="<?php echo INCLUDE_PATH?>js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.maskMoney.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.mask.js"></script>
	<!--<script src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.ajaxform.js"></script>-->
	<script src="<?php echo INCLUDE_PATH?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL?>js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 	<script src="<?php echo INCLUDE_PATH_PAINEL?>js/helperMask.js"></script>
 	<script defer>
		$(document).ready(function() {
		    $('#pasta').select2();
		    $('#pasta2').select2();
		    $('#pasta3').select2();
		    $('#pasta4').select2();
		 
		});
		var container = document.getElementById("container");
		var button = document.getElementById("btn");

		button.addEventListener("click", function(){
			

			if(container.style.display === "none"){
				container.style.display = "block";
			} else{
				container.style.display = "none";
			}
		});



	
	</script>
    <script>var purecookieTitle="Cookies.",purecookieDesc="Utilizamos cookies para oferecer melhor experiência, melhorar o desempenho, analisar como você interage em nosso site e personalizar conteúdo.",purecookieLink='<a href="https://eranalitica.com.br/politica-de-privacidade/" target="_blank">Política de privacidade</a>',purecookieButton="Aceitar";function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a>'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",7),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};</script>
</body>

</html>