<?php
require_once('banners.php');
if($id) {
    $pesquisa = new banners();
    $pesquisa->busca($id);
    $id_banner = $pesquisa->id_banner;
    $id_setor = $pesquisa->id_setor;
    $titulo = $pesquisa->titulo;
    $banner = $pesquisa->banner;
    $largura = $pesquisa->largura;
    $altura = $pesquisa->altura;
    $transparente = $pesquisa->transparente;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_banner?>" name="id_banner" id="id_banner" />
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
                        while($categoria = $categorias->fetch_assoc()) {
                            if($categoria['id_setor'] == $id_setor) {
                                echo '<option value="'.$categoria['id_setor'].'" selected>'.$categoria['setor'].'</option>';
                            }else {
                                echo '<option value="'.$categoria['id_setor'].'">'.$categoria['setor'].'</option>';
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Titulo:</td>
        </tr>
        <tr>
            <td><input type="text" name="titulo" id="titulo" class="inpute gde obrigatorio" title="Título" value="<?=$titulo?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Largura:</td>
        </tr>
        <tr>
            <td><input type="text" name="largura" id="largura" class="inpute gde obrigatorio" title="Largura" value="<?=$largura?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Altura:</td>
        </tr>
        <tr>
            <td><input type="text" name="altura" id="altura" class="inpute gde obrigatorio" title="Altura" value="<?=$altura?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Banner:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($banner) {
                    echo $banner;
                }
                ?>
                <input type="file" name="banner" id="banner" class="inpute">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Transparente:</td>
        </tr>
        <tr>
            <td>
                <label><input type="radio" name="destaque" <?php if($destaque == 1) { ?>checked<?php }?> value="1" /> Sim</label>
                <label><input type="radio" name="destaque" <?php if($destaque != 1) { ?>checked<?php }?> value="2" /> Não</label>
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>