<?php
require_once('eventos.php');
$dominio = decripfy($_SESSION['dominio'],'h0s7');

if($id) {
    $pesquisa = new eventos();
    $pesquisa->busca($id);
    $id_evento = $pesquisa->id_evento;
    $evento = $pesquisa->evento;
    $local = $pesquisa->local;
    $data = $pesquisa->data;
    $imagem = $pesquisa->imagem;
    $descricao = $pesquisa->descricao;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-evento">Evento</a>
        </li>
        <li>
            <a href="#tab-fotos">Fotos</a>
        </li>
    </ul>
    <div id="tab-evento">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
            <input type="hidden" value="<?=$id_evento?>" name="id_evento" id="id_evento" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Evento</td>
                </tr>
                <tr>
                    <td><input type="text" name="evento" id="evento" maxlength="255" class="inpute gde obrigatorio" title="Evento" value="<?=$evento?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Local:</td>
                </tr>
                <tr>
                    <td><input type="text" name="local" id="local" maxlength="255" class="inpute gde" title="Local" value="<?=$local?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data de início:</td>
                </tr>
                <tr>
                    <?php
                    $data = explode('-', $data);
                    $data = $data[2].'/'.$data[1].'/'.$data[0];
                    ?>
                    <td><input type="text" name="data" id="data" maxlength="255" class="inpute obrigatorio" title="Data" value="<?=$data?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Imagem de Capa:</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if($imagem) {
                            ?>
                        <img src="http://images.weentigra.com.br/<?php echo $dominio?>/eventos/thumbs/<?=$imagem?>" /><br />
                            <?php
                        }
                        ?>
                        <input type="file" name="imagem" id="imagem" class="inpute">
                    </td>
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
            echo '<p class="vazio">Salve o evento antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/deluse_eventos/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_evento?>" name="id_evento" id="id_evento" />
            <input type="file" name="input_foto" />
            <button type="submit">
                Enviar
            </button>
        </form>
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
        eventor: pointer;
    }
</style>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/uploadify.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/swfobject.js"> </script>
<script type="text/javascript">
    var dataFotos = "<?=$url_base?>/cgi/_mods/deluse_eventos/data_fotos.php";
    function pegaImagens(){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos, {'id_evento': '<?=$id?>'}, function(data){
            $("#listaImagens").html(data);
        });
    }
    function editarImagem(self, id){
        $("#listaImagens").html('Processando...');
        var legenda = $(self).parent().find("input").val();
        $.post(dataFotos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_evento':'<?=$id?>'}, pegaImagens);
    }
    function excluirImagem(id){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos,{'id':id, 'action':'del','id_evento':'<?=$id?>'}, pegaImagens);
    }
    $(document).ready(function() {
        $("#listaImagens").html('Processando...');
        pegaImagens();
        $('#FFoto').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/deluse_eventos/upload_fotos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Fotos',
            'fileDesc' : 'Imagens(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_evento':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaImagens();
            }
        });
    });
</script>
    <?php
}
?>