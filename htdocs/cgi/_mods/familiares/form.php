<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new familiares();
	$pesquisa->busca($id);
	$id_familiare = $pesquisa->id_familiare;
	$fk_pai = $pesquisa->fk_pai;
	$nome = $pesquisa->nome;
	$data_nascimento = ajustadata($pesquisa->data_nascimento,"site");
	$data_falecimento = ajustadata($pesquisa->data_falecimento,"site");
	$conjuge = $pesquisa->conjuge;
	$conj_data_nascimento = ajustadata($pesquisa->conj_data_nascimento,"site");
	$conj_data_falecimento = ajustadata($pesquisa->conj_data_falecimento,"site");
	$endereco = $pesquisa->endereco;
	$cidade = $pesquisa->cidade;
	$cep = $pesquisa->cep;
	$estado = $pesquisa->estado;
	$email = $pesquisa->email;
	$telefone = $pesquisa->telefone;
	$profissao = $pesquisa->profissao;
	$chefe = $pesquisa->chefe;
	$imagem = $pesquisa->imagem;
	$imagem_conjuge = $pesquisa->imagem_conjuge;
	if($data_falecimento == "00/00/0000"){
		$data_falecimento = "";
	}
	if($data_nascimento == "00/00/0000"){
		$data_nascimento = "";
	}
	if($conj_data_falecimento == "00/00/0000"){
		$conj_data_falecimento = "";
	}
	if($conj_data_nascimento == "00/00/0000"){
		$conj_data_nascimento = "";
	}
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data_nascimento").mask("99/99/9999");
	$("#data_falecimento").mask("99/99/9999");
	$("#conj_data_nascimento").mask("99/99/9999");
	$("#conj_data_falecimento").mask("99/99/9999");
	$("#cep").mask("99.999-999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_familiare?>" name="id_familiare" id="id_familiare" />
<table id="formulario">
	<tr>
		<th class="subtitulos">Dados Pessoais</th>
	</tr>
	<tr>
		<td class="nome_campo"><label for="nome">Nome do Familiar:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="nome" id="nome" class="inpute gde obrigatorio" title="Nome do Familiar" value="<?=$nome?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="fk_pai">Pai:</label></td>
	</tr>
	<tr>
		<td><select name="fk_pai" id="fk_pai" class="inpute">
		<option value="1">Sem pai</option>
		<?php
		$pais = $con_cliente->executa("SELECT id_familiare, nome FROM familiares ORDER BY nome ASC");
		if($pais){
			while($pai = mysqli_fetch_assoc($pais)){
			?>
		    <option value="<?=$pai['id_familiare']?>" <?php if($fk_pai == $pai['id_familiare']){?> selected="selected" <? }?>><?=$pai['nome']?> - <?=$pai['id_familiare']?></option>
		    <?
			}
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="data_nascimento">Data de Nascimento:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="data_nascimento" id="data_nascimento" class="inpute pqno" value="<?=$data_nascimento?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="data_falecimento">Data de Falecimento:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="data_falecimento" id="data_falecimento" class="inpute pqno" value="<?=$data_falecimento?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo">Foto:</td>
	</tr>
	<tr>
		<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/familiares/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute medio">
		</td>
	</tr>
	<tr>
		<td class="duascolunas">
			<label for="chefe">Chefe de Familia</label>
			<input type="checkbox" name="chefe" id="chefe" value="1" <?php if($chefe == 1){ ?> checked="checked" <?php } ?> class="crirHiddenJS" title="Chefe da Fam&iacute;lia" /></td>
	</tr>
	<tr>
		<th class="subtitulos">C&ocirc;njuge</th>
	</tr>
	<tr>
		<td class="nome_campo"><label for="conjuge">Nome:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="conjuge" id="conjuge" class="inpute gde" value="<?=$conjuge?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="conj_data_nascimento">Data de Nascimento:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="conj_data_nascimento" id="conj_data_nascimento" class="inpute pqno" value="<?=$conj_data_nascimento?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="conj_data_falecimento">Data de Falecimento:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="conj_data_falecimento" id="conj_data_falecimento" class="inpute pqno" value="<?=$conj_data_falecimento?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo">Foto C&ocirc;njuge:</th>
	</tr>
    <tr>
    	<td>
    	<?php
		if($imagem_conjuge){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/familiares/conjuge/<?=$imagem_conjuge?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem_conjuge" id="imagem_conjuge" class="inpute medio">
        </td>
    </tr>
	<tr>
		<th class="subtitulos">Dados para contato</th>
	</tr>
	<tr>
		<td class="nome_campo"><label for="endereco">Endere&ccedil;o:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="endereco" id="endereco" class="inpute gde" value="<?=$endereco?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="cidade">Cidade:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="cidade" id="cidade" class="inpute gde" value="<?=$cidade?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="cep">CEP:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="cep" id="cep" class="inpute gde" value="<?=$cep?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="estado">Estado:</label></td>
	</tr>
	<tr>
		<td><select name="estado" id="estado" class="inpute medio">
		<option value="">Selecione o Estado</option>                   
		<?php
		$estados = $con_cliente->executa("SELECT * FROM estados ORDER BY estado ASC");
		if($estados){
			while($estadu = mysqli_fetch_assoc($estados)){
			?>
		    <option value="<?=utf8_encode($estadu['estado'])?>"<?php if($estado == utf8_encode($estadu['estado'])){?> selected="selected" <? }?>><?=utf8_encode($estadu['estado'])?></option>
		    <?
			}
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="email">E-mail:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="email" id="email" class="inpute gde" value="<?=$email?>" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="nome_campo"><label for="telefone">Telefone:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="telefone" id="telefone" class="inpute medio" value="<?=$telefone?>" maxlength="255" /></td>
	</tr>
	<tr>
		<th class="subtitulos">Dados Profissionais</th>
	</tr>
	<tr>
		<td class="nome_campo"><label for="profissao">&Aacute;rea de Atua&ccedil;&atilde;o:</label></td>
	</tr>
	<tr>
		<td><input type="text" name="profissao" id="profissao" class="inpute gde" value="<?=$profissao?>" maxlength="255" /></td>
	</tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>