<?php

	class Painel
	{

		public static $tipos =[
			'1'=>'Cliente',
			'2'=>'Administrador'
			
		];
		 
		public static function loadJS($files,$page){
			$url = explode('/',@$_GET['url'])[0];
			if($page == $url){
				foreach ($files as $key => $value) {
					echo '<script src="'.INCLUDE_PATH_PAINEL.'js/'.$value.'"></script>';
				}
			}
		}

		public static function generateSlug($str){
			$str = mb_strtolower($str);
			$str = preg_replace('/(â|á|ã)/', 'a', $str);
			$str = preg_replace('/(ê|é)/', 'e', $str);
			$str = preg_replace('/(í|Í)/', 'i', $str);
			$str = preg_replace('/(ú)/', 'u', $str);
			$str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
			$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
			$str = preg_replace('/( )/', '-',$str);
			$str = preg_replace('/ç/','c',$str);
			$str = preg_replace('/(-[-]{1,})/','-',$str);
			$str = preg_replace('/(,)/','-',$str);
			$str=strtolower($str);
			return $str;
		}

		/*public static function cliente{
		if ($_SESSION['tipo'] == 0){
				include ('pages/cliente.php');
			};
		}*/

		public static function logado(){
			return isset($_SESSION['login']) ? true : false;
		}

		/*public static function cliente(){
			 if ($info['tipo'] == 0)  {
			 	include('pages/cliente.php');
			 }
			 else{
			 	include('main.php');
			 }
		}*/

		public static function loggout(){
			setcookie('lembrar','true',time()-1,'/');
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
		}

		public static function carregarPagina(){
			if(isset($_GET['url'])){
				$url=explode('/',$_GET['url']);
				if(file_exists('pages/'.$url[0].'.php')){
					include('pages/'.$url[0].'.php');
				}else{

					//Página não existe//
					header('Location: '.INCLUDE_PATH_PAINEL);
				}

			}else{
				if($_SESSION['tipo'] == 2){
				include('pages/pagina-inicial.php');
			}else{
				include('pages/area-cliente.php');
			}
			}
		}

		public static function listarUsuariosOnline(){
			self::limparUsuariosOnline();
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function limparUsuariosOnline(){
			$date = date('Y-m-d H:i:s');
			$sql = MySql::conectar()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date'- INTERVAL 1 MINUTE");
		}

		public static function alert($tipo,$mensagem){
			if($tipo=='sucesso'){
				echo '<div class="box-alert sucesso"><i class="fa fa-check"></i>'.$mensagem.'</div>';
			}else if($tipo == 'erro'){
				echo '<div class="box-alert erro"><i class="fa fa-times"></i>'.$mensagem.'</div>';
			}

		}

		/*public static function imagemValida($imagem){
			//Files php type//
			if($imagem['type']=='image/jpeg' || $imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png' || $imagem['type'] == 'image/pdf'){
				$tamanho = intval($imagem['size']/1024);

				if($tamanho < 300)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}*/



		public static function uploadArquivo($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = $file['name'];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
				return $imagemNome;
			else
				return false;
		}
		public static function uploadFile($arquivo){

			/*  
			*$dir é o caminho da pasta onde você deseja que os arquivos sejam salvos. 
			*Neste exemplo, supondo que esta pagina esteja em public_html/upload/ 
			*os arquivos serão salvos em public_html/upload/imagens/ 
			*Obs.: Esta pasta de destino dos arquivos deve estar com as permissões de escrita habilitadas. 
			*/ 

			//$dir = "uploads/"; 
			// recebendo o arquivo multipart 
			//$file = $_FILES["arquivo"]; 
			// Move o arquivo da pasta temporaria de upload para a pasta de destino 
			//if (move_uploaded_file($file["tmp_name"], "$dir/".$file["name"])) { 
			   
			//}
			$msg = false;
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
			$novo_nome = md5(time()). $extensao;
			$diretorio = "uploads/";

			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			//$sql_code = "INSERT INTO tb_arquivos (arquivo) VALUES ('$novo_nome')";


		}

		public static function deleteFile($file){
			@unlink('uploads/'.$file);

		}

		public static function insert($arr){
			$certo = true;
			$nome_tabela = $arr['nome_tabela'];
			$query = "INSERT INTO `$nome_tabela` VALUES (null";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;

				if($nome == 'acao' || $nome == 'nome_tabela')
					continue;

				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[]=$value;
			}
				$query.=")";

				if($certo == true){
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
				$lastId = MySql::conectar()->lastInsertId();
				$sql = MySql::conectar()->prepare("UPDATE `$nome_tabela` SET order_id = ? WHERE id = $lastId");
				$sql->execute(array($lastId));
			}
				return $certo;
		}


		public static function update($arr,$single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];
			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;

				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;

				$query1 = "SELECT * FROM tb_pastas";
				$sql = MySql::conectar()->prepare($query1);
				$sql->execute();
				$arquivos = $sql->fetchAll();
				if(isset($_GET['id'])){
					$id = (int)$_GET['id'];
					$usuario = Painel::select('tb_pastas','id = ?',array($id));


				}
				/*foreach ($arquivos as $key => $valores) {
				
						
				
				if(($value == $valores['nome']) && ($valores['id'] != $id)){
					$certo = false;
					break;
				}
				}*/

				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}

				else{
					$query.=",$nome=?";
				}

				$parametros[]=$value;
			}

				if($certo == true){
					if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::conectar()->prepare($query.' WHERE id=?');

					$sql->execute($parametros);
				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
			}
				return $certo;
		}
}




/**** Aqui eu faço o cadastro de usuario*/

			public static function update_user($arr,$single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];
			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;

				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;



				$query1 = "SELECT * FROM tb_usuarios";
				$sql = MySql::conectar()->prepare($query1);
				$sql->execute();
				$arquivos = $sql->fetchAll();
				if(isset($_GET['id'])){
					$id = (int)$_GET['id'];
					$usuario = Painel::select('tb_usuarios','id = ?',array($id));


				}
				foreach ($arquivos as $key => $valores) {
				
						
				
				if(($value == $valores['user']) && ($valores['id'] != $id)){
					$certo = false;
					break;
				}
				}
				

				if($first == false){
					$first = true;
					$query.="$nome=?";
				}

				else{
					$query.=",$nome=?";
				}

				$parametros[]=$value;
			}

				if($certo == true){
					if($single == false){
					$parametros[] = $arr['id'];
					
					
				
					//$imp = $arr['empresa'];
					/*var_dump($arr);
					var_dump($parametros);*/
					$parametros[5] = implode(', ', $arr['empresa']);

					$sql = MySql::conectar()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);



				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
			}
				return $certo;
		}
}


/**************************************************************************/




		public static function selectAll($tabela,$start = null,$end = null){
			if($start == null && $end == null)
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC");
			else
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC LIMIT $start,$end");
				
			

			$sql->execute();
			return $sql->fetchAll();

		}

		public static function deletar($tabela,$id=false){
			if($id == false){
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id");
			}
			$sql->execute();

		}

		public static function redirect($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();

		}
		/*Método especifico para selecionar apenas um registro*/

		public static function select($table,$query = '',$arr = ''){
			if($query != false){
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
				$sql->execute($arr);	
			}else{
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");
				$sql->execute();
			}
		
			return $sql->fetch();
		}

		public static function orderItem($tabela,$orderType,$idItem){
			if($orderType == 'up'){
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
			}

			else if($orderType == 'down'){
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
			}
		}

	}

?>