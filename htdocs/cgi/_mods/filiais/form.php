<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new filiais();
	$pesquisa->busca($id);
	$id_filiai = $pesquisa->id_filiai;
	$nome = $pesquisa->nome;
	$endereco = $pesquisa->endereco;
	$cep = $pesquisa->cep;
	$cidade = $pesquisa->cidade;
	$fk_estado = $pesquisa->fk_estado;
	$fone = $pesquisa->fone;
	$celular = $pesquisa->celular;
	$contato = $pesquisa->contato;
	$email = $pesquisa->email;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#cep").mask("99.999-999");
});
</script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/swf.js"> </script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_filiai?>" name="id_filiai" id="id_filiai" />
<table id="formulario">
	<tr>
    	<td class="tit_campo">Nome</td>
    </tr>
    <tr>
    	<td><input type="text" name="nome" id="nome" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Endere&ccedil;o:</td>
    </tr>
    <tr>
		<td><input type="text" name="endereco" id="endereco" class="inpute gde obrigatorio" title="Largura" value="<?=$endereco?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">CEP:</td>
    </tr>
    <tr>
		<td><input type="text" name="cep" id="cep" class="inpute pqno obrigatorio" title="CEP" value="<?=$cep?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cidade:</td>
    </tr>
    <tr>
    	<td><input type="text" name="cidade" id="cidade" class="inpute gde obrigatorio" title="Cidade" value="<?=$cidade?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Estado:</td>
    </tr>
    <tr>
    	<td><select name="fk_estado" id="fk_estado" class="inpute medio">
    		<?php
			$estados = $con_cliente->executa("SELECT * FROM estados ORDER BY UF");
			if($estados && mysqli_num_rows($estados)>0){
				while($estado = mysqli_fetch_assoc($estados)){
			?>
				<option value="<?=$estado['id_estado']?>" <?php if($estado['id_estado'] == $fk_estado){ ?> selected="selected" <?php }?>><?=$estado['uf']?></option>
			<?php
				}
			}
			?>
    	</select></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefone:</td>
    </tr>
    <tr>
		<td><input type="text" name="fone" id="fone" class="inpute medio obrigatorio" title="Telefone" value="<?=$fone?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Celular:</td>
    </tr>
    <tr>
		<td><input type="text" name="celular" id="celular" class="inpute medio obrigatorio" title="Celular" value="<?=$celular?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Contato:</td>
    </tr>
    <tr>
		<td><input type="text" name="contato" id="contato" class="inpute gde obrigatorio" title="Contato" value="<?=$contato?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><input type="text" name="email" id="email" class="inpute gde obrigatorio" title="E-mail" value="<?=$email?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>