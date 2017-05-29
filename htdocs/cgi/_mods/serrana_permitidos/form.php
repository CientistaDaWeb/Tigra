<?php
require_once("permitidos.php");
if($id)	{
	$pesquisa = new permitidos();
	$pesquisa->busca($id);
	$id_permitido = $pesquisa->id_permitido;
	$nome = $pesquisa->nome;
    $email = $pesquisa->email;
    $senha = $pesquisa->senha;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_permitido?>" name="id_permitido" id="id_permitido" />
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
		<td class="tit_campo">Senha:</td>
    </tr>
    <tr>
		<td><input type="password" name="senha" id="senha" maxlength="255" class="inpute gde obrigatorio" title="Senha" value="<?=$senha?>" /></td>
    </tr>
</table>
<?php
if($id){
    ?>
    <div class="subtitulos">Obras</div>
    <?php
    $query = 'SELECT id_obra FROM obras_permitidos WHERE id_permitido = '.$id;
    $autorizacoes = $con_cliente->query($query);
    if($autorizacoes && $autorizacoes->num_rows > 0){
        while($autorizacao = $autorizacoes->fetch_assoc()){
            $tem[$autorizacao['id_obra']] = true;
        }
    }
    $query = 'SELECT * FROM obras';
    $obras = $con_cliente->query($query);
    if($obras && $obras->num_rows > 0){
        while($obra = $obras->fetch_assoc()){
?>
    <div class="duascolunas">
        <label for="permit<?=$obra['id_obra']?>"><?=$obra['nome']?></label>
        <input type="checkbox" name="permits[]" id="permit<?=$obra['id_obra']?>" value="<?=$obra['id_obra']?>" <?php if($tem[$obra['id_obra']]){?> checked="checked" <?php }?> class="crirHiddenJS"/>
    </div>
<?php
        }
    }
}
?>
<table id="table_botoes_rodape">
	<tr>
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>