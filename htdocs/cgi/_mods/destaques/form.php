<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new destaques();
	$pesquisa->busca($id);
	$id_destaque = $pesquisa->id_destaque;
	$titulo = $pesquisa->titulo;
	$descricao = $pesquisa->descricao;
	$resumo_texto = $pesquisa->resumo_texto;
	$imagem = $pesquisa->imagem;	
	$data = ajustadata($pesquisa->data,"site");
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_destaque?>" name="id_destaque" id="id_destaque" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Título</td>
    </tr>
    <tr>
		<td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="Título" value="<?=$titulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Resumo do Texto</td>
    </tr>
    <tr>
		<td><input type="text" name="resumo_texto" id="resumo_texto" maxlength="80" class="inpute gde" title="Resumo do Texto" value="<?=$resumo_texto?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/destaques/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Data de Expiração:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data de Expiração" value="<?=$data?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>