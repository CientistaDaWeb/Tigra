<?php
require_once("$tg_mod.php");
$url = 'http://';
if($id)	{
	$pesquisa = new portifolios();
	$pesquisa->busca($id);
	$id_portifolio = $pesquisa->id_portifolio;
	$cliente = $pesquisa->cliente;
	$descricao = $pesquisa->descricao;
	$url = $pesquisa->url;
	$data = ajustadata($pesquisa->data,'site');
	$imagem = $pesquisa->imagem;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script>
$(document).ready(function(){
   	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_portifolio?>" name="id_portifolio" id="id_portifolio" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Cliente:</td>
    </tr>
    <tr>
		<td><input type="text" name="cliente" id="cliente" maxlength="255" title="Cliente" class="inpute gde obrigatorio" value="<?=$cliente?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">URL:</td>
    </tr>
    <tr>
		<td><input type="text" name="url" id="url" maxlength="255" title="URL" class="inpute gde obrigatorio" value="<?=$url?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="255" title="Data" class="inpute pqno obrigatorio" value="<?=$data?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/portifolios/thumb/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição:</td>
    </tr>
    <tr>
		<td><textarea name="descricao" class="inpute obrigatorio" id="descricao" rows="5"><?=$descricao?></textarea></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>