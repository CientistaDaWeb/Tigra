<?php
require_once("$tg_mod.php");
if($id){
	$pesquisa = new agenda_telefones();
	$pesquisa->busca($id);
	$id_agenda_telefone = $pesquisa->id_agenda_telefone;
	$nome = $pesquisa->nome;
	$empresa = $pesquisa->empresa;
	$tel_res = $pesquisa->tel_res;
	$tel_com = $pesquisa->tel_com;
	$tel_cel = $pesquisa->tel_cel;
	$email = $pesquisa->email;
	$status = $pesquisa->status;
	$fk_tg_usuario = $pesquisa->fk_tg_usuario;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#tel_res").mask("(99) 9999-9999");
	$("#tel_com").mask("(99) 9999-9999");
	$("#tel_cel").mask("(99) 9999-9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_agenda_telefone?>" name="id_agenda_telefone" id="id_agenda_telefone" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Empresa:</td>
    </tr>
    <tr>
		<td><input type="text" name="empresa" id="empresa" maxlength="255" class="inpute gde" title="Empresa" value="<?=$empresa?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><input type="text" name="email" id="email" maxlength="255" class="inpute gde" title="E-mail" value="<?=$email?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Residencial:</td>
    </tr>
    <tr>
		<td><input type="text" name="tel_res" id="tel_res" maxlength="255" class="inpute medio" title="Telefone Residencial" value="<?=$tel_res?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Comercial:</td>
    </tr>
    <tr>
		<td><input type="text" name="tel_com" id="tel_com" maxlength="255" class="inpute medio" title="Telefone Comercial" value="<?=$tel_com?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Celular:</td>
    </tr>
    <tr>
		<td><input type="text" name="tel_cel" id="tel_cel" maxlength="255" class="inpute medio" title="Telefone Celular" value="<?=$tel_cel?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>