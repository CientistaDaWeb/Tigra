<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script>
$(document).ready(function(){
	$("#valor").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
});
</script>
<?php
require_once('produtos.php');
$id_produtos_categoria = $_SESSION['asp_cat'];
if($id){
    $pesquisa = new produtos();
    $pesquisa->busca($id);
    $id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $nome =         $pesquisa->nome;
    $referencia =   $pesquisa->referencia;
    $imagem =       $pesquisa->imagem;
    $descricao =    $pesquisa->descricao;
    $valor =        $pesquisa->valor;
    $visibilidade = $pesquisa->visibilidade;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Categoria:</td>
        </tr>
        <tr>
            <td><select class="inpute" name="id_produtos_categoria" id="id_produtos_categoria">
                    <?php
					
                    $query = 'SELECT * FROM produtos_categorias ORDER BY categoria';
                    $categorias = $con_cliente->query($query);
                    if($categorias && $categorias->num_rows > 0){
                        while($categoria = $categorias->fetch_assoc()){
                            if($categoria['id_produtos_categoria'] == $id_produtos_categoria){
                                echo '<option value="'.$categoria['id_produtos_categoria'].'" selected="selected">'.$categoria['categoria'].'</option>';
                            }else{
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
            <td class="tit_campo">Nome do Produto:</td>
        </tr>
        <tr>
            <td><input id="nome" name="nome" class="inpute gde obrigatorio"  value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Referência do Produto:</td>
        </tr>
        <tr>
            <td><input id="referencia" name="referencia" class="inpute gde"  value="<?=$referencia?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($imagem){
                    $ob = 'inpute';
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img_produtos/thumbs/<?=$imagem?>" /><br />
                <?php
            }else{
                $ob = 'inpute obrigatorio';
            }

            ?>
                <input type="file" name="imagem" id="imagem" class="<?=$ob?>">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Descrição:</td>
        </tr>
        <tr>
            <td><textarea name="descricao" class="inpute" id="descricao" title="Descrição do Produto" rows="5"><?=$descricao?></textarea></td>
        </tr>
        <tr>
            <td class="tit_campo">Valor: R$<input id="valor" name="valor" class="inpute pqno"  value="<?=$valor?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Visibilidade:</td>
        </tr>
        <tr>
            <td class="tit_campo"><select class="inpute" name="visibilidade" id="visibilidade">
            <option <? if($visibilidade == 1){ ?>selected="selected"<? } ?> value="1">Site e Restrito</option>
            <option <? if($visibilidade == 2){ ?>selected="selected"<? } ?> value="2">Restrito</option>
            </select></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>