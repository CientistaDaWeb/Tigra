<?php 
require_once ("produtos_subcategorias.php");
if ($id) {
    $pesquisa = new produtos_subcategorias();
    $pesquisa->busca($id);
	$id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $id_produtos_subcategoria = $pesquisa->id_produtos_subcategoria;
    $subcategoria = $pesquisa->subcategoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_produtos_subcategoria?>" name="id_produtos_subcategoria" id="id_produtos_subcategoria" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">
                Categoria:
            </td>
        </tr>
        <tr>
            <td>
                <select class="inpute" name="id_produtos_categoria" id="id_produtos_categoria">
                    <?php 
                    $query = 'SELECT * FROM produtos_categorias';
                    $categorias = $con_cliente->query($query);
                    if ($categorias && $categorias->num_rows > 0) {
                        while ($categoria = $categorias->fetch_assoc()) {
                            
                    ?>
                    <option value="<?=$categoria['id_produtos_categoria']?>"<?php if ($categoria['id_produtos_categoria'] == $id_produtos_categoria) { ?>selected="selected"<?php } ?>><?= $categoria['categoria']?></option>
                    <?php 
                    }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Subcategoria:
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="subcategoria" id="subcategoria" maxlength="255" class="inpute gde obrigatorio" title="subcategoria" value="<?=$subcategoria?>" />
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td>
                <input class="btn_salvar" type="submit" value="" id="bt_salvar"/>
            </td>
            <td>
                <input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" />
            </td>
        </tr>
    </table>
</form>