<?php
require_once('servicos_categorias.php');
if($id) {
    $pesquisa = new servicos_categorias();
    $pesquisa->busca($id);
    $id_servicos_categoria = $pesquisa->id_servicos_categoria;
    $categoria = $pesquisa->categoria;
    $imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_servicos_categoria?>" name="id_servicos_categoria" id="id_servicos_categoria" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><input type="text" name="categoria" id="categoria" class="inpute gde obrigatorio" title="Serviço" value="<?=$categoria?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td>
                <?php if ($imagem) { ?>
                <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/servicos_categorias/thumbs/<?=$imagem?>" />
                <br>
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