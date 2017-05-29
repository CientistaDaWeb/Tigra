<style>
    .thumb{
        width: 50px;
        height: 50px;
        overflow: hidden;
        margin: 5px;
    }
    .revestimento{
        height: 80px;
        width: 155px;
        float: left;
        margin: 10px;

    }
    label{padding-left: 20px;}
</style>
<?php
require_once('produtos.php');
$id_produtos_categoria = $_SESSION['mad_cat'];
if($id) {
    $pesquisa = new produtos();
    $pesquisa->busca($id);
    $id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $nome =         $pesquisa->nome;
    $referencia =   $pesquisa->referencia;
    $imagem_1 =     $pesquisa->imagem_1;
    $imagem_2 =     $pesquisa->imagem_2;
    $descricao =    $pesquisa->descricao;
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
                    <optgroup label="Móveis"></optgroup>
                    <?php
                    $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 1 ORDER BY categoria';
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
                    <optgroup label="Esquadrias"></optgroup>
                    <?php
                    $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 2 ORDER BY categoria';
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
                    <optgroup label="Fechaduras"></optgroup>
                    <?php
                    $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 3 ORDER BY categoria';
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
                    <optgroup label="Puxadores"></optgroup>
                    <?php
                    $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 4 ORDER BY categoria';
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
            <td class="tit_campo">Imagem 1:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($imagem_1) {
                    $ob = 'inpute';
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img/produtos/thumbs/<?=$imagem_1?>" /><br />
                    <?php
                }else {
                    $ob = 'inpute obrigatorio';
                }

                ?>
                <input type="file" name="imagem_1" id="imagem_1" class="<?=$ob?>">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Imagem 2:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($imagem_2) {
                    $ob = 'inpute';
                    ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img/produtos/thumbs/<?=$imagem_2?>" /><br />
                    <?php
                }else {
                    $ob = 'inpute';
                }

                ?>
                <input type="file" name="imagem_2" id="imagem_2" class="<?=$ob?>">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Descrição:</td>
        </tr>
        <tr>
            <td><textarea name="descricao" class="inpute" id="descricao" title="Descrição do Produto" rows="5"><?=$descricao?></textarea></td>
        </tr>
        <?
        if($id) {
            ?>
        <script type="text/javascript">
            function muda_revestimento(id_revestimento){
                var permit = document.getElementById('permit' + id_revestimento);
                if (permit.checked == true) {
                    var acao = 'remover';
                }
                else {
                    var acao = 'adicionar';
                }

                $.ajax({
                    type: "POST",
                    url: "<?=$url_base?>/cgi/_mods/madesq_produtos/upload_revestimento.php?noob=" + new Date().getTime(),
                    data: "id_produto=<?=$id?>&id_revestimento=" + escape(id_revestimento) + "&acao=" + escape(acao),
                    beforeSend: function(){
                        $("#status").show().text("Aguarde...");
                    },
                    success: function(){
                        $("#status").show().text("Revestimento atualizado com sucesso.");
                    }
                });
            }
        </script>
        <tr>
            <td class="tit_campo">Revestimentos:</td>
        </tr>
        <tr>
            <td>
                <div id="status"></div>
                    <?php
                    $checkbox_stat = array();
                    $permissoes = $con_cliente->executa("SELECT * FROM produtos_revestimentos WHERE id_produto = $id");
                    if ($permissoes && mysqli_num_rows($permissoes) > 0) {
                        while ($permissao = mysqli_fetch_assoc($permissoes)) {
                            $checkbox_stat[$permissao['id_revestimento']] = 'checked="checked"';
                        }
                    }
                    $estados = $con_cliente->executa("SELECT * FROM revestimentos ORDER BY revestimento");
                    if ($estados && mysqli_num_rows($estados) > 0) {
                        while ($estadiu = mysqli_fetch_assoc($estados)) {
                            if ($id_revestimento == $estadiu['id_revestimento'])
                                $selected = 'selected="selected"';

                            ?>
                <div class="revestimento">
                    <div class="thumb"><img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img/revestimentos/thumbs/<?=$estadiu['imagem']?>" /></div>
                    <label for="permit<?=$estadiu['id_revestimento']?>" onclick="muda_revestimento(<?=$estadiu['id_revestimento']?>)">
                                    <?= utf8_encode($estadiu['revestimento'])?>
                    </label>
                    <input type="checkbox" name="permits[]" id="permit<?=$estadiu['id_revestimento']?>" value="<?=$estadiu['id_revestimento']?>"<?= $checkbox_stat[$estadiu['id_revestimento']]?> class="crirHiddenJS"/>
                </div>
                            <?php
                        }
                    }
                    ?>
            </td>
        </tr>
            <?php
        }
        ?>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=
                $mod

                               ?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>