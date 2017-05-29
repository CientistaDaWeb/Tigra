<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
        $('#lista').dataTable({
            "oLanguage": {
                "sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "aaSorting": [[ 2, "asc" ]],
            "aoColumns":[
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": true},
                {"bSortable": true}
            ]
        });
        
    });
</script>
<style>
    #lista_length{
        float: left;
        width: 200px;
    }
    #lista_filter{
        float: right;
        width: 280px;
    }
</style>
<div id="tabs">
    <ul>
        <li><a href="#tab-aprovados">Usuários Aprovados</a></li>
        <li><a href="#tab-nao-aprovados">Usuários Não Aprovados</a></li>
    </ul>
    <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
        <table id="table_botoes">
            <tr>
                <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
                <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
            </tr>
        </table>
        <div id="tab-aprovados">
            <?php
            $query = 'SELECT id_usuarios_permitido, nome, email FROM usuarios_permitidos WHERE status = 1';
            $busca = $con_cliente->executa($query);
            if($busca && mysqli_num_rows($busca)>0) {
                ?>
            <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Razão Social/Nome</th>
                        <th>Acessos</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        while($item = mysqli_fetch_assoc($busca)) {
                            $i = 0;
                            $zebrado = array('even','odd');
                            ?>
                    <tr class="<?=$zebrado[$i%2]?>">
                        <td class="campo_checkbox"><label for="checkbox<?=$item['id_usuarios_permitido']?>" id="label<?=$item['id_usuarios_permitido']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_usuarios_permitido']?>" value="<?=$item['id_usuarios_permitido']?>" /></td>
                        <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_usuarios_permitido']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                        <td><?=$item['nome']?></td>
                        <td><?=$item['email']?></td>
                    </tr>
                            <?php
                            $i++;
                        }
                        ?>
                </tbody>
            </table>
                <?php
            }else {
                ?>
            <div><span class="vazio">Não foi encontrado nenhum usuário.</span></div>
                <?php
            }
            ?>
        </div>
        <div id="tab-nao-aprovados">
            <?php
            $query = 'SELECT id_usuarios_permitido, nome, email FROM usuarios_permitidos WHERE status != 1';
            $busca = $con_cliente->executa($query);
            if($busca && mysqli_num_rows($busca)>0) {
                ?>
            <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        while($item = mysqli_fetch_assoc($busca)) {
                            $i++;
                            ?>
                    <tr class="<?=$zebrado[$i%2]?>">
                        <td class="campo_checkbox"><label for="checkbox<?=$item['id_usuarios_permitido']?>" id="label<?=$item['id_usuarios_permitido']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_usuarios_permitido']?>" value="<?=$item['id_usuarios_permitido']?>" /></td>
                        <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_usuarios_permitido']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                        <td><?=$item['nome']?></td>
                        <td><?=$item['email']?></td>
                    </tr>
                            <?php
                        }
                        ?>
                </tbody>
            </table>
                <?php
            }else {
                ?>
            <div><span class="vazio">Não foi encontrado nenhum usuário.</span></div>
                <?php
            }
            ?>
        </div>
    </form>
</div>