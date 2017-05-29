<?php
require_once('cursos_categorias.php');
if($id) {
    $pesquisa = new cursos_categorias();
    $pesquisa->busca($id);
    $id_cursos_categoria = $pesquisa->id_cursos_categoria;
    $id_setor = $pesquisa->id_setor;
    $categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_cursos_categoria?>" name="id_cursos_categoria" id="id_cursos_categoria" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Setor:</td>
        </tr>
        <tr>
            <td><select class="inpute gde" name="id_setor" id="id_setor">
                    <?php
                    $query = 'SELECT * FROM setors ORDER BY setor';
                    $categorias = $con_cliente->query($query);
                    if($categorias && $categorias->num_rows > 0) {
                        while($cat = $categorias->fetch_assoc()) {
                            if($cat['id_setor'] == $id_setor) {
                                echo '<option value="'.$cat['id_setor'].'" selected="selected">'.$cat['setor'].'</option>';
                            }else {
                                echo '<option value="'.$cat['id_setor'].'">'.$cat['setor'].'</option>';
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><input id="categoria" name="categoria" class="inpute gde obrigatorio" value="<?=$categoria?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>