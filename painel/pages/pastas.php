<?php
	verificaPermissaoMenuC(1);

	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$arquivo = Painel::select('tb_pastas','id = ?',array($id));

	}else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}
	

	

	/*$query = "SELECT * FROM tb_arquivos WHERE `pasta_id` = '$value' && '$value'!= 'Padroes'";*/
	


?>


<div class="box-content">
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder ="Procure por: Titulo..."type = "text" name = "busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	<?php
		$empresa = $arquivo['nome'];
		$query = " SELECT * FROM tb_arquivos WHERE '$empresa' = `pasta`";
		$query2 = " SELECT * FROM tb_padrao WHERE '$empresa' = `pasta`";
		$query3 = " SELECT * FROM tb_equipamentos WHERE '$empresa' = `pasta`";
		$query4 = " SELECT * FROM tb_calibracao WHERE '$empresa' = `pasta`";

		
		if(isset($_POST['acao'])){


			$busca = $_POST['busca'];
			$query = " SELECT * FROM tb_arquivos WHERE '$empresa' = `pasta`";
			$query .= " and arquivo like '%$busca%'";
			$query2 = " SELECT * FROM tb_padrao WHERE '$empresa' = `pasta`";
			$query2 .= " and arquivo like '%$busca%'";
			$query3 = " SELECT * FROM tb_equipamentos WHERE '$empresa' = `pasta`";
			$query3 .= " and arquivo like '%$busca%'";
			$query4 = " SELECT * FROM tb_calibracao WHERE '$empresa' = `pasta`";
			$query4 .= " and arquivo like '%$busca%'";
			
		
		}
		//$query.="WHERE `pasta_id` == $empresa";
		
	
		
		$sql = MySql::conectar()->prepare($query);
		$sql->execute();
		$arquivos = $sql->fetchAll();

		$sql = MySql::conectar()->prepare($query2);
		$sql->execute();
		$arquivos2 = $sql->fetchAll();

		$sql = MySql::conectar()->prepare($query3);
		$sql->execute();
		$arquivos3 = $sql->fetchAll();

		$sql = MySql::conectar()->prepare($query4);
		$sql->execute();
		$arquivos4 = $sql->fetchAll();

		$soma = count($arquivos) + count($arquivos2) + count($arquivos3) + count($arquivos4);
			
		
				

		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.$soma.' resultado(s)</b></p></div>';
		}


	?>
<div class ="wraper-table">
	<table>
		<br/>
		
		<tr>

			<td>Arquivo</td>
			<td>Descrição</td>
			<td>Data de upload</td>
			<td></td>
		</tr>

		<?php
			foreach ($arquivos as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><?php if(strlen($value['titulo']) > 40){
					echo mb_substr($value['titulo'], 0,40)."...";	
				}else{
					echo $value['titulo'];
				}?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php echo $value ['data']; ?></td>
			<td><a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>">Abrir</a></td>


		</tr>

		<?php }?>



		<?php
			foreach ($arquivos2 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><?php if(strlen($value['titulo']) > 40){
					echo mb_substr($value['titulo'], 0,40)."...";	
				}else{
					echo $value['titulo'];
				}?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php echo $value ['data']; ?></td>
			<td><a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>">Abrir</a></td>


		</tr>

		<?php }?>



		<?php
			foreach ($arquivos3 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><?php if(strlen($value['titulo']) > 40){
					echo mb_substr($value['titulo'], 0,40)."...";	
				}else{
					echo $value['titulo'];
			}?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php echo $value ['data']; ?></td>
			<td><a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>">Abrir</a></td>


		</tr>

		<?php }?>



		<?php
			foreach ($arquivos4 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><?php if(strlen($value['titulo']) > 40){
					echo mb_substr($value['titulo'], 0,40)."...";	
				}else{
					echo $value['titulo'];
			}?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php echo $value ['data']; ?></td>
			<td><a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>">Abrir</a></td>


		</tr>

		<?php }?>
	</table>
	<a <?php selecionadoMenu('area-cliente');?> href="<?php echo INCLUDE_PATH_PAINEL?>area-cliente"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
</div>