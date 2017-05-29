<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new parceiros();
	$pesquisa->busca($id);
	$id_parceiro = $pesquisa->id_parceiro;
	$parceiro = $pesquisa->parceiro;
	$imagem = $pesquisa->imagem;
	$url_site = $pesquisa->url_site;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_parceiro?>" name="id_parceiro" id="id_parceiro" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome do Parceiro</td>
    </tr>
    <tr>
		<td><input type="text" name="parceiro" id="parceiro" maxlength="255" class="inpute gde obrigatorio" title="Nome do Parceiro" value="<?=$parceiro?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/parceiros/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Site</td>
    </tr>
    <tr>
		<td><input type="text" name="url_site" id="url_site" maxlength="80" class="inpute gde" title="Site" value="<?=$url_site?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>