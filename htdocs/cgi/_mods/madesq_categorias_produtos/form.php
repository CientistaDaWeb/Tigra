<?php
require_once("produtos_categorias.php");
if($id) {
    $pesquisa = new produtos_categorias();
    $pesquisa->busca($id);
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $categoria = $pesquisa->categoria;
    $main_cat = $pesquisa->main_cat;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_produtos_categoria?>" name="id_produtos_categoria" id="id_produtos_categoria" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria Pai:</td>
        </tr>
        <tr>
            <td><select class="inpute" name="main_cat" id="cat_main">
                    <?php
                    if($main_cat == 1) {
                        echo '<option value="1" selected="selected">Móveis</option>';
                    }else {
                        echo '<option value="1">Móveis</option>';
                    }
                    if($main_cat == 2) {
                        echo '<option value="2" selected="selected">Esquadrias</option>';
                    }else {
                        echo '<option value="2">Esquadrias</option>';
                    }
                    if($main_cat == 3) {
                        echo '<option value="3" selected="selected">Fechaduras</option>';
                    }else {
                        echo '<option value="3">Fechaduras</option>';
                    }
                    if($main_cat == 4) {
                        echo '<option value="4" selected="selected">Puxadores</option>';
                    }else {
                        echo '<option value="4">Puxadores</option>';
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>