<?php
require_once'produtos.php';
if($id){
    $pesquisa = new produtos();
    $pesquisa->busca($id);
    $id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $id_categorias_subcategoria = $pesquisa->id_categorias_subcategoria;
    $produto = $pesquisa->produto;
    $ref = $pesquisa->ref;
    $descricao = $pesquisa->descricao;
    $imagem = $pesquisa->imagem;
    $imagem2 = $pesquisa->imagem2;
    $video = $pesquisa->video;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#preco").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria / Subcategoria:</td>
        </tr>
        <tr>
            <td><select name="categoria" class="inpute">
                    <?
                    $SQLmaquinas = '
                    SELECT
                        cs.id_categorias_subcategoria,
                        cs.id_produtos_categorias,
                        pc.tipo,
                        pc.categoria,
                        cs.subcategoria
                    FROM
                        produtos_categorias pc
                    LEFT JOIN
                        categorias_subcategorias cs
                    ON
                        pc.id_produtos_categoria = cs.id_produtos_categorias
                    WHERE pc.tipo = "maquinas" ORDER BY tipo
                    ';
                    $categorias = $con_cliente->executa($SQLmaquinas);
                    if($categorias && mysqli_num_rows($categorias)>0){
                        echo '<optgroup label="Máquinas">';
                        while($categoria = mysqli_fetch_assoc($categorias)){
                            if($id_produtos_categoria == $categoria['id_produtos_categorias'] && $id_categorias_subcategoria == $categoria['id_categorias_subcategoria']){
                                echo '<option selected="selected" value="'.$categoria['id_produtos_categorias'].','.$categoria['id_categorias_subcategoria'].'">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                            }else{
                                echo '<option value="'.$categoria['id_produtos_categorias'].','.$categoria['id_categorias_subcategoria'].'">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                            }
                            ?>
                        <?php
                        }
                        echo '</optgroup>';
                    }
                    $SQLprodutos = '
                    SELECT
                        cs.id_categorias_subcategoria,
                        cs.id_produtos_categorias,
                        pc.tipo,
                        pc.categoria,
                        cs.subcategoria
                    FROM
                        produtos_categorias pc
                    LEFT JOIN
                        categorias_subcategorias cs
                    ON
                        pc.id_produtos_categoria = cs.id_produtos_categorias
                    WHERE pc.tipo = "produtos" ORDER BY tipo
                    ';
                    $categorias = $con_cliente->executa($SQLprodutos);
                    if($categorias && mysqli_num_rows($categorias)>0){
                        echo '<optgroup label="Produtos">';
                        while($categoria = mysqli_fetch_assoc($categorias)){
                            if($id_produtos_categoria == $categoria['id_produtos_categorias'] && $id_categorias_subcategoria == $categoria['id_categorias_subcategoria']){
                                echo '<option selected="selected" value="'.$categoria['id_produtos_categorias'].','.$categoria['id_categorias_subcategoria'].'">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                            }else{
                                echo '<option value="'.$categoria['id_produtos_categorias'].','.$categoria['id_categorias_subcategoria'].'">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                            }
                            ?>
                        
                        <?php
                        }
                        echo '</optgroup>';
                    }
            ?>
            </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome do Produto:</td>
        </tr>
        <tr>
            <td><input id="produto" name="produto" class="inpute gde obrigatorio" title="Nome do Produto" value="<?=$produto?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Ref. do Produto:</td>
        </tr>
        <tr>
            <td><input id="ref" name="ref" class="inpute gde" title="Ref. do Produto" value="<?=$ref?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Descrição do Produto:</td>
        </tr>
        <tr>
            <td><textarea name="descricao" class="inpute" id="descricao" title="Descrição do Produto" rows="5"><?=$descricao?></textarea></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td><?php
                if($imagem){
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/imgs/pro/thumbs/<?=$imagem?>" /><br />
                <?php
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute">
                </td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem 2:</td>
        </tr>
        <tr>
            <td><?php
                if($imagem2){
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/imgs/pro2/thumbs/<?=$imagem2?>" /><br />
                <?php
                }
                ?>
                <input type="file" name="imagem2" id="imagem2" class="inpute">
                </td>
        </tr>
        <tr>
            <td class="tit_campo">Vídeo (link do Youtube):</td>
        </tr>
        <tr>
            <td>
                <input id="video" name="video" class="inpute gde" title="Vídeo (link do Youtube)" value="<?=$video?>" />
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