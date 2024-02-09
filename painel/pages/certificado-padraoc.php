<?php
	verificaPermissaoMenu(2);
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

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;"class="fas fa-copy"></i> Adicionar Certificado de Padrão</h2>
	
	<form method="post" enctype="multipart/form-data">
		  <?php
		    if(isset($_POST['acao'])){
		
			?>

			<div class="adicionar-arquivo">
				<a style="background:#fa9d23; width:40px; color:white; text-decoration:none; padding: 9px 9px; "href="<?php echo $_SERVER['HTTP_REFERER']?>">Adicionar mais arquivos</a>
			</div>
			<br/>
			<br/>
			<?php }?>
		<?php
			if(isset($_POST['acao'])){
				$pasta_id = $_POST['pasta_id'];
				$arquivos = array();
				$amountFiles = count($_FILES['imagem']['name']);
				$data = date('d/m/Y H:i');
				$descricao = "Certificado do Padrão";

				$sucesso = true;

			if($amountFiles > 19){
				$sucesso = false;
				Painel::alert('erro',' Você pode realizar upload de até 19 arquivos simultâneos');
			}
			else{
			if($_FILES['imagem']['name'][0] != ''){

			for($i =0; $i < $amountFiles; $i++){
				$arquivoAtual = ['type'=>$_FILES['imagem']['type'][$i],
				'size'=>$_FILES['imagem']['size'][$i]];
				
			}

			}else{
				$sucesso = false;
				Painel::alert('erro',' Você precisa selecionar pelo menos um arquivo!');
			}
		


			if($sucesso){
				//TODO: Cadastrar informacoes e imagens e realizar upload.
				for($i =0; $i < $amountFiles; $i++){
					$arquivoAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
						'name'=>$_FILES['imagem']['name'][$i]];
					$arquivos[] = Painel::uploadArquivo($arquivoAtual);
				}

		
				foreach ($arquivos as $key => $value) {
					MySql::conectar()->exec("INSERT INTO `tb_padrao` VALUES (null,'$value','$value','$descricao','$pasta_id','$data')");
				}
				Painel::alert('sucesso',' Upload realizado com sucesso!');
			}
		}
			
	}
		?>
		<div class="form-group">
			<label>Pasta: </label>
			<input style="background: #d6d6d6;" readonly="readonly" type="text" name="pasta_id" value="<?php echo $arquivo['nome'];?>" >
		</div><!--form-group-->
		<div class="form-group">
			<label>Selecione os arquivos:</label>
			<input multiple type="file" name="imagem[]">
		</div><!--form-group-->
		<div class="form-group">

			<input style="background: #045a88;" type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>

	<a href="<?php echo INCLUDE_PATH_PAINEL?>tipo-arquivoc?id=<?php echo $arquivo['id']; ?>"><i class="fas fa-arrow-left"></i> Voltar</a>

</div>
