
<?php
	verificaPermissaoMenu(2);
	verificaPermissaoMenuC(1);

?>
<?php

	if(isset($_GET['delete'])){
		$idExcluir = (int)$_GET['delete'];
		Painel::deletar('tb_arquivos',$idExcluir);
		Painel::deletar('tb_padrao',$idExcluir);
		Painel::deletar('tb_equipamentos',$idExcluir);
		Painel::deletar('tb_calibracao',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-arquivos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_arquivos',$_GET['order'],$_GET['id']);
		Painel::orderItem('tb_padrao',$_GET['order'],$_GET['id']);
		Painel::orderItem('tb_equipamentos',$_GET['order'],$_GET['id']);
		Painel::orderItem('tb_calibracao',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	//$porPagina = 5;

	//$pastas2 = Painel::selectAll('tb_pastas',($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23 ; "class="fas fa-file-alt"></i> Arquivos</h2>
	<br/>
	<div class="botao-add">
	<a <?php selecionadoMenu('tipo-arquivo');?> href="<?php echo INCLUDE_PATH_PAINEL?>tipo-arquivo"><i class="fas fa-copy"></i> Adicionar Arquivo</a>
	</div>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder ="Procure por: Nome do arquivo, Id, Pasta..."type = "text" name = "busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	
	<div class="boxes">
	<?php
		$porPagina = 99999;
		$query = "SELECT * FROM tb_arquivos";
		$query2 = "SELECT * FROM tb_equipamentos";
		$query3 = "SELECT * FROM tb_calibracao";
		$query4 = "SELECT * FROM tb_padrao";


	

		if(isset($_POST['acao'])){


			$busca = $_POST['busca'];
			$query .= " WHERE arquivo LIKE '%$busca%' OR pasta LIKE '%$busca%' OR descricao LIKE '%$busca%'";
			$query2 .= " WHERE arquivo LIKE '%$busca%' OR pasta LIKE '%$busca%' OR descricao LIKE '%$busca%'";
			$query3 .= " WHERE arquivo LIKE '%$busca%' OR pasta LIKE '%$busca%' OR descricao LIKE '%$busca%'";
			$query4 .= " WHERE arquivo LIKE '%$busca%' OR pasta LIKE '%$busca%' OR descricao LIKE '%$busca%'";
			
		
		}
		
		$totalPaginas = MySql::conectar()->prepare($query);
		$totalPaginas->execute();
		$totalPaginas = ceil($totalPaginas->rowCount()/$porPagina);



			if(!isset($_POST['acao'])){
					
						if(isset($_GET['pagina'])){
							$pagina = (int)$_GET['pagina'];
							if($pagina > $totalPaginas){
							$pagina = 1;
						}
							
							$queryPg = ($pagina - 1) * $porPagina;
							$query.=" ORDER BY id ASC LIMIT $queryPg,$porPagina";
							/*Eu poderia utilizar o ORDER BY order_id ASC LIMIT para ordernar de forma padrão ao painel*/
						}else{
							$pagina = 1;
							$query.=" ORDER BY id ASC LIMIT 0,$porPagina";
						}
					}else{
						$query.=" ORDER BY id ASC";
					}

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
	</div>
	

	<div class ="wraper-table">
	<table>
		<tr>
			<td>Arquivo</td>
			<td>Descrição</td>
			<td>Empresa</td>
			<td>Data de upload</td>
			<td style="text-align: center">Ações</td>
			
		</tr>

		<?php
			
				
			foreach ($arquivos as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
					
						
					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
			?></a></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
			?></td>
			<td><?php echo $value ['data']; ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a> <a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-arquivo?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Arquivo" actionBtn="delete" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>

			<?php
			
				
			foreach ($arquivos2 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
					
						
					
				
				
					
		?>
		
		<tr>
			
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
			?></a></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
			?></td>
			<td><?php echo $value ['data']; ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a> <a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-equipamento?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Arquivo" actionBtn="delete" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>
	

		<?php
			
				
			foreach ($arquivos3 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
					
						
					
				
				
					
		?>
		
		<tr>
			
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
			?></a></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
			?></td>
			<td><?php echo $value ['data']; ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a> <a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-calibracao?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Arquivo" actionBtn="delete" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>

		<?php
			
				
			foreach ($arquivos4 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
					
						
					
				
				
					
		?>
		
		<tr>
			
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
			?></a></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
			?></td>
			<td><?php echo $value ['data']; ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a> <a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-padrao?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Arquivo" actionBtn="delete" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-arquivos?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>
		
	</table>
</div>


	<div class="paginacao">
	<?php
		$totalPaginas = ceil(count(Painel::selectAll('tb_arquivos'))/$porPagina);
		for($i = 1; $i <= $totalPaginas; $i++){
			if($i == $paginaAtual)
				echo '<a class= "page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-arquivos?pagina='.$i.'">'.$i.'</a>';
			else
				echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-arquivos?pagina='.$i.'">'.$i.'</a>';
		}

	?>
	</div><!--Paginacao-->
</div><!--box-content-->