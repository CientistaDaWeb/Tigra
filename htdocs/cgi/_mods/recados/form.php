<?php
require_once("$tg_mod.php");
$data = date('d/m/Y');
$aprovado = 1;
if($id)	{
	$pesquisa = new recados();
	$pesquisa->busca($id);
	$id_recado = $pesquisa->id_recado;
	$nome = $pesquisa->nome;
	$email = $pesquisa->email;
	$recado = $pesquisa->recado;
	$aprovado = $pesquisa->aprovado;
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
<input type="hidden" value="<?=$id_recado?>" name="id_recado" id="id_recado" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><input type="text" name="email" id="email" maxlength="255" class="inpute gde obrigatorio" title="E-mail" value="<?=$email?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Recado:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="recado" id="recado"><?=$recado?></textarea></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Status de Aprovação:</td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked', 'unchecked');
	$radio_stat[$aprovado] = 'checked';	
	?>
    <tr>
    	<td class="campo_radio"><label for="radio3" class="radio_<?=$radio_stat[3]?>">Aguardando Aprovação</label>
        <input type="radio" name="aprovado" id="radio3" value="3" class="crirHidden" <?php if($radio_stat[3] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Aprovado</label>
        <input type="radio" name="aprovado" id="radio2" value="2" class="crirHidden" <?php if($radio_stat[2] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Reprovado</label>
        <input type="radio" name="aprovado" id="radio1" value="1" class="crirHidden" <?php if($radio_stat[1] == 'checked'){?> checked="checked" <?php }?> /></td>
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
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>