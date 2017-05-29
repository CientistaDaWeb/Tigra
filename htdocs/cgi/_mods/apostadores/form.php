<?php
require_once("apostadores.php");
if($id)	{
	$pesquisa = new apostadores();
	$pesquisa->busca($id);
	$id_apostadore = $pesquisa->id_apostadore;
	$nome = $pesquisa->nome;
	$email = $pesquisa->email;
	$cidade = $pesquisa->cidade;
    $estado = $pesquisa->estado;
    $time_coracao = $pesquisa->time_coracao;
    $vip = $pesquisa->vip;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_apostadore?>" name="id_apostadore" id="id_apostadore" />
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
		<td class="tit_campo">Cidade:</td>
    </tr>
    <tr>
		<td><input type="text" name="cidade" id="cidade" maxlength="255" class="inpute gde obrigatorio" title="Cidade" value="<?=$cidade?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Estado:</td>
    </tr>
    <tr>
        <td><select name="estado" id="estado" class="inpute">
        <?php
        $estados = $con_cliente->query('SELECT * FROM estados ORDER BY estado');
        if($estados && $estados->num_rows > 0){
            while($estadiu = $estados->fetch_assoc()){
            ?>
            <option value="<?=$estadiu['uf']?>" <?php if($estadiu['uf'] == $estado){?>selected="selected"<? }?>><?=utf8_encode($estadiu['estado'])?></option>
            <?php
            }
        }
        ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Time do Coração:</td>
    </tr>
    <tr>
		<td><input type="text" name="time_coracao" id="time_coracao" maxlength="255" class="inpute gde obrigatorio" title="Time do Coração" value="<?=$time_coracao?>" /></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Vip:</td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked', 'unchecked');
	$radio_stat[$vip] = 'checked';
	?>
    <tr>
    	<td class="campo_radio"><label for="radio3" class="radio_<?=$radio_stat[3]?>">Vip</label>
        <input type="radio" name="vip" id="radio3" value="3" class="crirHidden" <?php if($radio_stat[3] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Normal</label>
        <input type="radio" name="vip" id="radio2" value="2" class="crirHidden" <?php if($radio_stat[2] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
</table>
<div class="duascolunas"><label for="enviar_vip">Enviar Aviso de Conta Vip</label><input type="checkbox" name="enviar_vip" id="enviar_vip" value="1" class="crirHiddenJS"/></div>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>