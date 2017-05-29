<?php
require_once("$tg_mod.php");
$link = 'http://';
if($id)	{
	$pesquisa = new clientes();
	$pesquisa->busca($id);
	$id_cliente = $pesquisa->id_cliente;
	$cliente = $pesquisa->cliente;
	$link = $pesquisa->link;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_cliente?>" name="id_cliente" id="id_cliente" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Cliente:</td>
    </tr>
    <tr>
		<td><input type="text" name="cliente" class="inpute gde obrigatorio" id="cliente" title="Cliente" value="<?=$cliente?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Link:</td>
    </tr>
    <tr>
		<td><input type="text" name="link" class="inpute medio" id="link" title="Link" value="<?=$link?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>