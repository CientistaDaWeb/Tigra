<?php
require_once('revestimentos.php');
require_once('_mods/deluse_revestimentos_categorias/revestimentos_categorias.php');
$id_revestimentos_categoria = $_SESSION['del_cat'];
if($id){
	$pesquisa = new revestimentos();
	$pesquisa->busca($id);
	$id_revestimento = $pesquisa->id_revestimento;
	$revestimento = $pesquisa->revestimento;
	$imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post"
	enctype="multipart/form-data" id="form_edicao"
	onsubmit="return ween_validator()"><input type="hidden"
	value="<?=$id_revestimento?>" name="id_revestimento"
	id="id_revestimento" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome do revestimento:</td>
	</tr>
	<tr>
		<td><input id="revestimento" name="revestimento" class="inpute gde obrigatorio" value="<?=$revestimento?>" /></td>
	</tr>
	<tr>
		<td class="tit_campo">Imagem:</td>
	</tr>
	<tr>
		<td><?php
		if($imagem){
			$ob = 'inpute';
			?> <img
			src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img/revestimentos/thumbs/<?=$imagem?>" /><br />
			<?php
		}else{
			$ob = 'inpute obrigatorio';
		}

		?> <input type="file" name="imagem" id="imagem" class="<?=$ob?>"></td>
	</tr>
</table>
<table id="table_botoes_rodape">
	<tr>
		<td><input type="submit" value="Salvar" id="bt_salvar" /></td>
		<td><input type="button" value="Cancelar"
			onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'"
			id="bt_cancelar" /></td>
	</tr>
</table>
</form>
