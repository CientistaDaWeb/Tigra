<?php
require_once ('linhas.php');
if ($id) {
    $pesquisa = new linhas();
    $pesquisa->busca($id);
    $id_linha = $pesquisa->id_linha;
    $linha = $pesquisa->linha;
    ?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
    function zera_sessao(){
        document.getElementById('fim_sessao_sec').value = '1200';
    }
</script>
    <?php
}
?>
<script type="text/javascript">
    $(function(){
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-linhas">Linhas</a>
        </li>
        <li>
            <a href="#tab-produtos">Produtos</a>
        </li>
        <li>
            <a href="#tab-ambientes">Ambientes</a>
        </li>
    </ul>
    <div id="tab-linhas">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
            <input type="hidden" value="<?=$id_linha?>" name="id_linha" id="id_linha" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Título da linha:</td>
                </tr>
                <tr>
                    <td><input type="text" name="linha" id="linha" maxlength="255" class="inpute gde obrigatorio" title="Título da linha" value="<?=$linha?>" /></td>
                </tr>
            </table>
            <table id="table_botoes_rodape">
                <tr>
                    <td>
                        <input class="btn_salvar" type="submit" value="" id="bt_salvar"/>
                    </td>
                    <td>
                        <input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="tab-produtos">
        <?php
        if(!$id) {
            echo '<p class="vazio">Salve a linha antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/sd_linhas/upload_produtos.php" method="post" id="Fproduto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_linha?>" name="id_linha" id="id_linha" />
            <input type="file" name="input_produto" />
            <button type="submit">
                Enviar
            </button>
        </form>
        <input type="text" id="Flegenda" name="Flegenda" value="Legenda" class="legenda" />
        <h3>Produtos:</h3>
        <div id="listaProdutos">
        </div>
            <?php
        }
        ?>
    </div>
    <div id="tab-ambientes">
        <?php
        if(!$id) {
            echo '<p class="vazio">Salve a linha antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/sd_linhas/upload_ambientes.php" method="post" id="Fambiente" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_linha?>" name="id_linha" id="id_linha" />
            <input type="file" name="input_ambiente" />
            <button type="submit">
                Enviar
            </button>
        </form>
        <input type="text" id="Alegenda" name="Alegenda" value="Legenda" class="legenda" />
        <h3>Ambientes:</h3>
        <div id="listaAmbientes">
        </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
if($id) {
    ?>
<style>
    .box{
        float: left;
        display: inline;
        width: 253px;
        margin: 2px 3px 3px 2px;
        border: 1px solid #CCC;
        padding: 3px;
        text-align: center;
    }
    .box input{
        width: 250px;
        border: 1px solid #CCC;
        margin: 5px 0;
    }
    .box a{
        text-align: center;
        padding: 2px 3px;
        text-align: center;
        cursor: pointer;
    }
    .paginacao{
        clear: both;
    }
</style>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/uploadify.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/swfobject.js"> </script>
<script type="text/javascript">
    //Produtos
    var dataprodutos = "<?=$url_base?>/cgi/_mods/sd_linhas/data_produtos.php";
    function pegaProdutos(pagina){
        $("#listaProdutos").html('Processando...');
        $.post(dataprodutos, {'id_linha': '<?=$id?>','pagina':pagina}, function(data){
            $("#listaProdutos").html(data);
        });
    }
    function editarProdutos(self, id){
        $("#listaProdutos").html('Processando...');
        var legenda = $(self).parent().find(".legenda").val();
        var data = $(self).parent().find(".data").val();
        $.post(dataprodutos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_linha':'<?=$id?>'}, pegaProdutos);
    }
    function excluirProdutos(id){
        $("#listaProdutos").html('Processando...');
        $.post(dataprodutos,{'id':id, 'action':'del','id_linha':'<?=$id?>'}, pegaProdutos);
    }
    $(document).ready(function() {
        $("#listaProdutos").html('Processando...');
        pegaProdutos();
        $('#Fproduto').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/sd_linhas/upload_produtos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar produtos',
            'fileDesc' : 'Produtos(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_linha':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaProdutos();
            }
        });
    });
    //Ambientes
    var dataambientes = "<?=$url_base?>/cgi/_mods/sd_linhas/data_ambientes.php";
    function pegaAmbientes(pagina){
        $("#listaAmbientes").html('Processando...');
        $.post(dataambientes, {'id_linha': '<?=$id?>','pagina':pagina}, function(data){
            $("#listaAmbientes").html(data);
        });
    }
    function editarAmbiente(self, id){
        $("#listaAmbientes").html('Processando...');
        var legenda = $(self).parent().find(".legenda").val();
        var data = $(self).parent().find(".data").val();
        $.post(dataambientes,{'legenda':legenda, 'id':id, 'action':'edit', 'id_linha':'<?=$id?>'}, pegaAmbientes);
    }
    function excluirAmbiente(id){
        $("#listaAmbientes").html('Processando...');
        $.post(dataambientes,{'id':id, 'action':'del','id_linha':'<?=$id?>'}, pegaAmbientes);
    }
    $(document).ready(function() {
        $("#listaAmbientes").html('Processando...');
        pegaAmbientes();
        $('#Fambiente').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/sd_linhas/upload_ambientes.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar ambientes',
            'fileDesc' : 'Ambientes(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_linha':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaAmbientes();
            }
        });
    });
</script>
    <?php
}
?>