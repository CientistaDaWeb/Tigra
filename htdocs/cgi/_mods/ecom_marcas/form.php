<?php
require_once("marcas.php");
if($id)	{
	$pesquisa = new marcas();
	$pesquisa->busca($id);
	$id_marca = $pesquisa->id_marca;
	$marca = $pesquisa->marca;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_marca?>" name="id_marca" id="id_marca" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Marca:</td>
    </tr>
    <tr>
		<td><input type="text" name="marca" id="marca" maxlength="255" class="inpute gde obrigatorio" title="Marca" value="<?=$marca?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>