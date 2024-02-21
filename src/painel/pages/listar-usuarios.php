
<?php
	verificaPermissaoMenu(2);
	verificaPermissaoMenuC(1);

?>
<?php

	if(isset($_GET['delete'])){
		$idExcluir = (int)$_GET['delete'];
		Painel::deletar('tb_usuarios',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-usuarios');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_usuarios',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	//$porPagina = 5;

	//$pastas2 = Painel::selectAll('tb_pastas',($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px; "><i style = "color:#fa9d23 ;"class="fas fa-users"></i> Usuários</h2>
	<br/>
	<div class="botao-add">
	<a <?php selecionadoMenu('adicionar-usuario');?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario"><i class="fas fa-user-plus"></i>  Adicionar Usuário</a>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder ="Procure por: Id, Nome, Empresa..."type = "text" name = "busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	
	<div class="boxes">
	<?php
		$porPagina = 99999;
		$query = "SELECT * FROM tb_usuarios";

	

		if(isset($_POST['acao'])){


			$busca = $_POST['busca'];
			$query .= " WHERE id LIKE '%$busca%' OR Nome LIKE '%$busca%' OR Empresa LIKE '%$busca%' OR Tipo LIKE '%$busca%' ";
			
		
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
					$usuario = $sql->fetchAll();

				if(isset($_POST['acao'])){
					echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($usuario).' resultado(s)</b></p></div>';
				}
			
		
	?>
	</div>
	

	<div class ="wraper-table">
	<table>
		<tr>
			<td>Id</td>
			<td>Nome</td>
			<td>Empresa</td>
			<td>Tipo</td>
			<td>Status</td>
			<td style="text-align: center">Ações</td>
		</tr>

		<?php
			foreach ($usuario as $key => $value) {
			//$nomePasta = Painel::select('tb_usuarios','id=?',array($value['Empresa']))['Empresa'];
					
						

				
					
		?>
		
		<tr>
			<td><?php echo $value ['id']; ?></td>
			<td><?php if(strlen($value['Nome']) > 19){
					echo mb_substr($value['Nome'], 0,19)."...";	
				}else{
					echo $value['Nome'];
				}
			?></td>
			<td><?php if(strlen($value['Empresa']) > 19){
					echo mb_substr($value['Empresa'], 0,19)."...";	
				}else{
					echo $value['Empresa'];
				}
			?>
				
			</td>
			<td><?php if($value['tipo'] == 2){
						echo 'Administrador';
					}else{
						echo 'Cliente';
					}	
				?></td>
			<td><?php echo $value ['Status']; ?></td>
			<td style="text-align: center;"><a title="Visualizar Dados" class="btn edit" style="background: #e6e600; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-usuario?id=<?php echo $value['id'];?>"><i class="fas fa-eye"></i></i></a>
			<a title="Alterar Dados" class="btn edit" style="background: #00284f; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL ?>alterar-usuario?id=<?php echo $value['id'];?>"><i class="fas fa-highlighter"></i></a>
			<a title="Excluir Usuário" actionBtn="delete" class="btn delete" style="background: red; font-size: 20px; padding: 5px 20px;" href="<?php echo INCLUDE_PATH_PAINEL?>listar-usuarios?delete=<?php echo $value['id']; ?>"><i class="fas fa-times"></i></a></td>

		</tr>
		<?php }?>
	
		
	</table>
</div>


	<div class="paginacao">
	<?php
		$totalPaginas = ceil(count(Painel::selectAll('tb_usuarios'))/$porPagina);
		for($i = 1; $i <= $totalPaginas; $i++){
			if($i == $paginaAtual)
				echo '<a class= "page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-usuarios?pagina='.$i.'">'.$i.'</a>';
			else
				echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-usuarios?pagina='.$i.'">'.$i.'</a>';
		}

	?>
	</div><!--Paginacao-->
</div><!--box-content-->