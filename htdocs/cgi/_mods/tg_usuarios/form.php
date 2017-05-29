<?php
require_once("$tg_mod.php");
$data = date('d/m/Y');
if($id)	{
	$pesquisa = new tg_usuarios();
	$pesquisa->busca($id);
	$id_tg_usuario = $pesquisa->id_tg_usuario;
	$nome = $pesquisa->nome;
	$usuario = $pesquisa->usuario;
	$senha = $pesquisa->senha;
	$email = $pesquisa->email;
	$fk_tg_cliente = $pesquisa->fk_tg_cliente;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_tg_usuario?>" name="id_tg_usuario" id="id_tg_usuario" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" title="Nome" class="inpute gde obrigatorio" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cliente:</td>
    </tr>
    <tr>
		<td><select name="fk_tg_cliente" id="fk_tg_cliente" class="inpute medio">
        <?php
		$clientes = $con_tigra->executa('SELECT * FROM tg_clientes ORDER BY nome');
		while($cliente = mysqli_fetch_assoc($clientes)){
		?>
        	<option value="<?=$cliente['id_tg_cliente']?>" <?php if($fk_tg_cliente == $cliente['id_tg_cliente']){ ?> selected="selected" <?php } ?>><?=$cliente['nome']?></option>
        <?php
		}
		?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Usuário:</td>
    </tr>
    <tr>
		<td><input type="text" name="usuario" id="usuario" maxlength="255" title="Usuário" class="inpute medio obrigatorio" value="<?=$usuario?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Senha:</td>
    </tr>
    <tr>
		<td><input type="password" name="senha" id="senha" maxlength="255" title="Senha" class="inpute medio obrigatorio" value="<?=$senha?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><input type="text" name="email" id="email" title="E-mail" maxlength="255" class="inpute gde obrigatorio" value="<?=$email?>" /></td>
    </tr>
</table>
<div class="duascolunas"><label for="enviar_senha">Enviar Senha</label><input type="checkbox" name="enviar_senha" id="enviar_senha" value="1" class="crirHiddenJS"/></div>
    <?php
	if($id_tg_usuario){
		$categorias = $con_tigra->executa("SELECT * FROM tg_cat_modulos WHERE fk_tg_cliente = $fk_tg_cliente ORDER BY categoria");
		if($categorias && mysqli_num_rows($categorias)>0){
			while($categoria = mysqli_fetch_assoc($categorias)){
				$modulos = $con_tigra->executa("SELECT * FROM tg_catxmodulos WHERE fk_tg_cat_modulo = $categoria[id_tg_cat_modulo]");
				if($modulos && mysqli_num_rows($modulos)>0){
				?>
               <div class="subtitulos"><?=$categoria['categoria']?></div>
                <?
					while($modulo = mysqli_fetch_assoc($modulos)){
						$nome = $con_tigra->executa("SELECT modulo FROM tg_modulos WHERE id_tg_modulo = $modulo[fk_tg_modulo]");
						$nome = mysqli_fetch_assoc($nome);
						$tem = false;
						$permissao = $con_tigra->executa("SELECT * FROM tg_permissoes WHERE fk_tg_modulo = $modulo[fk_tg_modulo] AND fk_tg_cat_modulo = $categoria[id_tg_cat_modulo] AND fk_tg_usuario = $id_tg_usuario");
						if($permissao && mysqli_num_rows($permissao)>0){
							$tem = true;	
						}
					?>
                    <div class="duascolunas">
                    <label for="permit<?=$modulo['fk_tg_modulo']?>"><?=$nome['modulo']?></label>
                    <input type="checkbox" name="permits[]" id="permit<?=$modulo['fk_tg_modulo']?>" value="<?=$modulo['fk_tg_modulo']?>/<?=$categoria['id_tg_cat_modulo']?>" <?php if($tem){ ?> checked="checked" <?php } ?> class="crirHiddenJS"/>
                    </div>
                    <?
					}
				}
			}
		}else{
		echo("<div><span class='vazio'>Crie uma categoria de módulos para esse cliente antes.</span></div>");
		}
	}
	?>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>