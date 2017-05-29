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
    $participacao = $pesquisa->participacao;
    $imagem = $pesquisa->imagem;
    $andamento = $pesquisa->andamento;
    $ordem = $pesquisa->ordem;

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
        $("#data_video, #data_texto").datePicker({
            startDate: '01/01/2000',
            displayClose : true,
            clickInput : true
        });
    });
</script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js">
</script>
<script type="text/javascript">
    function deleta_video(id){
        zera_sessao();
        $.ajax({
            type: "POST",
            url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_videos.php?noob=" + new Date().getTime(),
            data: "id_obra=<?=$id_obra?>&del_item=" + id,
            success: function(msg){
                $('#videos').empty();
                $("#videos").append(msg);
            }
        });
    }

    function deleta_texto(id){
        zera_sessao();
        $.ajax({
            type: "POST",
            url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_textos.php?noob=" + new Date().getTime(),
            data: "id_obra=<?=$id_obra?>&del_item=" + id,
            success: function(msg){
                $('#textos').empty();
                $("#textos").append(msg);
            }
        });
    }

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
        <li>
            <a href="#tab-videos">Vídeos</a>
        </li>
        <li>
            <a href="#tab-textos">Textos</a>
        </li>
    </ul>
    <div id="tab-obras">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">
                        Categoria:
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="id_obras_categoria" class="inpute gde">
                            <?php
                            $categorias = $con_cliente->executa("SELECT id_obras_categoria, categoria FROM obras_categorias AS oc");
                            if ($categorias && mysqli_num_rows($categorias) > 0) {
                                while ($categoria = mysqli_fetch_assoc($categorias)) {
                                    if ($categoria['id_obras_categoria'] == $id_obras_categoria) {
                                        $categoria_sel[$categoria['id_obras_categoria']] = 'selected ="selected"';
                                    }

                                    ?>
                            <option value="<?=$categoria['id_obras_categoria']?>"<?= $categoria_sel[$categoria['id_obras_categoria']]?>><?= $categoria['categoria']?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">
                        Titulo da Obra:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="TÃ­tulo da Obra" value="<?=$nome?>" />
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">
                        Participação:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="participacao" id="participacao" maxlength="255" class="inpute gde" title="Participação" value="<?=$participacao?>" />
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">
                        Descrição:
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea class="inpute" name="descricao" id="descricao" rows="15">
                            <?= $descricao?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">
                        Ordem de Apresentação:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="ordem" id="ordem" maxlength="255" class="inpute pqno" title="Ordem" value="<?=$ordem?>" />
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">
                        Imagem:
                    </td>
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
        <form action="<?=$url_base?>/cgi/_mods/pol_obras/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <input type="file" name="input_foto" />
            <button type="submit">
                Enviar
            </button>
        </form>
        <input type="text" id="Fdata" name="Fdata" class="data" value="<?php echo date('d/m/Y') ?>" />
        <input type="text" id="Flegenda" name="Flegenda" value="Legenda" class="legenda" />
        <h3>Fotos:</h3>
        <div id="listaImagens">
        </div>
            <?php
        }
        ?>
    </div>
    <div id="tab-videos">
        <?php
        if (!$id) {
            echo '<p class="vazio">Salve a obra antes!</p>';
        } else {

            ?>
        <form id="upload_video" enctype="multipart/form-data" method="POST">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <div>
                <table>
                    <tr>
                        <td class="tit_campo">
                            Vídeo:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" id="video" name="video" class="inpute gde" value="Procurar"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="tit_campo">
                            Legenda:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="legenda_video" id="legenda_video" maxlength="255" class="inpute gde" title="Legenda" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td class="tit_campo">
                            Data:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="data_video" id="data_video" maxlength="10" class="inpute medio date-pick dp-applied" title="Data" value="<?=$data?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="tit_campo">
                            Duração:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="duracao" id="duracao" maxlength="255" class="inpute medio" title="Duração" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_videos.php','videos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">
                                Enviar
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div id="videos">
                <?php
                $videos = $con_cliente->executa("SELECT * FROM obras_videos WHERE id_obra = $id_obra");
                if ($videos && mysqli_num_rows($videos) > 0) {
                    while ($video = mysqli_fetch_assoc($videos)) {
                        ?>
            <div class="miniatura">
                <p>
                                <?= $video['video']?>
                </p>
                <p>
                                <?= ajustadata($video['data'], 'site')?>
                </p>
                <p>
                                <?= $video['legenda']?>
                </p>
                <p>
                                <?= $video['duracao']?>
                </p>
                <p style="text-align:center">
                    <a onclick="deleta_video(<?=$video['id_obras_video']?>);" style="cursor:pointer">Excluir</a>
                </p>
            </div>
                        <?php
                    }
                } else {
                    echo("<p class='vazio'>Não tem videos cadastrados!</p>");
                }
                ?>
        </div>
            <?php
        }
        ?>
    </div>
    <div id="tab-textos">
        <?php
        if (!$id) {
            echo '<p class="vazio">Salve a obra antes!</p>';
        } else {

            ?>
        <form id="upload_texto" enctype="multipart/form-data" method="POST">
            <input type="hidden" value="<?=$id_obra?>" name="id_obra" id="id_obra" />
            <div>
                <table>
                    <tr>
                        <td class="tit_campo">
                            Texto:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="inpute" id="texto" name="texto">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="tit_campo">
                            Data:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="data_texto" id="data_texto" maxlength="10" class="inpute medio date-pick dp-applied" title="Data" value="<?=$data?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_textos.php','textos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">
                                Enviar
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div id="textos">
                <?php
                $textos = $con_cliente->executa("SELECT * FROM obras_textos WHERE id_obra = $id_obra");
                if ($textos && mysqli_num_rows($textos) > 0) {
                    while ($texto = mysqli_fetch_assoc($textos)) {

                        ?>
            <div class="galeria_texto">
                            <?= $texto['texto']?>
                <p>
                                <?= ajustadata($texto['data'], 'site')?>
                </p>
                <p>
                                <?= $texto['legenda']?>
                </p>
                <p style="text-align:center">
                    <a onclick="deleta_texto(<?=$texto['id_obras_texto']?>);" style="cursor:pointer">Excluir</a>
                </p>
            </div>
                        <?php
                    }
                } else {
                    echo("<p class='vazio'>Não tem textos cadastrados!</p>");
                }
                ?>
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
    var dataFotos = "<?=$url_base?>/cgi/_mods/pol_obras/data_fotos.php";
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
            'script' : '<?=$url_base?>/cgi/_mods/pol_obras/upload_fotos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Fotos',
            'fileDesc' : 'Imagens(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_obra':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>,'data':'<?php echo date('d/m/Y'); ?>'},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaImagens();
            }
        });
        $("#Flegenda, #Fdata").blur(function(){
            $('#FFoto').uploadifySettings('scriptData', {'legenda' : $("#Flegenda").val(),'data' : $("#Fdata").val()});
        });
    });
</script>
    <?php
}
?>
