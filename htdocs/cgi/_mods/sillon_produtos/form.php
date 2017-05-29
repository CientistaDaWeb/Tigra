<?php
require_once('produtos.php');
session_start();
$id_produtos_categoria = $_SESSION['deluse_cat'];

$dominio = decripfy($_SESSION['dominio'],'h0s7');

if($id) {
    $pesquisa = new produtos();
    $pesquisa->busca($id);
    $id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $nome = $pesquisa->nome;
    $referencia = $pesquisa->referencia;
    $imagem = $pesquisa->imagem;
    $status = $pesquisa->status;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><select class="inpute gde" name="id_produtos_categoria"
                        id="id_produtos_categoria">
                            <?php
                            $query = 'SELECT * FROM produtos_categorias ORDER BY categoria';
                            $categorias = $con_cliente->query($query);
                            if($categorias && $categorias->num_rows > 0) {
                                while($categoria = $categorias->fetch_assoc()) {
                                    if($categoria['id_produtos_categoria'] == $id_produtos_categoria) {
                                        echo '<option value="'.$categoria['id_produtos_categoria'].'" selected="selected">'.$categoria['categoria'].'</option>';
                                    }else {
                                        echo '<option value="'.$categoria['id_produtos_categoria'].'">'.$categoria['categoria'].'</option>';
                                    }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Referência:</td>
        </tr>
        <tr>
            <td><input type="text" id="referencia" name="referencia"
                       class="inpute gde" value="<?=$referencia?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input type="text" id="nome" name="nome" class="inpute gde obrigatorio" value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td><?php
                if($imagem) {
                    ?>
                <input type="hidden" id="del_imagem" name="del_imagem" value="<?=$imagem?>"/>
                <img src="http://images.weentigra.com.br/<?php echo $dominio?>/produtos/thumbs/<?=$imagem?>" /><br />
                        <?php
                    }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute"></td>
        </tr>
        <tr>
            <td class="tit_campo">Produto Exclusivo:</td>
        </tr>
        <tr>
            <td><select class="inpute gde" name="status" id="status">
                    <option value="2">Não</option>
                    <option value="1" <?php if($status == 1) {
    echo 'selected="selected"';
}?>>Sim</option>
                </select></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>
