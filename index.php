<?php
ob_start();
	include('config.php');
 
	if(Painel::logado() == false){
		include('painel/login.php');
	}
    else{
    	include('painel/main.php');
           //redirecionando para pagina conforme o tipo do usuário
			    /*
			    }*/
		
    }
 
ob_end_flush();

?>
