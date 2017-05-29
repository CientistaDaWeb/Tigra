<?php
$status = 1;
require_once("$tg_mod.php");
if($id)	{
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
if(($fk_tg_usuario == $_SESSION['id_tg_usuario']) || !$id_agenda_telefone){
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("radio").change(function () {
          var str = "";
          $("radio checked:checked").each(function () {
                alert("");
              });
        })
        .change();
					   

	$("#tel_res").mask("(99) 9999-9999");
	$("#tel_com").mask("(99) 9999-9999");
	$("#tel_cel").mask("(99) 9999-9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_agenda_telefone?>" name="id_agenda_telefone" id="id_agenda_telefone" />
<table id="formulario">
	<tr>
	  <td class="tit_campo"><fieldset>
        <legend>Tipo de pessoa:</legend>
        <div class="campo_radio">
        <label for="radio1" class="radio_<?=$radio_stat[1]?>">Jur&iacute;dica</label>
        <input type="radio" name="status" id="radio1" value="1" class="crirHidden" checked="<?=$radio_stat[1]?>"/>
        </div>
        <div class="campo_radio">
		<label for="radio2" class="radio_<?=$radio_stat[2]?>">F&iacute;sica</label>
        <input type="radio" name="status" id="radio2" value="2" class="crirHidden" checked="<?=$radio_stat[2]?>" />
        </div>
	  </fieldset></td>
    </tr>
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
		<td class="tit_campo">CNPJ</td>
    </tr>
    <tr>
		<td><input type="text" name="nome2" id="nome2" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Inscri&ccedil;&atilde;o Estadual</td>
    </tr>
    <tr>
		<td><input type="text" name="nome3" id="nome3" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Endere&ccedil;o</td>
    </tr>
    <tr>
		<td><input type="text" name="nome4" id="nome4" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Bairro</td>
    </tr>
    <tr>
		<td><input type="text" name="nome5" id="nome5" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cidade</td>
    </tr>
    <tr>
		<td><input type="text" name="nome6" id="nome6" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <tr>
      <td class="tit_campo">Estado</td>
    </tr>
    <tr>
		<td class="tit_campo"><input type="text" name="nome7" id="nome7" maxlength="255" class="inpute gde obrigatorio" title="Nome" /></td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked');
	$radio_stat[$status] = 'checked';	
	?>
    <tr>
      <td class="campo_radio">Cep</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome8" id="nome8" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Fone Comercial 01</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome9" id="nome9" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Fone Comercial 02</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome10" id="nome10" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Celular</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome11" id="nome11" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Email</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome12" id="nome12" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Site</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome13" id="nome13" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Banco</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome14" id="nome14" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">Agencia</td>
    </tr>
    <tr>
      <td class="campo_radio"><span class="tit_campo">
        <input type="text" name="nome15" id="nome15" maxlength="255" class="inpute gde obrigatorio" title="Nome" />
      </span></td>
    </tr>
    <tr>
      <td class="campo_radio">C/C</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
    	<td class="campo_radio"></td>
    </tr>
    <tr>
    	<td class="campo_radio"></td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
    <tr>
      <td class="campo_radio">&nbsp;</td>
    </tr>
</table>
<table id="table_botoes_rodape">
<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>
<?php
}else{
	if($status == 1){
?>
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><?=$nome?></td>
    </tr>
    <tr>
		<td class="tit_campo">Empresa:</td>
    </tr>
    <tr>
		<td><?=$empresa?></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><?=$email?></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Residencial:</td>
    </tr>
    <tr>
		<td><?=$tel_res?></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Comercial:</td>
    </tr>
    <tr>
		<td><?=$tel_com?></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone Celular:</td>
    </tr>
    <tr>
		<td><?=$tel_cel?></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
<?php
	}else{
	?>
    <p class='vazio'>Esse contato est&aacute; marcado como privado e voc&ecirc; n&atilde;o pode acess&aacute;-lo.</p>
    <table id="table_botoes_rodape">
	<tr>	
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
    <?	
	}
}
?>