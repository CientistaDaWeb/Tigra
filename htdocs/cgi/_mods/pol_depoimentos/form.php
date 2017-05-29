<?php
require_once('depoimentos.php');
if($id)	{
	$pesquisa = new depoimentos();
	$pesquisa->busca($id);
	$id_depoimento = $pesquisa->id_depoimento;
	$nome = $pesquisa->nome;
	$cargo = $pesquisa->cargo;
	$depoimento = $pesquisa->depoimento;
	$imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_depoimento?>" name="id_depoimento" id="id_depoimento" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cargo:</td>
    </tr>
    <tr>
		<td><input type="text" name="cargo" id="cargo" maxlength="255" class="inpute gde obrigatorio" title="Cargo" value="<?=$cargo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Depoimento:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="depoimento" id="depoimento"><?=$depoimento?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
		<img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/depoimentos/<?=$imagem?>" /><br>
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