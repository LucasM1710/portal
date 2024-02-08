<?php
ob_start();
	include('html/config.php');
 
	if(Painel::logado() == false){
		include('html/painel/login.php');
	}
    else{
    	include('html/painel/main.php');
           //redirecionando para pagina conforme o tipo do usuário
			    /*
			    }*/
		
    }
 
ob_end_flush();

?>
