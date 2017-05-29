<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new anunciantes();
	$pesquisa->busca($id);
	$id_anunciante = $pesquisa->id_anunciante;
	$anunciante = $pesquisa->anunciante;
	$contato = $pesquisa->contato;
	$telefone = $pesquisa->telefone;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#telefone").mask("(99) 9999-9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_anunciante?>" name="id_anunciante" id="id_anunciante" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Anunciante:</td>
    </tr>
    <tr>
		<td><input type="text" name="anunciante" id="anunciante" maxlength="255" class="inpute gde obrigatorio" title="anunciante" value="<?=$anunciante?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Contato:</td>
    </tr>
    <tr>
		<td><input type="text" name="contato" id="contato" maxlength="255" class="inpute gde" title="contato" value="<?=$contato?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone:</td>
    </tr>
    <tr>
		<td><input type="text" name="telefone" id="telefone" maxlength="255" class="inpute medio" title="Telefone" value="<?=$telefone?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>
