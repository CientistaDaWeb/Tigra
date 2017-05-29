<?php
require_once("$tg_mod.php");
if($id){
	$pesquisa = new tg_cat_modulos();
	$pesquisa->busca($id);
	$id_tg_cat_modulo = $pesquisa->id_tg_cat_modulo;
	$categoria = $pesquisa->categoria;
	$icone = $pesquisa->icone;
	$fk_tg_cliente = $pesquisa->fk_tg_cliente;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_tg_cat_modulo?>" name="id_tg_cat_modulo" id="id_tg_cat_modulo" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome da Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Nome da Categoria" value="<?=$categoria?>" /></td>
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
    	<td class="tit_campo">Ícone:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($icone){
		?>
        <img src="<?=$url_base?>/_img/modulos/categorias/<?=$icone?>" /><br />
        <?php
		}
		?>
        <input type="file" name="icone" id="icone" class="inpute gde">
        </td>
    </tr>
</table>
    <?php
	if($id_tg_cat_modulo){
		$modulos = $con_tigra->executa("SELECT * FROM tg_modulos ORDER BY modulo");
		while($modulo = mysqli_fetch_assoc($modulos)){
			$tem = false;
			$permissao = $con_tigra->executa("SELECT * FROM tg_catxmodulos WHERE fk_tg_cat_modulo = $id_tg_cat_modulo AND fk_tg_modulo = $modulo[id_tg_modulo]");
			if(mysqli_num_rows($permissao)>0 && $permissao){
				$tem = true;
			}			
	?>
	<div class="duascolunas">
        <label for="permit<?=$modulo['id_tg_modulo']?>"><?=$modulo["modulo"]?></label>
        <input type="checkbox" name="fk_tg_modulo[]" id="permit<?=$modulo['id_tg_modulo']?>" value="<?=$modulo['id_tg_modulo']?>" <?php if($tem){ ?> checked="checked" <?php } ?> class="crirHiddenJS" title="<?=$modulo["modulo"]?>"/>
    </div>
    <?php
		}
	}
	?>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>