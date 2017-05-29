<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new noticias();
	$pesquisa->busca($id);
	$id_noticia = $pesquisa->id_noticia;
	$titulo = $pesquisa->titulo;
	$texto = $pesquisa->texto;
	$imagem = $pesquisa->imagem;
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
<input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Titulo:</td>
    </tr>
    <tr>
		<td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$titulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Texto:</td>
    </tr>
    <tr>
		<td><textarea name="texto" class="inpute" id="texto" rows="5"><?=$texto?></textarea></td>
    </tr>
	<tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/noticias/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
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
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>