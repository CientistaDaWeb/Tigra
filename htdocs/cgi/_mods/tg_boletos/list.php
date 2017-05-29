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
                {"bSortable": false}
            ]
        });
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
    <table id="table_botoes">
        <tr>
            <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
            <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/remessa" title="Gerar em remessa">Gerar Remessa de Boletos</a></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/reenviar_boletos" title="Reenviar Boletos">Reenviar Boletos</a></td>
        </tr>
    </table>
    <?php
    $busca = $con_tigra->executa("SELECT b.id_tg_boleto, b.data, b.status, b.data_vencimento, b.valor, c.id_tg_cliente, c.nome FROM tg_boletos AS b, tg_clientes AS c
        WHERE b.id_tg_cliente = c.id_tg_cliente");
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
                <th>C&oacute;digo</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
                <?php
                $situacao = array(1=>'aguardando', 'aprovado');
                while($item = mysqli_fetch_assoc($busca)) {
                    ?>
            <tr>
                <td class="campo_checkbox"><label for="checkbox<?=$item['id_tg_boleto']?>" id="label<?=$item['id_tg_boleto']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_tg_boleto']?>" value="<?=$item['id_tg_boleto']?>" /></td>
                <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_tg_boleto']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                <td><span style="display:none"><?=$item['data_vencimento']?></span><?=ajustadata($item['data_vencimento'],'site')?></td>
                <td><?=substr('0000'.$item['id_tg_cliente'],-5)?>-<?=substr('0000'.$item['id_tg_boleto'],-5)?></td>
                <td><?=$item['nome']?></td>
                <td>R$ <?=number_format($item['valor'],2,',','.')?></td>
                <td><a href="http://www.weentigra.com.br/boleto/<?=cripfy($item['id_tg_boleto'],'b0l370')?>">Link</a></td>
            </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>
        <?php
    }else {
        ?>
    <div><span class="vazio">N&atilde;o foi encontrado nenhum boleto.</span></div>
        <?php
    }
    ?>
</form>
