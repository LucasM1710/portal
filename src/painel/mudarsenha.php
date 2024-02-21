<?php
	include('../classes/Painel.php');
	include('../config.php');



?>

<title>Certificados Área Do Cliente | ER Analítica</title>
    <meta charset="utf-8">
	<meta name="viewport" content= "width=device-width, initial-scale=1.0">
	<meta name="description" content="Consulte seus certificados emitidos e os padrões utilizados na sua calibração através da área do cliente.">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/all.css" > 
	<link href="<?php echo INCLUDE_PATH_PAINEL?>css/style.css" rel="stylesheet"/>
	<link rel="icon" href="../Img/logo3.png" type="image/x-icon" />
	<style>

	*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: "Open Sans";
	}
	
	html,body{
	height: 100%;
	background: #f4f4f4;
    }

    body{
	    overflow-x: hidden;
    }


	.box-senha{
	box-shadow: 7px 7px 2.5px rgb(136 136 136/0.2) ;
	max-width: 600px;
    width: 95%;
	padding: 80px 2%;
	background: white;
	position: absolute;
	left:50%;
	top:50%;
	transform: translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	border-radius: 5%;

}

.box-senha h2{
	font-size: 20px;
	margin:10px 0;
	text-align: center;
	text-transform: uppercase;

}

.box-senha svg{
	width:35%;
	height: 35%;
	position: relative;
	left: 33%;
	bottom:40px;
}


.box-login input[type=text]{
	width: 100%;
	height: 40px;
	border:1px solid #ccc;
	padding-left: 8px;
	margin-top: 8px;
}

