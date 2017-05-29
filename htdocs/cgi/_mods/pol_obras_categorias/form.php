<?php
require_once("obras_categorias.php");
if($id)	{
	$pesquisa = new obras_categorias();
	$pesquisa->busca($id);
	$id_obras_categoria = $pesquisa->id_obras_categoria;
	$categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_obras_categoria?>" name="id_obras_categoria" id="id_obras_categoria" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>