<?php
require_once('revestimentos.php');
require_once('_mods/deluse_revestimentos_categorias/revestimentos_categorias.php');
$id_revestimentos_categoria = $_SESSION['del_cat'];

$dominio = decripfy($_SESSION['dominio'],'h0s7');

if($id) {
    $pesquisa = new revestimentos();
    $pesquisa->busca($id);
    $id_revestimento = $pesquisa->id_revestimento;
    $id_revestimentos_categoria = $pesquisa->id_revestimentos_categoria;
    $id_revestimentos_subcategoria = $pesquisa->id_revestimentos_subcategoria;
    $nome =         $pesquisa->nome;
    $referencia =   $pesquisa->referencia;
    $imagem =       $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post"
      enctype="multipart/form-data" id="form_edicao"
      onsubmit="return ween_validator()"><input type="hidden"
                                          value="<?=$id_revestimento?>" name="id_revestimento"
                                          id="id_revestimento" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><select class="inpute" name="ids_revestimentos" id="id_revestimentos">
                    <?php
                    $categorias = revestimentos_categorias::listaAssociada();
                    foreach($categorias AS $categoria) {
                        if(($categoria['id_revestimentos_categoria'] == $id_revestimentos_categoria) && ($categoria['id_revestimentos_subcategoria'] == $id_revestimentos_subcategoria)) {
                            echo '<option value="'.$categoria['id_revestimentos_categoria'].', '.$categoria['id_revestimentos_subcategoria'].'" selected="selected">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                        }else {
                            echo '<option value="'.$categoria['id_revestimentos_categoria'].', '.$categoria['id_revestimentos_subcategoria'].'">'.$categoria['categoria'].' -> '.$categoria['subcategoria'].'</option>';
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome do revestimento:</td>
        </tr>
        <tr>
            <td><input id="nome" name="nome" class="inpute gde obrigatorio"
                       value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Referência do revestimento:</td>
        </tr>
        <tr>
            <td><input id="referencia" name="referencia" class="inpute gde"
                       value="<?=$referencia?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td><?php
                if($imagem) {
                    $ob = 'inpute';
                    ?> <img
                    src="http://images.weentigra.com.br/<?php echo $dominio?>/revestimentos/thumbs/<?=$imagem?>" /><br />
                        <?php
                    }else {
                        $ob = 'inpute obrigatorio';
                    }

                ?> <input type="file" name="imagem" id="imagem" class="<?=$ob?>"></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
            <td><input type="button" value="Cancelar"
                       onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'"
                       id="bt_cancelar" /></td>
        </tr>
    </table>
</form>
