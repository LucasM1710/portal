<?php
	
	class Usuario{
		/*public function atualizarUsuario($nome,$senha,$imagem){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?,password = ?,img = ? WHERE user = ?");
			if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
				return true;
			}else{
				return false;
			}

		}*/

		public static function userExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_usuarios` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount()==1)
				return true;
			else
				return false;
		}

		 /*$pedido_bebida = implode(', ', $_POST['pedido_bebida']);
    $sql = "INSERT INTO sua_tabela(sua_coluna) VALUES ('$pedido_bebida')";
    mysqli_query($con, $sql) OR die(mysqli_error($con));*/



    	/* Aqui eu cadastro usuario*/
		public static function cadastrarUsuario($login,$nome,$tipo,$senha,$status,$empresa){
			$empresa = implode(', ', $_POST['empresa']);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_usuarios` VALUES (null,?,?,?,?,?,?)");
			$sql->execute(array($login,$nome,$tipo,$senha,$status,$empresa));
		}

	
		/*public static function atualizarUsuario(){
			$empresa = implode(', ', $_POST['empresa']);
			$sql = MySql::conectar()->prepare("UPDATE `tb_usuarios` SET Nome = ?, Email = ?, password = ?, Status = ?, Empresa = ?, Cnpj = ?, Telefone = ?, Endereco = ?, Cidade = ?, Estado = ? WHERE id = ?");
			$sql->execute(array($nome,$email,$senha,$status,$empresa,$cnpj,$telefone,$endereco,$cidade,$estado));
			
		}*/

	}



?>