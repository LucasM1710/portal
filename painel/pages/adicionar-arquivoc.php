<?php
	verificaPermissaoMenu(2);
	verificaPermissaoMenuC(1);
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
	<a <?php selecionadoMenu('listar-pastas');?> href="<?php echo INCLUDE_PATH_PAINEL?>pastas-adm?id=<?php echo $arquivo['id']; ?>"><i class="fas fa-arrow-left"></i> Voltar</a>
	<br/>
	<br/>
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;"class="fas fa-copy"></i> Adicionar arquivo</h2>

	<?php
		$qtd = array(1 => '1', 2 =>'2', 3 =>'3', 4 =>'4', 5 =>'5', 6 =>'6', 7 =>'7', 8 =>'8', 9 =>'9', 10 =>'10', 11 =>'11', 12 =>'12', 13 =>'13', 14 =>'14', 15 => '15', 16 => '16', 17 =>'17', 18 =>'18', 19 =>'19', 20 =>'20');
		

	?>
	
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Pasta: </label>
			<input style="background: #d6d6d6;" readonly="readonly" type="text" name="pasta_id" value="<?php echo $arquivo['nome'];?>" >
		</div><!--form-group-->
		<div class="form-group">
			<label>Informe a quantidade de registros: </label>
			<select name="quantidade" id="pasta3">	
				 <?php
				    foreach($qtd as $n=>$m){

				        $selected = (isset($_POST['quantidade']) && $_POST['quantidade'] == $n) ? 'selected' : '';

				        echo '<option value="'.$n.'" '.$selected.'>'.$m.'</option>';
				    }
    			?>
			</select>
		</div><!--form-group-->
		<div class="form-group">
			<input style="background: #fa9d23;" type="submit" value="Upload" name="acao2">
		</div><!--form-group-->
		<?php
		    if(isset($_POST['acao'])){
		
		?>
		<div class="adicionar-arquivo">
			<a style="background:#fa9d23; width:40px; color:white; text-decoration:none; padding: 9px 9px; "href="<?php echo $_SERVER['HTTP_REFERER']?>">Adicionar mais arquivos para esta pasta</a>
		</div>
		<?php }?>
		<br/>
		<br/>

		<?php
			//ini_get("max_file_uploads");	
			if (isset($_POST['acao']) || (@$_POST['acao2'])) {
				
			
				
				
		
			//if(isset($_POST['acao2'])){
				$quantidade = $_POST['quantidade'];


			


			for ($i=0; $i < $quantidade; $i++) { 
			//echo $quantidade;
				
			
		?>

		<?php echo $i;?>
		<script type="text/javascript">
			$(document).ready( function(){
		    $('#input-<?php echo $i;?>').blur(function (e) {
		        //var patt = /([0-9]{1,2}[0-9]{2})/;
		        // Testando se o valor digitado já é algo como nn:nn
		       // if (patt.test(e.target.value)) {
		            var strsplit = e.target.value;
		            var hora = strsplit.replace(/^.*\\/, "");
		            var texto = hora.substring(0, hora.length - 4);
		         
		            var stringfinal = '';
		            // ex. se hora = 24 então vira 00, se hora = 25 então vira 01;
		         
		            stringfinal += texto;
		            $('#inp-<?php echo $i;?>').val(stringfinal);
		        //} else {
		            // Faz nada...   
		        //}
		    });
		});
		</script>
		<div class="form-group" >		
			<label>Arquivo: </label>
			<input style="background: #045a88; color:white;" id="input-<?php echo $i;?>" type="file"name="arquivo[]" required />
		</div><!--form-group-->	

		<div class="form-group">
			<label>Título: </label>
			<input id="inp-<?php echo $i;?>" type="text" name="titulo[]">
		</div><!--form-group-->

		<div class ="form-group">
		<label>Descrição: </label>
		<select name="descricao[]">
			<option>Certificado de Calibração</option>
			<option>Certificado do Padrão</option>
			<option>Controle de Equipamentos</option>
		</select>
		</div>
		
		<?php 
				
			
				if(isset($_POST['acao'])){
				
				$titulo = $_POST['titulo'];
				$descricao = $_POST['descricao'];
				$novo_nome =  $_FILES['arquivo'];
				$pasta_id = $_POST['pasta_id'];
				$data = date('d/m/Y H:i');
				

					

				if($titulo[$i] == ''){
					Painel::alert('erro',' O título está vazio!');
				}else if($descricao == ''){
					Painel::alert('erro',' A descricao está vazia!');
				}
			
					//Podemos cadastrar!
					else{
						//Apenas cadastrar no banco de dados!
						$novo_nome = $_FILES['arquivo']['name'][$i];

						$original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*_+={[}]/?;:,\\\'<>°ºª';
			   			$substituir = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';	
						$novo_nome = strtr(utf8_decode($novo_nome), utf8_decode($original), $substituir);
						//$novo_nome = md5(time()). $extensao;
						$diretorio = "uploads/";

						move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], $diretorio.$novo_nome);

						$sql = MySql::conectar()->prepare("INSERT INTO `tb_arquivos` (id, titulo, descricao, arquivo, pasta_id, data) VALUES (null,'$titulo[$i]','$descricao[$i]','$novo_nome','$pasta_id','$data')");
						$sql->execute(array($titulo[$i],$descricao[$i],$novo_nome,$pasta_id,$data));
						Painel::alert('sucesso',' O cadastro  do arquivo '.$titulo[$i].' foi feito com sucesso!');
					
						
					
						}
						
					}

				}
					
					
			
			
		?>
		
		
		
		<div class="form-group">

			<input style="background: #045a88;" type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	
	</form>
	<?php }?>	


</div>
