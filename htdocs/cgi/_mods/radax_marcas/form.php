<?php
require_once('marcas.php');
if($id) {
    $pesquisa = new marcas();
    $pesquisa->busca($id);
    $id_marca = $pesquisa->id_marca;
    $marca = $pesquisa->marca;
    $imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_marca?>" name="id_marca" id="id_marca" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Marca:</td>
        </tr>
        <tr>
            <td><input type="text" name="marca" id="marca" class="inpute gde obrigatorio" title="Título" value="<?=$marca?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($imagem) {
                    ?>
                    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/marcas/<?=$imagem?>" /><br />
                    <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute">
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