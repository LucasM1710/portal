
<?php
	
	class Arquivo{
			

		public static function userExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount()==1)
				return true;
			else
				return false;
		}

		public static function cadastrarArquivo($titulo,$descricao,$novo_nome,$pasta_id,$data){
			$extensao = $_FILES['arquivo']['name'];

			$original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*_+={[}]/?;:,\\\'<>°ºª';
   			$substituir = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';	
			$extensao = strtr(utf8_decode($extensao), utf8_decode($original), $substituir);
			//$novo_nome = md5(time()). $extensao;
			$diretorio = "uploads/";

			move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$extensao);
			//$sql_code = "INSERT INTO tb_arquivos (arquivo) VALUES ('$novo_nome')";
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_arquivos` (id, titulo, descricao, arquivo, pasta_id, data) VALUES (null,?,?,?,?,?)");
			$sql->execute(array($titulo,$descricao,$extensao,$pasta_id,$data));
		}


	}



?>