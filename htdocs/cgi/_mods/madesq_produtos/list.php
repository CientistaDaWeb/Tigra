<style>
    h3{padding: 5px;
       text-align: center
    }
</style>
<script type="text/javascript">
    $(function() {
        $("#tab-moveis").tabs();
        $("#tab-esquadrias").tabs();
        $("#tab-fechaduras").tabs();
        $("#tab-puxadores").tabs();
        $("#tab-moveis ul li a, #tab-esquadrias ul li a, #tab-fechaduras ul li a, #tab-puxadores ul li a").click(function(){
            var categoria = $(this).attr("rel");
            $.ajax({
                type: "POST",
                url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/muda_sessao.php?noob="+ new Date().getTime(),
                data: "categoria="+categoria
            });
        });
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
    <table id="table_botoes">
        <tr>
            <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
            <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
        </tr>
    </table>
    <div id="tab-moveis">
        <h3>Móveis</h3>
        <ul>
            <?php
            $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 1 ORDER BY categoria';
            $categorias = $con_cliente->query($query);
            while($categoria = $categorias->fetch_assoc()) {
                $i = 0;
                $zebrado = array('even','odd');
                ?>
            <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
                <?php
            }
            ?>
        </ul>



        <?php
        $categorias = $con_cliente->query($query);
        while($categoria = $categorias->fetch_assoc()) {

            ?>
        <div id="tab-<?=$categoria['slug']?>">
                <?php

                $query = 'SELECT id_produto, nome, referencia FROM produtos p INNER JOIN produtos_categorias pc ON p.id_produtos_categoria = pc.id_produtos_categoria WHERE pc.slug="'.$categoria['slug'].'" ORDER BY p.nome';
                $busca = $con_cliente->executa($query);
                if($busca && mysqli_num_rows($busca)>0) {
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
                            while($item = mysqli_fetch_assoc($busca)) {
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
                }else {
                    ?>
            <div><span class="vazio">Não foi encontrado nenhum produto.</span></div>
                    <?php
                }
                ?>
        </div>
            <?php

        }
        ?>
    </div>
    <div id="tab-esquadrias">
        <h3>Esquadrias</h3>
        <ul>
            <?php
            $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 2 ORDER BY categoria';
            $categorias = $con_cliente->query($query);
            while($categoria = $categorias->fetch_assoc()) {
                $i = 0;
                $zebrado = array('even','odd');
                ?>
            <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
                <?php
            }
            ?>
        </ul>



        <?php
        $categorias = $con_cliente->query($query);
        while($categoria = $categorias->fetch_assoc()) {

            ?>
        <div id="tab-<?=$categoria['slug']?>">
                <?php

                $query = 'SELECT id_produto, nome, referencia FROM produtos p INNER JOIN produtos_categorias pc ON p.id_produtos_categoria = pc.id_produtos_categoria WHERE pc.slug="'.$categoria['slug'].'" ORDER BY p.nome';
                $busca = $con_cliente->executa($query);
                if($busca && mysqli_num_rows($busca)>0) {
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
                            while($item = mysqli_fetch_assoc($busca)) {
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
                }else {
                    ?>
            <div><span class="vazio">Não foi encontrado nenhum produto.</span></div>
                    <?php
                }
                ?>
        </div>
            <?php

        }
        ?>
    </div>
    <div id="tab-fechaduras">
        <h3>Fechaduras</h3>
        <ul>
            <?php
            $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 3 ORDER BY categoria';
            $categorias = $con_cliente->query($query);
            while($categoria = $categorias->fetch_assoc()) {
                $i = 0;
                $zebrado = array('even','odd');
                ?>
            <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
                <?php
            }
            ?>
        </ul>



        <?php
        $categorias = $con_cliente->query($query);
        while($categoria = $categorias->fetch_assoc()) {

            ?>
        <div id="tab-<?=$categoria['slug']?>">
                <?php

                $query = 'SELECT id_produto, nome, referencia FROM produtos p INNER JOIN produtos_categorias pc ON p.id_produtos_categoria = pc.id_produtos_categoria WHERE pc.slug="'.$categoria['slug'].'" ORDER BY p.nome';
                $busca = $con_cliente->executa($query);
                if($busca && mysqli_num_rows($busca)>0) {
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
                        <th>Fechadura</th>
                        <th>Referência</th>
                    </tr>
                </thead>
                <tbody>
                            <?php
                            while($item = mysqli_fetch_assoc($busca)) {
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
                }else {
                    ?>
            <div><span class="vazio">Não foi encontrado nenhuma fechadura.</span></div>
                    <?php
                }
                ?>
        </div>
            <?php

        }
        ?>
    </div>
    <div id="tab-puxadores">
        <h3>Puxadores</h3>
        <ul>
            <?php
            $query = 'SELECT * FROM produtos_categorias WHERE main_cat = 4 ORDER BY categoria';
            $categorias = $con_cliente->query($query);
            while($categoria = $categorias->fetch_assoc()) {
                $i = 0;
                $zebrado = array('even','odd');
                ?>
            <li><a href="#tab-<?=$categoria['slug']?>" rel="<?=$categoria['id_produtos_categoria']?>"><?=$categoria['categoria']?></a></li>
                <?php
            }
            ?>
        </ul>



        <?php
        $categorias = $con_cliente->query($query);
        while($categoria = $categorias->fetch_assoc()) {

            ?>
        <div id="tab-<?=$categoria['slug']?>">
                <?php

                $query = 'SELECT id_produto, nome, referencia FROM produtos p INNER JOIN produtos_categorias pc ON p.id_produtos_categoria = pc.id_produtos_categoria WHERE pc.slug="'.$categoria['slug'].'" ORDER BY p.nome';
                $busca = $con_cliente->executa($query);
                if($busca && mysqli_num_rows($busca)>0) {
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
                        <th>Puxador</th>
                        <th>Referência</th>
                    </tr>
                </thead>
                <tbody>
                            <?php
                            while($item = mysqli_fetch_assoc($busca)) {
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
                }else {
                    ?>
            <div><span class="vazio">Não foi encontrado nenhum Puxador.</span></div>
                    <?php
                }
                ?>
        </div>
            <?php

        }
        ?>
    </div>
</form>