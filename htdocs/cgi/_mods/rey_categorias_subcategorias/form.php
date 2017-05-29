<?php
require_once("categorias_subcategorias.php");
if($id)	{
	$pesquisa = new categorias_subcategorias();
	$pesquisa->busca($id);
	$id_categorias_subcategoria = $pesquisa->id_categorias_subcategoria;
    $id_produtos_categorias = $pesquisa->id_produtos_categorias;
	$subcategoria = $pesquisa->subcategoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_categorias_subcategoria?>" name="id_categorias_subcategoria" id="id_categorias_subcategoria" />
<table id="formulario">
    <tr>
        <td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
        <td>
        <select name="id_categorias_produtos" class="inpute">
        	<?php
			$categorias = $con_cliente->executa("SELECT id_produtos_categoria, categoria FROM produtos_categorias");
			if($categorias && mysqli_num_rows($categorias)>0){
				while($categoria = mysqli_fetch_assoc($categorias)){
                    if($id_produtos_categorias == $categoria['id_produtos_categoria']){
                        echo '<option selected="selected" value="'.$categoria['id_produtos_categoria'].'">'.$categoria['categoria'].'</option>';
                    }else{
                        echo '<option value="'.$categoria['id_produtos_categoria'].'">'.$categoria['categoria'].'</option>';
                    }
                ?>
                <?php
				}
			}
			?>
        </select>
        </td>
    </tr>
	<tr>
		<td class="tit_campo">Subcategoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="subcategoria" id="subcategoria" maxlength="255" class="inpute gde obrigatorio" title="Subcategoria" value="<?=$subcategoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>