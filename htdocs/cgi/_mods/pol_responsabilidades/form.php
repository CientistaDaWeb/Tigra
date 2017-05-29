<?php
require_once('responsabilidades.php');
if($id)	{
	$pesquisa = new responsabilidades();
	$pesquisa->busca($id);
	$id_responsabilidade = $pesquisa->id_responsabilidade;
	$titulo = $pesquisa->titulo;
    $linha_apoio = $pesquisa->linha_apoio;
    $texto = $pesquisa->texto;
	$imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_responsabilidade?>" name="id_responsabilidade" id="id_responsabilidade" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Título:</td>
    </tr>
    <tr>
		<td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="Título" value="<?=$titulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Linha de Apio:</td>
    </tr>
    <tr>
		<td><input type="text" name="linha_apoio" id="linha_apoio" maxlength="255" class="inpute gde" title="Linha de Apoio" value="<?=$linha_apoio?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Texto:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="texto" id="texto"><?=$texto?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/responsabilidades/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>