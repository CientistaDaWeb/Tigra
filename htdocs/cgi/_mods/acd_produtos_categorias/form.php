<?php
require_once("produtos_categorias.php");
if($id)	{
	$pesquisa = new produtos_categorias();
	$pesquisa->busca($id);
	$id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $categoria_pt = $pesquisa->categoria_pt;
    $categoria_es = $pesquisa->categoria_es;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_produtos_categoria?>" name="id_produtos_categoria" id="id_produtos_categoria" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria_pt" id="categoria_pt" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria_pt?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Categoria (Espanhol):</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria_es" id="categoria_es" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria_es?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>