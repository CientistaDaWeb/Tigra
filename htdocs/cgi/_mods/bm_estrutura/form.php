<?php
require_once('estruturas.php');
if($id) {
    $pesquisa = new estruturas();
    $pesquisa->busca($id);
    $id_estrutura = $pesquisa->id_estrutura;
    $imagem = $pesquisa->imagem;
    $descricao = $pesquisa->descricao;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
    <input type="hidden" value="<?=$id_estrutura?>" name="id_estrutura" id="id_estrutura" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Imagem</td>
        </tr>
        <tr>
            <td><?php
                if($imagem) {
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img_estrutura/thumbs/<?=$imagem?>" /><br />
                <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute"></td>
        </tr>
        <tr>
            <td class="tit_campo">Descrição:</td>
        </tr>
        <tr>
            <td><textarea class="inpute" name="descricao" id="descricao" rows="15"><?=$descricao?></textarea></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>

