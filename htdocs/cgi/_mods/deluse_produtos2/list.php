<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();

        $("#tabs ul li a").click(function(){
            var categoria = $(this).attr("rel");
            $.ajax({
                type: "POST",
                url: "<?=$url_base?>/cgi/_mods/deluse_produtos/muda_sessao.php?noob="+ new Date().getTime(),
                data: "categoria="+categoria
            });
        });
    });
</script>
<?php
$_SESSION['deluse_cat'] = '2';
$query = 'SELECT * FROM produtos_categorias';
$categorias = $con_cliente->query($query);
?>
<div id="tabs">
    <ul>
        <?php
        while($categoria = $categorias->fetch_assoc()){
            $i = 0;
            $zebrado = array('even','odd');
            ?>
        <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
        <?php
    }
    ?>
    </ul>
    <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
        <table id="table_botoes">
            <tr>
                <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
                <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
            </tr>
        </table>

        <?php
        $categorias = $con_cliente->query($query);
        $visibilidade = array(
                    '2' => '<span class="vRestrito">Restrito</span>',
                    '1' => '<span class="vSite">Site e Restrito</span>',
        );
        while($categoria = $categorias->fetch_assoc()){

            ?>
        <div id="tab-<?=$categoria['slug']?>">
            <?php

            $query = 'SELECT p.id_produto, p.nome, p.referencia, pc.categoria FROM produtos p INNER JOIN produtos_categorias pc ON p.id_produtos_categoria = pc.id_produtos_categoria WHERE pc.slug="'.$categoria['slug'].'" ORDER BY p.nome';
            $busca = $con_cliente->executa($query);
            if($busca && mysqli_num_rows($busca)>0){
                ?>
            <table width="100%">
                <tr>
                    <td class="campo_checkbox" id="selectall"><label for="select_all" id="label_select_all">Selecionar / Deselecionar</label><input type="checkbox" class="crirHiddenJS" name="select_all" id="select_all" onchange="check_all()" /></td>
                </tr>
            </table>
            <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Produto</th>
                        <th>Referência</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($item = mysqli_fetch_assoc($busca)){
                        $i++;
                        ?>
                    <tr class="<?=$zebrado[$i%2]?>">
                        <td class="campo_checkbox"><label for="checkbox<?=$item['id_produto']?>" id="label<?=$item['id_produto']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_produto']?>" value="<?=$item['id_produto']?>" /></td>
                        <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_produto']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                        <td><?=$item['nome']?></td>
                        <td><?=$item['referencia']?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }else{
            ?>
            <div><span class="vazio">Não foi encontrado nenhum produto.</span></div>
            <?php
        }
        ?>
        </div>
        <?php

    }
    ?>
    </form>
</div>