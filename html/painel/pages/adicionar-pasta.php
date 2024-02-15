<?php
	verificaPermissaoMenu(2);

?>
<div class="box-content">
	<br/>
	<h2 style="position: relative; bottom:10px;"><i style="color:#fa9d23;" class="fas fa-folder-plus"></i> Adicionar Pastas</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$status = $_POST['status'];

				 if($nome == ''){
					Painel::alert('erro',' O nome está vazio!');
				}
				else if (strpos($nome, ',') == true) {
				    Painel::alert('erro',' Ops, caracter inválido ","');
				}
				else if($status == ''){
					Painel::alert('erro',' O status está vazio!');
				}
				else if(Pastas::pastsExists($nome)){
					Painel::alert('erro',' A pasta com esse nome já está cadastrada.');
				}
				else{
				//Apenas cadastrar no banco de dados!
					$pasta = new Pastas();
					$pasta->cadastrarPastas($nome,$status);
					Painel::alert('sucesso',' O cadastro  da pasta '.$nome.' foi feito com sucesso!');
					}
				}
		
		?>
	
		<div class="form-group">
			<label>Nome: </label>
			<input type="text" name="nome" required>
		</div><!--form-group-->

		<div class ="form-group">
		<label>Status:</label>
		<select name="status">
			<option>Ativo</option>
			<option>Inativo</option>
		</select>
		</div>

		<div class="form-group">
			<input style="background:#045a88; font-weight: bold;" type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->

	</form>
	


</div>