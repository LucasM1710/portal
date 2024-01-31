
<?php
	verificaPermissaoMenu(2);
	verificaPermissaoMenuC(1);

	/*if(isset($_GET['deletar'])){
		$idExcluir = (int)$_GET['deletar'];
		Painel::deletar('tb_arquivos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-pastas');
	}*/

	if(isset($_GET['delete'])){
			//queremos deletar algum produto.
			$id = $_GET['delete'];
			$arquivos = MySql::conectar()->prepare("SELECT * FROM `tb_arquivos` WHERE  id = '$id'");
			$arquivos->execute();
			$arquivos = $arquivos->fetchAll();

			$arquivos2 = MySql::conectar()->prepare("SELECT * FROM `tb_padrao` WHERE  id = '$id'");
			$arquivos2->execute();
			$arquivos2 = $arquivos2->fetchAll();

			$arquivos3 = MySql::conectar()->prepare("SELECT * FROM `tb_equipamentos` WHERE  id = '$id'");
			$arquivos3->execute();
			$arquivos3 = $arquivos3->fetchAll();

			$arquivos4 = MySql::conectar()->prepare("SELECT * FROM `tb_calibracao` WHERE  id = '$id'");
			$arquivos4->execute();
			$arquivos4 = $arquivos4->fetchAll();

			MySql::conectar()->exec("DELETE FROM `tb_arquivos` WHERE id = '$id'");
			MySql::conectar()->exec("DELETE FROM `tb_padrao` WHERE id = '$id'");
			MySql::conectar()->exec("DELETE FROM `tb_equipamentos` WHERE id = '$id'");
			MySql::conectar()->exec("DELETE FROM `tb_calibracao` WHERE id = '$id'");
			Painel::alert('sucesso',"A pasta foi deletada com sucesso");
			$redirect = $_SERVER['HTTP_REFERER'];
			Painel::redirect($redirect);
	}

	else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_pastas',$_GET['order'],$_GET['id']);
	}

	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$arquivo = Painel::select('tb_pastas','id = ?',array($id));

	}
	else{
		Painel::alert('erro','Você precisa de um parâmeto ID.');
		die();
	}


	
	


	/*$query = "SELECT * FROM tb_arquivos WHERE `pasta_id` = '$value' && '$value'!= 'Padroes'";*/
	


?>


<div class="box-content">
    <div class="botao-adds">
    	<a <?php selecionadoMenu('adicionar-arquivo');?> href="<?php echo INCLUDE_PATH_PAINEL?>tipo-arquivoc?id=<?php echo $arquivo['id']; ?>"><i class="fas fa-copy"></i> Adicionar arquivos nesta pasta</a>
    </div>
    <br/>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder ="Procure por: Titulo..."type = "text" name = "busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->


	<?php
			/*$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$quebra = explode('/',$url);
			foreach ($quebra as $key => $value) {
				echo $value;
				echo '<br/>';

			}
			$url5 = explode('?',$quebra[5]);
			foreach ($url5 as $key => $value) {
				echo $value;
				echo '<br/>';
			}
			$urlid = explode('=',$url5[1]);
			foreach ($urlid as $key => $value) {
				echo $value;
				echo '<br/>';
			}
			
			$idc = $urlid[1];
			echo $idc;*/
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
			<td>Empresa</td>
			<td style="text-align: center">Ações</td>
			<td></td>
			

		</tr>

		<?php
			foreach ($arquivos as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
            ?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
                ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a>
			<a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-arquivo?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Pasta" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>pastas-adm?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>


		</tr>

		<?php }?>


		<?php
			foreach ($arquivos2 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
            ?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
                ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a>
			<a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-padrao?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Pasta" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>pastas-adm?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>


		</tr>

		<?php }?>


		<?php
			foreach ($arquivos3 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
            ?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
                ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a>
			<a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-equipamento?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Pasta" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>pastas-adm?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>


		</tr>

		<?php }?>


		<?php
			foreach ($arquivos4 as $key => $value) {
			//$nomePasta = Painel::select('tb_pastas','id=?',array($value['pasta_id']))['nome'];
			

					
				
				
					
		?>
		
		<tr>
			<td title="<?php echo $value['titulo'];?>"><i class="fas fa-file-alt"></i> <?php if(strlen($value['titulo']) > 15){
					echo mb_substr($value['titulo'], 0,15)."...";	
				}else{
					echo $value['titulo'];
				}
            ?></td>
			<td><?php echo $value ['descricao']; ?></td>
			<td><?php if(strlen($value['pasta']) > 15){
					echo mb_substr($value['pasta'], 0,15)."...";	
				}else{
					echo $value['pasta'];
				}
                ?></td>
			<td style="text-align: center;"><a title="Abrir Arquivo" style = "text-decoration:none; color:white; background: #fa9d23; font-size: 20px; padding: 5px 20px;"target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['arquivo']; ?>"><i class="fas fa-folder-open"></i></a>
			<a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-calibracao?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a a title="Excluir Pasta" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>pastas-adm?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>


		</tr>

		<?php }?>
	</table>
	<a <?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas"><i class="fas fa-arrow-left"></i> Voltar</a>
	
</div>

</div>
