<script type="text/javascript" src="<?= $url_base ?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
    var buscando = 'Buscando';
    var modulo = "<?= $mod ?>";
    function pagination(page){
        $('#page_contents').empty();
        $('#page_contents').append(buscando);
        var palavra = document.getElementById("searchtext").value;
        $.ajax({
            type: "POST",
            url: "/cgi/_mods/<?= $tg_mod ?>/data.php?noob="+ new Date().getTime(),
            data: "page="+escape(page)+"&searchtext="+escape(palavra)+"&modulo="+(modulo),
            success: function(msg){
                $('#page_contents').empty();
                $("#page_contents").append(msg);
            }
        });
    };
    function busca(palavra){
        $('#page_contents').empty();
        $('#page_contents').append(buscando);
        $.ajax({
            type: "POST",
            url: "/cgi/_mods/<?= $tg_mod ?>/data.php?noob="+ new Date().getTime(),
            data: "searchtext="+escape(palavra)+"&page=0&modulo="+(modulo),
            success: function(msg){
                $('#page_contents').empty();
                $("#page_contents").append(msg);
            }
        });
    }
</script>
<form id="upload_alunos" enctype="multipart/form-data" method="POST">
    <div>
        <h2>Importar Alunos</h2>
        <table>
            <tr>
                <td class="tit_campo" colspan="3">Setor:</td>
            </tr>
            <tr>
                <td colspan="2"><select class="inpute gde" name="id_setor" id="id_setor">
                        <?php
                        $query = 'SELECT * FROM setors ORDER BY setor';
                        $categorias = $con_cliente->query($query);
                        if ($categorias && $categorias->num_rows > 0) {
                            $id_setor = 1;
                            while ($categoria = $categorias->fetch_assoc()) {
                                if ($categoria['id_setor'] == $id_setor) {
                                    echo '<option value="' . $categoria['id_setor'] . '" selected="selected">' . $categoria['setor'] . '</option>';
                                } else {
                                    echo '<option value="' . $categoria['id_setor'] . '">' . $categoria['setor'] . '</option>';
                                }
                                ?>
                                <?php
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="file" id="arquivo" name="arquivo" class="inpute"  value="Procurar"/></td>
                <td><button onClick="micoxUpload(this.form,'<?= $url_base ?>/cgi/_mods/<?= $tg_mod ?>/importa_alunos.php','alunos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button" class="botao">Adicionar</button></td>
            </tr>
        </table>
    </div>
</form>
<div style="margin-top: 10px; border-top: 1px solid #000; padding: 10px 0;">
    <h2>Desativar Alunos</h2>
    <td><button id="desativarAlunos" style="margin-top: 10px" class="botao" type="text">Desativar</button></td>
</div>
<div style="margin: 10px 0; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 10px 0;">
    <form id="upload_boletim" enctype="multipart/form-data" method="POST">
        <input type="hidden" id="id_tg_cliente" name="id_tg_cliente" value="<?php echo $_SESSION['id_tg_cliente']?>" />
        <div>
            <h2>Enviar Boletim</h2>
            <table>
                <tr>
                    <td class="tit_campo" colspan="3">Setor:</td>
                </tr>
                <tr>
                    <td colspan="2"><select class="inpute gde" name="setor" id="setor">
                            <?php
                            $query = 'SELECT * FROM setors ORDER BY setor';
                            $categorias = $con_cliente->query($query);
                            if ($categorias && $categorias->num_rows > 0) {
                                $id_setor = 1;
                                while ($categoria = $categorias->fetch_assoc()) {
                                    if ($categoria['id_setor'] == $id_setor) {
                                        echo '<option value="' . $categoria['slug'] . '" selected="selected">' . $categoria['setor'] . '</option>';
                                    } else {
                                        echo '<option value="' . $categoria['slug'] . '">' . $categoria['setor'] . '</option>';
                                    }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><input type="file" id="arquivo" name="arquivo" class="inpute"  value="Procurar"/></td>
                    <td><button onClick="micoxUpload(this.form,'<?= $url_base ?>/cgi/_mods/<?= $tg_mod ?>/upload_boletim.php','alunos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button" class="botao">Enviar</button></td>
                </tr>
            </table>
        </div>
    </form>
</div>

<div id="alunos" style="margim-bottom: 10px;"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#desativarAlunos').click(function(){
            $.get('<?= $url_base ?>/cgi/_mods/<?php echo $tg_mod; ?>/desativa_alunos.php?noob=<?php echo date('U'); ?>',
            function(data){
                alert(data);
                $('#alunos').html(data);
            });
        });
    });
</script>

<form action="<?= $url_base ?>/cgi/<?= $mod ?>/action/" method="post" id="form_deletar" onsubmit="return valida_deletar();">
    <table id="table_botoes">
        <tr>
            <td><input type="button" onclick="window.location='<?= $url_base ?>/cgi/<?= $mod ?>/form'" value="Novo" id="bt_novo" /></td>
            <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td id="selectall"><input type="checkbox" name="select_all" id="select_all" onchange="check_all()" />
                <label for="select_all" id="label_select_all">Selecionar / Deselecionar</label>
            </td>
        </tr>
        <tr>
            <td>Buscar <input type="text" name="search_text" id="searchtext" value="<?= $searchText ?>" class="inpute medio" /></td>
        </tr>
    </table>
    <div id="page_contents">
        <noscript>
        Habilite o javascript no seu navegador!
        </noscript>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        pagination(0);
    });
</script>
