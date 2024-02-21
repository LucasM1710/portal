<?php

	/*TODO: *Quando faltar algo para colocar no código.


	*/
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	
		$autoload = function($class){
		if($class == 'Email'){
			require("classes/PHPMailer-master/src/PHPMailer.php");
			require("classes/PHPMailer-master/src/SMTP.php");
			require("classes/PHPMailer-master/src/Exception.php");
		}
		include('classes/'.$class.'.php');

		};
		spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://217.196.62.185:8012');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	define('BASE_DIR_PAINEL',__DIR__.'/painel');


	//Conectar com banco de dados!
	define('HOST','cls3mrion001loyawxe5e33us');
	define('USER','cls3mriom001aawoy3n5g7dtn');
	define('PASSWORD','BAbgHu0RO0ftZ6hnobGWMmlD');
	define('DATABASE','certificados');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','Lpaynnel');


	//Funções do painel
	function pegaCargo($indice){
	
		return Painel::$tipos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-hand-o-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}

	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['tipo'] >= $permissao){
			
			echo '<style> .items-menu2 a{
				display:none;
				}
				.nav mobile2 ul li a{
					display:none;
				}
				.botao-menu-mobile2{
					display:none;
				}
				.logado2{
					display:none;
				}


				
				</style>';
				return;
			}
		}


	function verificaPermissaoMenuC($permissao){
		if($_SESSION['tipo'] <= $permissao){
			
			echo '<style> .items-menu a{
				display:none;
				}
				.nav mobile ul li a{
					display:none;
				}
				.botao-menu-mobile{
					display:none;
				}
				.logado{
					display:none;
				}


				</style>';
				return;
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['tipo'] >= $permissao){
			return;
		}else{
			include ('painel/pages/permissao_negada.php');
			die();
		}
	}


	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}

	
?>
