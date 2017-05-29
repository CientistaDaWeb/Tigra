<?php
require_once("informativos.php");
if($id)	{
	$pesquisa = new informativos();
	$pesquisa->busca($id);
    $id_informativo = $pesquisa->id_informativo;
	$nome = $pesquisa->nome;
    $mes = $pesquisa->mes;
	$ano = $pesquisa->ano;
	$descricao = $pesquisa->descricao;
    $arquivo = $pesquisa->arquivo;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#ano").mask("9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_informativo?>" name="id_informativo" id="id_informativo" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Mês:</td>
    </tr>
    <tr>
		<td><input type="text" name="mes" id="mes" maxlength="255" class="inpute gde obrigatorio" title="Mês" value="<?=$mes?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Ano:</td>
    </tr>
    <tr>
		<td><input type="text" name="ano" id="ano" maxlength="255" class="inpute pqno obrigatorio" title="Ano" value="<?=$ano?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição::</td>
    </tr>
    <tr>
		<td><textarea name="descricao" class="inpute" id="descricao" rows="5"><?=$descricao?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Arquivo:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($arquivo){
		?>
        <a href="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/informativos/<?=$arquivo?>" title="Baixar <?=$arquivo?>"><?=$arquivo?></a><br />
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