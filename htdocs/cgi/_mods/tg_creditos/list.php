<script type="text/javascript">
    $(document).ready(function(){
        $('#lista').dataTable({
            "oLanguage": {
                "sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "aaSorting": [[ 3, "asc" ], [2, 'desc']],
            "aoColumns":[
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true}
            ]
        });
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
    <table id="table_botoes">
        <tr>
            <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
            <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/remessa" title="Gerar em remessa">Gerar Remessa de Contas</a></td>
        </tr>
    </table>
    <?php
    $busca = $con_tigra->executa("SELECT d.id_tg_credito, d.data, d.status, d.valor, d.valor_pago, d.descritivo, c.id_tg_cliente, c.nome FROM tg_creditos AS d, tg_clientes AS c
        WHERE d.id_tg_cliente = c.id_tg_cliente");
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
                <th>Vencimento</th>
                <th></th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Valor Pago</th>
            </tr>
        </thead>
        <tbody>
                <?php
                $situacao = array(1=>'aguardando', 'aprovado');
                while($item = mysqli_fetch_assoc($busca)) {
                    ?>
            <tr>
                <td class="campo_checkbox"><label for="checkbox<?=$item['id_tg_credito']?>" id="label<?=$item['id_tg_credito']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_tg_credito']?>" value="<?=$item['id_tg_credito']?>" /></td>
                <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_tg_credito']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                <td><span style="display:none"><?=$item['data']?></span><?=ajustadata($item['data'],'site')?></td>
                <td><span class="situacao <?=$situacao[$item['status']]?>"></span></td>
                <td><?=$item['nome']?></td>
                <td>R$ <?=number_format($item['valor'],2,',','.')?></td>
                <td>R$ <?=number_format($item['valor_pago'],2,',','.')?></td>
            </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>
        <?php
    }else {
        ?>
    <div><span class="vazio">Não foi encontrada nenhuma conta.</span></div>
        <?php
    }
    ?>
</form>
