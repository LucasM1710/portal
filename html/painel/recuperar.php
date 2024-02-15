<?php
	
	//session_start();
	include('../classes/Painel.php');
	include('../config.php');
	if(isset($_POST['acao'])){
		$user = $_POST['user'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuarios` WHERE user = ?");
		$sql->execute(array($user));
		if($sql->rowCount()==1){
					$info = $sql->fetch();
					//Logamos com sucesso
					$token = uniqid();
					$_SESSION['token'] = $token;
					$_SESSION['user']=$user;

					$corpoEmail='<h2>Olá! Você solicitou a redefinição de sua senha no portal da ER Analítica!</h2>
					<h3>Clique <a href="https://certificados.eranalitica.com.br/painel/mudarsenha.php">aqui</a> para redefinir a sua senha.</h3>';
					$email = new Email('br520.hostgator.com.br','contato@eranalitica.com.br','Er2020**','Er Analítica');
					$email->addAdress($user);
					$email->formatarEmail(array('assunto'=>'Redefinição de senha','corpo'=>$corpoEmail));
					if($email->enviarEmail()){
						include('emailsucesso.php');
					}else{
						Painel::alert('erro','Ops, ocorreu um erro');
					}
					
					//'lucasmatheuscs.com.br','lmcsdev@lucasmatheuscs.com.br','spiderman2210','lucasm04'
					//'br520.hostgator.com.br','contato@eranalitica.com.br','Er2020**','Er Analítica'
					//'eranalitica.com.br','contato@eranalitica.com.br','Er2020**','Er Analítica'
					//'smtp.gmail.com','eranalitica@gmail.com','er261112er','Er Analítica'
		}
		else{
			//Falhou
			include('emailerro.php');
			
		}
		//verificar se o e-mail existe no bd e enviar o email para a pessoa
		



		//Existe o post para recuperação de senha!
		/*$token = uniqid();
		$_SESSION['token'] = $token;
		$_SESSION['user'] = $user;*/

		
	

?>




<?php
 	}else if($_GET['token']){
 		$token = $_GET['token'];
 		if($token != $_SESSION['token']){
 			die("O token no parâmetro get não é válido!");
 		}else{
 			//Podemos redefinir a senha!
 			echo '<h2>Redefinição de senha para o e-mail: '.$_SESSION['user'].'</h2>';
 			echo '<form method="post">
 			<input type="password" name="password"/>
 			<input type="submit" name="redefinir" value="REDEFINIR"/>
 			</form>';
 		}
 	}
 	

 ?>



 <?php 
 	if(isset($_POST['redefinir'])){
 		$password = $_POST['password'];
 		$user = $_SESSION['user'];
 		$sql = MySql::conectar()->prepare("UPDATE `tb_usuarios` SET password = ? WHERE user = '$user'");
		$sql->execute(array($password));
		if($password == ''){
			echo 'Senha inválida, o campo está vazio';
		}else{
 		echo 'A Senha foi redefinida com sucesso!';
 		echo "<br/>";
 		echo 'Clique<a href="INCLUDE_PATH_PAINEL?>?loggout"><i class="fas fa-sign-out-alt"></i> <span>aqui</span> </a>para refazer o login :)';
 		echo "<br/>";
 		echo "Sua senha agora é: " .$password;
 	}
 }


 ?>