.box-login input[type=submit]{
	width: 100%;
	height: 40px;
	cursor:pointer;
	margin-top:8px;
	background: #00284f;
	color:white;
	text-align: center;
	font-size: 20px;
}
</style>

	<div class = "box-login">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 587.65 332.25"><defs><style>.cls-1{fill:#888787;}.cls-2{fill:#005a85;}.cls-3{fill:#009edd;}</style></defs><g id="Analítica"><path class="cls-1" d="M159,457.64a37.74,37.74,0,0,0,.56,7.05H153.3l-.63-3.71h-.24c-2.07,2.31-6.28,4.37-11.76,4.37-7.78,0-11.75-4.19-11.75-8.44,0-7.11,8.26-11,23.11-10.93v-.61c0-2.43-.87-6.86-8.74-6.8a22.84,22.84,0,0,0-10.08,2.19l-1.59-3.59a30.92,30.92,0,0,1,12.71-2.55c11.83,0,14.69,6.14,14.69,12Zm-6.83-8c-7.63-.12-16.28.91-16.28,6.62,0,3.53,3,5.11,6.51,5.11,5.08,0,8.34-2.43,9.45-4.92a4.32,4.32,0,0,0,.32-1.71Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M209.93,443.24a79,79,0,0,0-.32-7.95h6.2l.39,4.8h.16c1.91-2.74,6.36-5.47,12.71-5.47,5.32,0,13.58,2.43,13.58,12.51v17.56h-7V447.74c0-4.74-2.3-8.75-8.89-8.75-4.53,0-8.1,2.49-9.38,5.47a6.39,6.39,0,0,0-.47,2.49v17.74h-7Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M320.81,457.64a37.79,37.79,0,0,0,.55,7.05h-6.27l-.64-3.71h-.24c-2.06,2.31-6.27,4.37-11.75,4.37-7.79,0-11.76-4.19-11.76-8.44,0-7.11,8.26-11,23.12-10.93v-.61c0-2.43-.88-6.86-8.74-6.8A22.86,22.86,0,0,0,295,440.76l-1.59-3.59a31,31,0,0,1,12.71-2.55c11.84,0,14.7,6.14,14.7,12Zm-6.84-8c-7.62-.12-16.28.91-16.28,6.62,0,3.53,3,5.11,6.51,5.11,5.09,0,8.34-2.43,9.46-4.92a4.49,4.49,0,0,0,.31-1.71Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M371.71,421.56h7v43.13h-7Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M444.31,422.59l-9.7,8.69h-4.92l7-8.69Zm-14.14,42.1v-29.4h7v29.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M496.88,428.24v7.05h10v4.07h-10v15.79c0,3.64,1.35,5.71,5.24,5.71a16.55,16.55,0,0,0,4.06-.37l.31,4.07a24.14,24.14,0,0,1-6.19.73,11.79,11.79,0,0,1-7.55-2.24c-1.91-1.64-2.7-4.26-2.7-7.72v-16h-6v-4.07h6v-5.41Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M557.8,430.31c-2.54,0-4.21-1.52-4.21-3.28s1.74-3.34,4.37-3.34,4.28,1.46,4.28,3.34-1.66,3.28-4.36,3.28Zm-3.34,34.38v-29.4h7v29.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M640.16,463.59a34.19,34.19,0,0,1-11,1.7c-11.6,0-19.14-6-19.14-15s8.1-15.67,20.65-15.67a27.78,27.78,0,0,1,9.69,1.58l-1.59,4.07a21.46,21.46,0,0,0-8.1-1.4c-8.82,0-13.58,5-13.58,11.12,0,6.8,5.71,11,13.34,11a25.24,25.24,0,0,0,8.58-1.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-1" d="M715.14,457.64a38.66,38.66,0,0,0,.55,7.05h-6.27l-.64-3.71h-.24c-2.06,2.31-6.27,4.37-11.75,4.37-7.79,0-11.76-4.19-11.76-8.44,0-7.11,8.26-11,23.12-10.93v-.61c0-2.43-.88-6.86-8.74-6.8a22.89,22.89,0,0,0-10.09,2.19l-1.59-3.59a31,31,0,0,1,12.71-2.55c11.84,0,14.7,6.14,14.7,12Zm-6.83-8c-7.63-.12-16.29.91-16.29,6.62,0,3.53,3,5.11,6.51,5.11,5.09,0,8.35-2.43,9.46-4.92a4.32,4.32,0,0,0,.32-1.71Z" transform="translate(-128.05 -133.1)"/></g><g id="R"><path class="cls-2" d="M649.14,267.35c2,0,8.5-.53,8.5-.53a67.18,67.18,0,0,0-1-132.9,81.51,81.51,0,0,0-9.35-.66H438v32.66h212a28.57,28.57,0,0,1,3.29.37c16.55,2.72,29.18,18,29.18,35.29A34.88,34.88,0,0,1,653.2,236a28.4,28.4,0,0,1-4.79.44H487.2v31.71L678.37,372.26H713.8L521.2,267.35Z" transform="translate(-128.05 -133.1)"/></g><g id="E"><path class="cls-3" d="M170,290.4h0a86.18,86.18,0,0,1-7.58-24H128.92a120.6,120.6,0,0,0,4.64,22.13h-.06c.18.55.38,1.1.56,1.65l.06.2h0a119.59,119.59,0,0,0,113.58,82H404.82V339.54h-157A86.16,86.16,0,0,1,170,290.4Z" transform="translate(-128.05 -133.1)"/><path class="cls-3" d="M165.74,225.23c.07-.22.15-.44.24-.67,10.67-30.73,38.44-54.89,71.77-58.75,6.89-.13,167.07,0,167.07,0v-32.2s-152.11-.51-157.1-.51A119.68,119.68,0,0,0,128.05,252.76c0,.2,0,.4,0,.59h33.15v0H404.82V235.48H163c.45-2.19,1-4.34,1.6-6.46C164.93,227.75,165.31,226.49,165.74,225.23Z" transform="translate(-128.05 -133.1)"/></g></svg>
		<h2>Atualizar senha</h2>

		<form method="post">
			<code>Insira sua nova senha para realizar a atualização</code>
			<br/>
			<input style="font-size: 18px;"type="text" name="password" placeholder="Senha..." maxlength="99" required>
			<input style="background:#045a88; font-weight: bold;"type="submit" name="redefinir" value="Atualizar">
			
			
			<div class = "clear"></div>
		</form>

	</div><!--box-login-->

 <?php 
 	if(isset($_POST['redefinir'])){
 		$password = $_POST['password'];
 		$user = $_SESSION['user'];
 		$sql = MySql::conectar()->prepare("UPDATE `tb_usuarios` SET password = ? WHERE user = '$user'");
		$sql->execute(array($password));
		if($password == ''){
			echo 'Senha inválida, o campo está vazio';
		}else{
 	        include('sucesso-senha.php');
 	}
 }


 ?>