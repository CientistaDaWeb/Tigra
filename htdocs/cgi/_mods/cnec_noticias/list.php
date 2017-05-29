<script type="text/javascript">
    $(document).ready(function(){
        $('#lista').dataTable({
            "oLanguage": {
                "sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "aaSorting": [[ 2, "desc" ]],
            "aoColumns":[
                {"bSortable": false},
                {"bSortable": false},
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
        </tr>
    </table>
    <?php
    $query = 'SELECT n.id_noticia, n.data, n.titulo, nc.categoria, s.setor FROM noticias n, noticias_categorias nc, setors s WHERE s.id_setor = n.id_setor AND n.id_noticias_categoria = nc.id_noticias_categoria';
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
                <th>Data</th>
                <th>Título</th>
                <th>Categoria</th>
                <th>Setor</th>
            </tr>
        </thead>
        <tbody>
                <?php
                while($item = mysqli_fetch_assoc($busca)) {
                    ?>
            <tr>
                <td class="campo_checkbox"><label for="checkbox<?=$item['id_noticia']?>" id="label<?=$item['id_noticia']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_noticia']?>" value="<?=$item['id_noticia']?>" /></td>
                <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_noticia']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
                <td><span style="display:none"><?=$item['data']?></span><?=ajustadata($item['data'],"site")?></td>
                <td><?=$item['titulo']?></td>
                <td><?=$item['categoria']?></td>
                <td><?=$item['setor']?></td>
            </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>
        <?php
    }else {
        ?>
    <div class="vazio">Não foi encontrado nenhuma notícia.</div>
        <?php
    }
    ?>
</form>
