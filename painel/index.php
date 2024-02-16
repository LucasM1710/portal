<?php
ob_start();
init(['dsn' => 'http://e6308909af1d4585b9a386ec50b0792c@ermonitor.eranalitica.com.br/1' ]);

	include('../config.php');
 
	if(Painel::logado() == false){
		include('login.php');
	}
    else{
    	include('main.php');
           //redirecionando para pagina conforme o tipo do usuário
			    /*
			    }*/
		
    }
 
ob_end_flush();

?>