<?php
require_once("premios_classificacoes.php");
if($id)	{
	$pesquisa = new premios_classificacoes();
	$pesquisa->busca($id);
	$id_premios_classificacoe = $pesquisa->id_premios_classificacoe;
    $classificacao = $pesquisa->classificacao;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_premios_classificacoe?>" name="id_premios_classificacoe" id="id_premios_classificacoe" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Classificação:</td>
    </tr>
    <tr>
		<td><input type="text" name="classificacao" id="classificacao" maxlength="255" class="inpute gde obrigatorio" title="Classificação" value="<?=$classificacao?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>