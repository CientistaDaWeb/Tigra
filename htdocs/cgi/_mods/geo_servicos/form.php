<?php
require_once('servicos.php');
if($id) {
    $pesquisa = new servicos();
    $pesquisa->busca($id);
    $id_servico = $pesquisa->id_servico;
    $id_servicos_categoria = $pesquisa->id_servicos_categoria;
    $servico = $pesquisa->servico;
    $descricao = $pesquisa->descricao;
    $imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_servico?>" name="id_servico" id="id_servico" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">
                Categoria:
            </td>
        </tr>
        <tr>
            <td>
                <select name="id_servicos_categoria" class="inpute gde">
                    <?php
                    $categorias = $con_cliente->executa("SELECT id_servicos_categoria, categoria FROM servicos_categorias AS oc");
                    if ($categorias && mysqli_num_rows($categorias) > 0) {
                        while ($categoria = mysqli_fetch_assoc($categorias)) {
                            if ($categoria['id_servicos_categoria'] == $id_servicos_categoria) {
                                $categoria_sel[$categoria['id_servicos_categoria']] = 'selected ="selected"';
                            }

                            ?>
                    <option value="<?=$categoria['id_servicos_categoria']?>"<?= $categoria_sel[$categoria['id_servicos_categoria']]?>><?= $categoria['categoria']?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Serviço:</td>
        </tr>
        <tr>
            <td><input type="text" name="servico" id="servico" class="inpute gde obrigatorio" title="Serviço" value="<?=$servico?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Descrição:</td>
        </tr>
        <tr>
            <td><textarea class="inpute" name="descricao" id="descricao" rows="15"><?= $descricao?></textarea></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td>
                <?php if ($imagem) { ?>
                <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/servicos/thumbs/<?=$imagem?>" />
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