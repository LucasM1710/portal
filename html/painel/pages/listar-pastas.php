
<?php
	verificaPermissaoMenu(2);
	verificaPermissaoMenuC(1);

?>
<?php

	/*if(isset($_GET['delete'])){
		$idExcluir = (int)$_GET['delete'];
		Painel::deletar('tb_pastas',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-pastas');
	}*/
	if(isset($_GET['delete'])){
			//queremos deletar algum produto.
			$nome = $_GET['delete'];
			$pasta = MySql::conectar()->prepare("SELECT * FROM `tb_pastas` WHERE  nome = '$nome'");
			$pasta->execute();
			$pasta = $pasta->fetchAll();
			
			MySql::conectar()->exec("DELETE FROM `tb_pastas` WHERE nome = '$nome'");
			MySql::conectar()->exec("DELETE FROM `tb_arquivos` WHERE pasta = '$nome'");
			MySql::conectar()->exec("DELETE FROM `tb_padrao` WHERE pasta = '$nome'");
			MySql::conectar()->exec("DELETE FROM `tb_equipamentos` WHERE pasta = '$nome'");
			MySql::conectar()->exec("DELETE FROM `tb_calibracao` WHERE pasta = '$nome'");
			Painel::alert('sucesso',"A pasta foi deletada com sucesso");
	}


	else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_pastas',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	//$porPagina = 5;

	//$pastas2 = Painel::selectAll('tb_pastas',($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
	<h2 style="position: relative; bottom:10px;">
<!-- Generator: Adobe Illustrator 25.3.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg style="width: 50px; height: 50px; position: relative; top: 15px;"version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 1122 1122" style="enable-background:new 0 0 1122 1122;" xml:space="preserve">
<style type="text/css">
	.st0{fill:#FFFFFF;}
	.st1{fill:#FFD559;}
	.st2{fill:#EBB044;}
</style>
<g id="Bg">
	<g>
		<g>
			<rect class="st0" width="1122" height="1122"/>
		</g>
	</g>
</g>
<g id="Object">
	<g id="XMLID_955_">
		<g id="XMLID_956_">
			<g id="XMLID_957_">
				<g id="XMLID_960_">
					<path class="st1" d="M561.06,306.98v-9.65c0-15.67-13.04-28.38-29.13-28.38H228.24c-16.09,0-29.13,12.71-29.13,28.38v511.72
						H923V335.36c0-15.67-13.04-28.38-29.13-28.38H561.06z"/>
				</g>
				<g id="XMLID_959_">
					<rect x="231.25" y="347.88" class="st0" width="666.38" height="466.37"/>
				</g>
				<g id="XMLID_958_">
					<path class="st2" d="M550.74,406.19l-10.75,29.03H228.24c-16.09,0-29.13,12.71-29.13,28.38V824.9
						c0,15.67,13.04,28.38,29.13,28.38h665.63c16.09,0,29.13-12.71,29.13-28.38V415.82c0-15.67-13.04-28.38-29.13-28.38H578.13
						C565.86,387.44,554.9,394.94,550.74,406.19z"/>
				</g>
			</g>
		</g>
	</g>
</g>
</svg> Pastas</h2>
	<br/>
	<div class="botao-add">
	<a <?php selecionadoMenu('adicionar-pasta');?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-pasta"><i class="fas fa-folder-plus"></i> Adicionar Pasta</a>
	</div>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder ="Procure por: nome, id, status('Ativo/Inativo')..."type = "text" name = "busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	
	<div class="boxes">
	<?php
		$porPagina = 5;
		$query = "SELECT * FROM `tb_pastas`";
		if(isset($_POST['acao'])){


			$busca = $_POST['busca'];
			$query .= " WHERE nome LIKE '%$busca%' OR id LIKE '%$busca%'  OR status LIKE '$busca'";
		
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
					$pastas = $sql->fetchAll();

				if(isset($_POST['acao'])){
					echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($pastas).' resultado(s)</b></p></div>';
				}
			
		
	?>
	</div>
	

	<div class ="wraper-table">
	<table>
		<tr>
			<td>Id</td>
			<td>Nome</td>
			<td>Status</td>
			<td style="text-align: center">Ações</td>
		</tr>

		<?php
			foreach ($pastas as $key => $value) {
				
					
						
					
				
				
					
		?>
		
		<tr>
			<td><?php echo $value ['id']; ?></td>
			<td><a style="text-decoration: none;" href="<?php echo INCLUDE_PATH_PAINEL ?>pastas-adm?id=<?php echo $value['id'];?>"><i class="fas fa-folder-open"></i> <?php echo $value ['nome']; ?></td></a>
			<td><?php echo $value ['status']; ?></td>
			<td style="text-align: center;">
			<a a title="Excluir Pasta" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-pastas?delete=<?php echo $value['nome']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>
	
		
	</table>
</div>


	<div class="paginacao">
	<?php
		$totalPaginas = ceil(count(Painel::selectAll('tb_pastas'))/$porPagina);
		for($i = 1; $i <= $totalPaginas; $i++){
			if($i == $paginaAtual)
				echo '<a class= "page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-pastas?pagina='.$i.'">'.$i.'</a>';
			else
				echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-pastas?pagina='.$i.'">'.$i.'</a>';
		}

	?>
</div>
	
</div><!--box-content-->