<?php 
require_once ('produtos.php');
if ($id) {
    $pesquisa = new produtos();
    $pesquisa->busca($id);
    $id_produto = $pesquisa->id_produto;
    $id_produtos_subcategoria = $pesquisa->id_produtos_subcategoria;
    $nome = $pesquisa->nome;
    $imagem = $pesquisa->imagem;
    $descricao = $pesquisa->descricao;
    $slug = $pesquisa->slug;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">
                Subcategoria:
            </td>
        </tr>
        <tr>
            <td>
                <select class="inpute" name="id_produtos_subcategoria" id="id_produtos_subcategoria">
                    <?php
                    $query = 'SELECT * FROM produtos_subcategorias s, produtos_categorias c WHERE s.id_produtos_categoria = c.id_produtos_categoria ORDER BY categoria';
                    $subcategorias = $con_cliente->query($query);
                    if ($subcategorias && $subcategorias->num_rows > 0) {
                        while ($subcategoria = $subcategorias->fetch_assoc()) {

                            ?>
                    <option value="<?=$subcategoria['id_produtos_subcategoria']?>"<?php if ($subcategoria['id_produtos_subcategoria'] == $id_produtos_subcategoria) { ?>selected="selected"<?php } ?>><?= $subcategoria['categoria']?> - <?= $subcategoria['subcategoria']?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Nome
            </td>
        </tr>
        <tr>
            <td>
                <input id="nome" name="nome" class="inpute obrigatorio" value="<?=$nome?>" />
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Imagem:
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($imagem) {

                    ?>
                <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/produtos/thumbs/<?=$imagem?>" /><br />
                    <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Descrição:
            </td>
        </tr>
        <tr>
            <td>
                <textarea id="descricao" name="descricao">
                    <?=$descricao?>
                </textarea>
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td>
                <input type="submit" value="Salvar" id="bt_salvar"/>
            </td>
            <td>
                <input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" />
            </td>
        </tr>
    </table>
</form>