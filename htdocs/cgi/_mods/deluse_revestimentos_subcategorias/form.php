<?php 
require_once ('revestimentos_subcategorias.php');
require_once('_mods/deluse_revestimentos_categorias/revestimentos_categorias.php');
if ($id) {
    $pesquisa = new revestimentos_subcategorias();
    $pesquisa->busca($id);
    $id_revestimentos_subcategoria = $pesquisa->id_revestimentos_subcategoria;
    $id_revestimentos_categoria = $pesquisa->id_revestimentos_categoria;
    $subcategoria = $pesquisa->subcategoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_revestimentos_subcategoria?>" name="id_revestimentos_subcategoria" id="id_revestimentos_subcategoria" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">
                Categoria
            </td>
        </tr>
        <tr>
            <td>
                <select name="id_revestimentos_categoria" id="id_revestimentos_categoria">
                	<?php
					$categorias = revestimentos_categorias::lista();
					foreach($categorias as $categoria){
					?>
                    <option value="<?=$categoria['id_revestimentos_categoria']?>" <?php if($categoria['id_revestimentos_categoria'] == $id_revestimentos_categoria){?>selected<?php }?>><?= $categoria['categoria']?></option>
					<?php
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
                <input type="text" name="subcategoria" id="subcategoria" maxlength="255" class="inpute gde obrigatorio" title="Subcategoria" value="<?=$subcategoria?>" />
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