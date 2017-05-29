<?php
require_once('fotos.php');
if($id) {
    $pesquisa = new fotos();
    $pesquisa->busca($id);
    $id_foto = $pesquisa->id_foto;
    $imagem = $pesquisa->imagem;
    $legenda = $pesquisa->legenda;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
    <input type="hidden" value="<?=$id_foto?>" name="id_foto" id="id_foto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Imagem</td>
        </tr>
        <tr>
            <td><?php
                if($imagem) {
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img_fotos/thumbs/<?=$imagem?>" /><br />
                <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute"></td>
        </tr>
        <tr>
            <td class="tit_campo">Legenda:</td>
        </tr>
        <tr>
            <td><input class="inpute medio" name="legenda" id="legenda" value="<?=$legenda?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>

