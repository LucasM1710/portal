<?php
	verificaPermissaoMenu(2);

?>
<div class="position">
		<div class="box-arquivo">
			<?php
				$query = "SELECT * FROM tb_arquivos";
				$sql = MySql::conectar()->prepare($query);
				$sql->execute();
				$arquivos = $sql->fetchAll();

				$query2 = "SELECT * FROM tb_calibracao";
				$sql = MySql::conectar()->prepare($query2);
				$sql->execute();
				$arquivos2 = $sql->fetchAll();

				$query3 = "SELECT * FROM tb_padrao";
				$sql = MySql::conectar()->prepare($query3);
				$sql->execute();
				$arquivos3 = $sql->fetchAll();

				$query4 = "SELECT * FROM tb_equipamentos";
				$sql = MySql::conectar()->prepare($query4);
				$sql->execute();
				$arquivos4 = $sql->fetchAll();

				$soma = count($arquivos) + count($arquivos2) + count($arquivos3) + count($arquivos4);

				$query2 = "SELECT * FROM tb_pastas";
				$sql = MySql::conectar()->prepare($query2);
				$sql->execute();
				$pastas = $sql->fetchAll();

				$query3 = "SELECT tipo FROM  tb_usuarios WHERE tipo = 1";
				$sql = MySql::conectar()->prepare($query3);
				$sql->execute();
				$cliente = $sql->fetchAll();

				$query3 = "SELECT tipo FROM  tb_usuarios WHERE tipo = 2";
				$sql = MySql::conectar()->prepare($query3);
				$sql->execute();
				$adm = $sql->fetchAll();



			
			?>
			<br/>
			<br/>
			<br/>
			<h1>Arquivos</h1>
			<br/>
			<br/>
			<?php
			echo "<h3>".$soma." Arquivos</h3>"
			?>
			<?php
			echo "<h3>".count($pastas)." Pastas</h3>"
			?>
		</div>

		<div class="box-pastas">
			<br/>
			<br/>
			<br/>
			<h1>Clientes</h1>
			<br/>
			<br/>
			<?php
			echo "<h3>".count($cliente)." Clientes</h3>";
			?>
			<?php
			echo "<h3>".count($adm)." Administradores</h3>"
			?>
		</div>

</div>