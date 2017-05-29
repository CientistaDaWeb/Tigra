<?php 
require_once ('obras.php');
$data = date('d/m/Y');
if ($id) {
    $pesquisa = new obras();
    $pesquisa->busca($id);
    $id_obra = $pesquisa->id_obra;
    $id_obras_categoria = $pesquisa->id_obras_categoria;
    $nome = $pesquisa->nome;
    $descricao = $pesquisa->descricao;
    $data = ajustadata($pesquisa->data,'site');
    ?>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/datePicker.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/date.js"> </script>
<!--[if IE]>
    <script type="text/javascript" src="<?=$url_base?>/cgi/_js/bigframe.js"> </script>
<![endif]-->
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/datePicker.js">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data").datePicker({
            startDate: '01/01/2000',
            displayClose : true,
            clickInput : true
        });
    });
</script>
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
            <a href="#tab-obras">Obras</a>
        </li>
        <li>
            <a href="#tab-fotos">Fotos</a>
        </li>
    </ul>
    <div id="tab-obras">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Titulo da Obra:</td>
                </tr>
                <tr>
                    <td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="TÃ­tulo da Obra" value="<?=$nome?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data:</td>
                </tr>
                <tr>
                    <td><input type="text" name="data" id="data" maxlength="10" class="inpute medio date-pick dp-applied" title="Data" value="<?=$data?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="descricao" id="descricao" rows="15"><?= $descricao?></textarea></td>
                </tr>
            </table>
            <table id="table_botoes_rodape">
                <tr>
                    <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
                    <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="tab-fotos">
        <?php
        if(!$id) {
            echo '<p class="vazio">Salve a obra antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/obras/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <input type="file" name="input_foto" />
            <button type="submit">Enviar</button>
        </form>
        <input type="text" id="Flegenda" name="Flegenda" value="Legenda" class="legenda" />
        <h3>Fotos:</h3>
        <div id="listaImagens">
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
    var dataFotos = "<?=$url_base?>/cgi/_mods/obras/data_fotos.php";
    function pegaImagens(pagina){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos, {'id_obra': '<?=$id?>','pagina':pagina}, function(data){
            $("#listaImagens").html(data);
        });
    }
    function editarImagem(self, id){
        $("#listaImagens").html('Processando...');
        var legenda = $(self).parent().find(".legenda").val();
        var data = $(self).parent().find(".data").val();
        $.post(dataFotos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_obra':'<?=$id?>', 'data':data}, pegaImagens);
    }
    function excluirImagem(id){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos,{'id':id, 'action':'del','id_obra':'<?=$id?>'}, pegaImagens);
    }
    $(document).ready(function() {
        $("#listaImagens").html('Processando...');
        pegaImagens();
        $('#FFoto').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/obras/upload_fotos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Fotos',
            'fileDesc' : 'Imagens(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_obra':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaImagens();
            }
        });
        $("#Flegenda").blur(function(){
            $('#FFoto').uploadifySettings('scriptData', {'legenda' : $("#Flegenda").val()});
        });
    });
</script>
    <?php
}