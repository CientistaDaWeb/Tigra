<?php
require_once('vestibulares.php');
if($id)	{
	$pesquisa = new fac_vestibulares();
	$pesquisa->busca($id);
	$id_fac_vestibulare = $pesquisa->id_fac_vestibulare;
    $semestre = $pesquisa->semestre;
    $ano = $pesquisa->ano;
    $imagem = $pesquisa->imagem;
    $divulgacao_data_inicio = ajustadata($pesquisa->divulgacao_data_inicio,'site');
    $divulgacao_data_fim = ajustadata($pesquisa->divulgacao_data_fim,'site');
    $insc_data_inicio = ajustadata($pesquisa->insc_data_inicio,'site');
    $insc_data_fim = ajustadata($pesquisa->insc_data_fim,'site');
    $gabarito = $pesquisa->gabarito;
    $gabarito_data_inicio = explode(' ',$pesquisa->gabarito_data_inicio);
    $gabarito_data = ajustadata($gabarito_data_inicio[0],'site');
    $gabarito_hora = $gabarito_data_inicio[1];
    $manual_candidato = $pesquisa->manual_candidato;
    $data = ajustadata($pesquisa->data,'site');
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
    $("#ano").mask("9999");
    $("#gabarito_data").mask("99/99/9999");
    $("#gabarito_hora").mask("99:99:99");
    $("#insc_data_inicio").mask("99/99/9999");
    $("#insc_data_fim").mask("99/99/9999");
    $("#divulgacao_data_inicio").mask("99/99/9999");
    $("#divulgacao_data_fim").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_fac_vestibulare?>" name="id_fac_vestibulare" id="id_fac_vestibulare" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Edição:</td>
    </tr>
    <tr>
		<td><select class="inpute" name="semestre" id="semestre">
            <option value="1"<?php if($semestre == 1){?>selected="selected"<?php }?>>1</option>
            <option value="2"<?php if($semestre == 2){?>selected="selected"<?php }?>>2</option>
            <option value="3"<?php if($semestre == 3){?>selected="selected"<?php }?>>3</option>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Ano:</td>
    </tr>
    <tr>
		<td><input type="text" name="ano" id="ano" maxlength="4" class="inpute pqno obrigatorio" title="ano" value="<?=$ano?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Gabarito:</td>
    </tr>
    <tr>
		<td><textarea name="gabarito" class="inpute" id="gabarito" rows="5"><?=$gabarito?></textarea></td>
    </tr>
	<tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/vestibulares/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Data de início da divulgação do gabarito:</td>
    </tr>
    <tr>
		<td><input type="text" name="gabarito_data" id="gabarito_data" maxlength="10" class="inpute pqno obrigatorio" title="Data de início da divulgação do gabarito" value="<?=$gabarito_data?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Hora de início da divulgação do gabarito:</td>
    </tr>
    <tr>
		<td><input type="text" name="gabarito_hora" id="gabarito_hora" maxlength="10" class="inpute pqno obrigatorio" title="Hora de início da divulgação do gabarito" value="<?=$gabarito_hora?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Manual do Candidato:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($manual_candidato){
            echo $manual_candidato;
		}
		?>
        <input type="file" name="manual_candidato" id="manual_candidato" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Data de início das inscrições:</td>
    </tr>
    <tr>
		<td><input type="text" name="insc_data_inicio" id="insc_data_inicio" maxlength="10" class="inpute pqno obrigatorio" title="Data de início das inscrições" value="<?=$insc_data_inicio?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data de final das inscrições:</td>
    </tr>
    <tr>
		<td><input type="text" name="insc_data_fim" id="insc_data_fim" maxlength="10" class="inpute pqno obrigatorio" title="Data final das inscrições" value="<?=$insc_data_fim?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data de início da divulgação:</td>
    </tr>
    <tr>
		<td><input type="text" name="divulgacao_data_inicio" id="divulgacao_data_inicio" maxlength="10" class="inpute pqno obrigatorio" title="Data de início das divulgacao" value="<?=$divulgacao_data_inicio?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data de final da divulgacao:</td>
    </tr>
    <tr>
		<td><input type="text" name="divulgacao_data_fim" id="divulgacao_data_fim" maxlength="10" class="inpute pqno obrigatorio" title="Data final da divulgação" value="<?=$divulgacao_data_fim?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Data Do Vestibular:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data do vestibular" value="<?=$data?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>