<?php
require_once("clippings.php");
if($id)	{
	$pesquisa = new clippings();
	$pesquisa->busca($id);
    $id_clipping = $pesquisa->id_clipping;
	$assunto = $pesquisa->assunto;
    $data = ajustadata($pesquisa->data,'site');
	$midia = $pesquisa->midia;
    $local = $pesquisa->local;
    $link = $pesquisa->link;
    $arquivo = $pesquisa->arquivo;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_clipping?>" name="id_clipping" id="id_clipping" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Assunto:</td>
    </tr>
    <tr>
		<td><input type="text" name="assunto" id="assunto" maxlength="255" class="inpute gde obrigatorio" title="Assunto" value="<?=$assunto?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Mídia:</td>
    </tr>
    <tr>
		<td><input type="text" name="midia" id="midia" maxlength="255" class="inpute gde obrigatorio" title="Mídia" value="<?=$midia?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Local:</td>
    </tr>
    <tr>
		<td><input type="text" name="local" id="local" maxlength="255" class="inpute gde obrigatorio" title="Local" value="<?=$local?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Link:</td>
    </tr>
    <tr>
		<td><input type="text" name="link" id="link" maxlength="255" class="inpute gde" title="Link" value="<?=$link?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Arquivo:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($arquivo){
		?>
        <a href="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/clippings/<?=$arquivo?>" title="Baixar <?=$arquivo?>"><?=$arquivo?></a><br />
        <?php
		}
		?>
        <input type="file" name="arquivo" id="arquivo" class="inpute">
        </td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>