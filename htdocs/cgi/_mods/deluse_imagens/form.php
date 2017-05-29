<?php
require_once('imagens.php');
$dominio = decripfy($_SESSION['dominio'],'h0s7');

if($id) {
    $pesquisa = new imagens();
    $pesquisa->busca($id);
    $id_imagen = $pesquisa->id_imagen;
    $imagem = $pesquisa->imagem;
    $legenda = $pesquisa->legenda;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_imagen?>" name="id_imagen" id="id_imagen" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Legenda:</td>
        </tr>
        <tr>
            <td><input type="text" name="legenda" id="legenda" maxlength="255" class="inpute gde obrigatorio" title="legenda" value="<?=$legenda?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($imagem) {
                    ?>
                <img src="http://images.weentigra.com.br/<?php echo $dominio?>/imagens/thumbs/<?=$imagem?>" /><br />
                    <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute">
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>