<?php
require_once("materias_categorias.php");
if($id)	{
	$pesquisa = new materias_categorias();
	$pesquisa->busca($id);
	$id_materias_categoria = $pesquisa->id_materias_categoria;
	$categoria = $pesquisa->categoria;
	$cat = $pesquisa->cat;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_materias_categoria?>" name="id_materias_categoria" id="id_materias_categoria" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Categoria para links:</td>
    </tr>
    <tr>
		<td><input type="text" name="cat" id="cat" maxlength="255" class="inpute gde obrigatorio" title="Categoria para links" value="<?=$cat?>" /></td>
    </tr>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>