<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new anotacoes();
	$pesquisa->busca($id);
	$id_anotacoe = $pesquisa->id_anotacoe;
	$titulo = $pesquisa->titulo;
	$texto = $pesquisa->texto;
	$data = ajustadata($pesquisa->data,'site');
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_anotacoe?>" name="id_anotacoe" id="id_anotacoe" />
<table id="formulario">
	<tr>
		<td class="tit_campo">T&iacute;tulo:</td>
    </tr>
    <tr>
		<td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$titulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Anota&ccedil;&atilde;o:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" title="Anota&ccedil;&atilde;o" name="texto" id="texto"><?=$texto?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">Data:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>