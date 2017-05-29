<?php
require_once("materias_comentarios.php");
$data = date('d/m/Y');
if($id)	{
	$pesquisa = new materias_comentarios();
	$pesquisa->busca($id);
	$id_materias_comentario = $pesquisa->id_materias_comentario;
	$id_materia = $pesquisa->id_materia;
	$nome = $pesquisa->nome;
	$email = $pesquisa->email;
	$url_site = $pesquisa->url_site;
	$comentario = $pesquisa->comentario;
	$status = $pesquisa->status;
	$materia = $con_cliente->executa("SELECT titulo FROM materias WHERE id_materia = $id_materia");
	if($materia && mysqli_num_rows($materia)>0){
		$materia = mysqli_fetch_assoc($materia);
		$titulo = $materia['titulo'];
	}
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_materias_comentario?>" name="id_materias_comentario" id="id_materias_comentario" />
<table id="formulario">
    <tr>
    	<td class="tit_campo">Comentário feito para a notícia <?=$titulo?></td>
    </tr>
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
		<td class="tit_campo">Site:</td>
    </tr>
    <tr>
		<td><input type="text" name="url_site" id="url_site" maxlength="255" class="inpute gde" title="Site" value="<?=$url_site?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Coment&aacute;rio:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="comentario" id="comentario"><?=$comentario?></textarea></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Status de Aprovação:</td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked', 'unchecked');
	$radio_stat[$status] = 'checked';	
	?>
    <tr>
    	<td class="campo_radio"><label for="radio3" class="radio_<?=$radio_stat[3]?>">Aguardando Aprovação</label>
        <input type="radio" name="status" id="radio3" value="3" class="crirHidden" <?php if($radio_stat[3] == 'checked'){?> checked="checked" <?php }?>/></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Aprovado</label>
        <input type="radio" name="status" id="radio2" value="2" class="crirHidden" <?php if($radio_stat[2] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Reprovado</label>
        <input type="radio" name="status" id="radio1" value="1" class="crirHidden" <?php if($radio_stat[1] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>