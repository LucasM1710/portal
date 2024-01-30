<?php
	
	class Pastas{
			public function atualizarPasta($nome,$status){
			$sql = MySql::conectar()->prepare("UPDATE `tb_pastas` SET `nome` = ?, `status` = ? WHERE `tb_pastas`.`id` = ?");
			if($sql->execute(array($nome,$status,$_SESSION['nome']))){
				return true;
			}else{
				return false;
			}

		}

		public static function pastsExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_pastas` WHERE nome=?");
			$sql->execute(array($user));
			if($sql->rowCount()==1)
				return true;
			else
				return false;
		}

		public static function cadastrarPastas($nome,$status){
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_pastas` VALUES (null,?,?)");
			$sql->execute(array($nome,$status));
		}

	}



?>