<?php
require_once("caracteristicas_categorias.php");
if($id)	{
	$pesquisa = new caracteristicas_categorias();
	$pesquisa->busca($id);
    $id_caracteristicas_categoria = $pesquisa->id_caracteristicas_categoria;
	$id_categorias_produto = $pesquisa->id_categorias_produto;
	$caracteristica = $pesquisa->caracteristica;
    $carac = $pesquisa->carac;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_caracteristicas_categoria?>" name="id_caracteristicas_categoria" id="id_caracteristicas_categoria" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><select name="id_categorias_produto" class="inpute">
        	<?php
			$categorias = $con_cliente->executa("SELECT * FROM categorias_produtos ORDER BY categoria");
			if($categorias && mysqli_num_rows($categorias)>0){
				while($categoria = mysqli_fetch_assoc($categorias)){
					if($categoria['id_categorias_produto'] == $id_categorias_produto){
						$categoria_sel[$categoria['id_categorias_produto']] = 'selected ="selected"';
					}
				?>
                <option value="<?=$categoria['id_categorias_produto']?>" <?=$categoria_sel[$categoria['id_categorias_produto']]?>><?=$categoria['categoria']?></option>
                <?php
				}
			}
			?>
        </select>
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Característica:</td>
    </tr>
    <tr>
		<td><input type="text" name="caracteristica" id="caracteristica" maxlength="255" class="inpute gde obrigatorio" title="Caracteristica" value="<?=$caracteristica?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>