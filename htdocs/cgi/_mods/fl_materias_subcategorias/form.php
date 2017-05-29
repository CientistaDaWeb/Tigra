<?php
require_once("materias_subcategorias.php");
if($id)	{
	$pesquisa = new materias_subcategorias();
	$pesquisa->busca($id);
	$id_materias_subcategoria = $pesquisa->id_materias_subcategoria;
	$id_materias_categoria = $pesquisa->id_materias_categoria;
	$subcategoria = $pesquisa->subcategoria;
	$subcat = $pesquisa->subcat;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_materias_subcategoria?>" name="id_materias_subcategoria" id="id_materias_subcategoria" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
    	<td><select name="id_materias_categoria" id="id_materias_categoria" class="inpute medio">
        <?php
		$categorias = $con_cliente->executa("SELECT * FROM materias_categorias ORDER BY categoria");
		if($categorias && mysqli_num_rows($categorias)>0){
			while($categoria = mysqli_fetch_assoc($categorias)){
			?>
            <option value="<?=$categoria['id_materias_categoria']?>" <? if($id_materias_categoria == $categoria['id_materias_categoria']){ ?>selected="selected"<? }?>><?=$categoria['categoria']?></option>
            <?	
			}
		}
		?></select>
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Subcategoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="subcategoria" id="subcategoria" maxlength="255" class="inpute gde obrigatorio" title="Subcategoria" value="<?=$subcategoria?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Subcategoria para link:</td>
    </tr>
    <tr>
		<td><input type="text" name="subcat" id="subcat" maxlength="255" class="inpute gde obrigatorio" title="Subcategoria para link" value="<?=$subcat?>" /></td>
    </tr>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>