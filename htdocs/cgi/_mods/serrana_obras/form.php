<?php
require_once ('obras.php');
$data = date('d/m/Y');
if ($id) {
    $pesquisa = new obras();
    $pesquisa->busca($id);
    $id_obra = $pesquisa->id_obra;
    $nome = $pesquisa->nome;
    $descricao = $pesquisa->descricao;
    $longitude = $pesquisa->longitude;
    $latitude = $pesquisa->latitude;
    $endereco = $pesquisa->endereco;
    $lancamento = $pesquisa->lancamento;
    $destaque = $pesquisa->destaque;
    $descricao_destaque = $pesquisa->descricao_destaque;
    $concluido = $pesquisa->concluido;
    $imagem = $pesquisa->imagem;
    $pdf = $pesquisa->pdf;
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
                    <td class="tit_campo">Título da Obra:</td>
                </tr>
                <tr>
                    <td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Título da Obra" value="<?=$nome?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Endereço:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="endereco" id="endereco" rows="15"><?= $endereco?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Latitude:</td>
                </tr>
                <tr>
                    <td><input type="text" name="latitude" id="latitude" maxlength="255" class="inpute gde obrigatorio" title="Latitude" value="<?=$latitude?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Longitude:</td>
                </tr>
                <tr>
                    <td><input type="text" name="longitude" id="longitude" maxlength="255" class="inpute gde obrigatorio" title="Longitude" value="<?=$longitude?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="descricao" id="descricao" rows="15"><?= $descricao?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Imagem:</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if ($imagem) {

                            ?>
                        <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/obras/thumbs/<?=$imagem?>" />
                        <br>
                            <?php
                        }
                        ?>
                        <input type="file" name="imagem" id="imagem" class="inpute">
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">PDF:</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if ($pdf) {

                            ?>
                        <a href="http://docs.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/obras/<?=$pdf?>"><?=$pdf?></a>
                        <br>
                            <?php
                        }
                        ?>
                        <input type="file" name="pdf" id="pdf" class="inpute">
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">Obra em Destaque:</td>
                </tr>
                <tr>
                    <td><select class="inpute gde" name="destaque" id="destaque">
                            <option value="2">Não</option>
                            <option value="1" <?php if($destaque == 1) {
                                echo 'selected="selected"';
                                    }?>>Sim</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição para o destaque:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="descricao_destaque" id="descricao_destaque" rows="15"><?= $descricao_destaque?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Obra em Lançamentos:</td>
                </tr>
                <tr>
                    <td><select class="inpute gde" name="lancamento" id="lancamento">
                            <option value="2">Não</option>
                            <option value="1" <?php if($lancamento == 1) {
                                echo 'selected="selected"';
                                    }?>>Sim</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Obra Concluida:</td>
                </tr>
                <tr>
                    <td><select class="inpute gde" name="concluido" id="concluido">
                            <option value="2">Não</option>
                            <option value="1" <?php if($concluido == 1) {
                                echo 'selected="selected"';
                                    }?>>Sim</option>
                        </select></td>
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
    <div id="tab-fotos">
        <?php
        if(!$id) {
            echo '<p class="vazio">Salve a notícia antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/serrana_obras/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <input type="file" name="input_foto" />
            <button type="submit">
                Enviar
            </button>
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
    var dataFotos = "<?=$url_base?>/cgi/_mods/serrana_obras/data_fotos.php";
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
        $.post(dataFotos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_obra':'<?=$id?>'}, pegaImagens);
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
            'script' : '<?=$url_base?>/cgi/_mods/serrana_obras/upload_fotos.php',
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
?>