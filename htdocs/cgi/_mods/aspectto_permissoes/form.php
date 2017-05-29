<?php
require_once("usuarios.php");
if($id)	{
    $pesquisa = new usuarios();
    $pesquisa->busca($id);
    $id_usuario = $pesquisa->id_usuario;
    $nome = $pesquisa->nome;
    $email = $pesquisa->email;
    $usuario = $pesquisa->usuario;
    $senha = $pesquisa->senha;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_usuario?>" name="id_usuario" id="id_usuario" />
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
		<td class="tit_campo">Usuário:</td>
    </tr>
    <tr>
		<td><input type="text" name="usuario" id="usuario" maxlength="255" class="inpute gde obrigatorio" title="Usuário" value="<?=$usuario?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Senha:</td>
    </tr>
    <tr>
		<td><input type="text" name="senha" id="senha" maxlength="255" class="inpute gde obrigatorio" title="Senha" value="<?=$senha?>" /></td>
    </tr>
</table>
<?php
if($id){
    ?>
    <div class="subtitulos">Permissão por categoria</div>
    <?php
    $query = 'SELECT id_produtos_categoria FROM produtos_usuarios WHERE id_usuario = '.$id;
    $autorizacoes = $con_cliente->query($query);
    if($autorizacoes && $autorizacoes->num_rows > 0){
        while($autorizacao = $autorizacoes->fetch_assoc()){
            $tem[$autorizacao['id_produtos_categoria']] = true;
        }
    }
    $query = 'SELECT * FROM produtos_categorias';
    $categorias = $con_cliente->query($query);
    if($categorias && $categorias->num_rows > 0){
        while($categoria = $categorias->fetch_assoc()){
?>
    <div class="duascolunas">
        <label for="permit<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></label>
        <input type="checkbox" name="permits[]" id="permit<?=$categoria['id_produtos_categoria']?>" value="<?=$categoria['id_produtos_categoria']?>" <?php if($tem[$categoria['id_produtos_categoria']]){?> checked="checked" <?php }?> class="crirHiddenJS"/>
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