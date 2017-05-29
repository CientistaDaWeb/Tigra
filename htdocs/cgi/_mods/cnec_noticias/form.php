<?php
require_once("noticias.php");
if($id) {
    $pesquisa = new noticias();
    $pesquisa->busca($id);
    $id_noticia = $pesquisa->id_noticia;
    $id_noticias_categoria = $pesquisa->id_noticias_categoria;
    $id_setor = $pesquisa->id_setor;
    $titulo = $pesquisa->titulo;
    $texto = $pesquisa->texto;
    $imagem = $pesquisa->imagem;
    $data = ajustadata($pesquisa->data,'site');
    $destaque = $pesquisa->destaque;
}
?>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/datePicker.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/date.js"> </script>
<!--[if IE]>
    <script type="text/javascript" src="<?=$url_base?>/cgi/_js/bigframe.js"> </script>
<![endif]-->
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/datePicker.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tabs").tabs();
        $("#data").datePicker({
            startDate: '01/01/2000',
            displayClose : true,
            clickInput : true
        });
    });
</script>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-noticia">Notícia</a>
        </li>
        <li>
            <a href="#tab-fotos">Fotos</a>
        </li>
        <li>
            <a href="#tab-arquivos">Arquivos</a>
        </li>
    </ul>
    <div id="tab-noticia">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
            <input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Setor:</td>
                </tr>
                <tr>
                    <td><select class="inpute gde" name="id_setor" id="id_setor">
                            <?php
                            $query = 'SELECT * FROM setors ORDER BY setor';
                            $categorias = $con_cliente->query($query);
                            if($categorias && $categorias->num_rows > 0) {
                                while($categoria = $categorias->fetch_assoc()) {
                                    if($categoria['id_setor'] == $id_setor) {
                                        echo '<option value="'.$categoria['id_setor'].'" selected="selected">'.$categoria['setor'].'</option>';
                                    }else {
                                        echo '<option value="'.$categoria['id_setor'].'">'.$categoria['setor'].'</option>';
                                    }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Categoria:</td>
                </tr>
                <tr>
                    <td><select name="id_noticias_categoria" id="id_noticias_categoria" class="inpute">
                            <?php
                            $query = 'SELECT * FROM noticias_categorias ORDER BY categoria';
                            $categorias = $con_cliente->query($query);
                            if($categorias && $categorias-> num_rows > 0) {
                                while($categoria = $categorias->fetch_assoc()) {
                                    ?>
                            <option value="<?=$categoria['id_noticias_categoria']?>" <? if($categoria['id_noticias_categoria'] == $id_noticias_categoria) {?>selected<?}?>><?=$categoria['categoria']?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Titulo:</td>
                </tr>
                <tr>
                    <td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$titulo?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Texto:</td>
                </tr>
                <tr>
                    <td><textarea name="texto" class="inpute" id="texto" rows="5"><?=$texto?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Imagem:</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if($imagem) {
                            ?>
                        <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],'h0s7')?>/noticias/thumbs/<?=$imagem?>" /><br />
                            <?php
                        }
                        ?>
                        <input type="file" name="imagem" id="imagem" class="inpute">
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">Data:</td>
                </tr>
                <tr>
                    <td><input type="text" name="data" id="data" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data" value="<?=$data?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Destaque:</td>
                </tr>
                <tr>
                    <td>
                        <label><input type="radio" name="destaque" <?php if($destaque == 1) { ?>checked<?php }?> value="1" /> Sim</label>
                        <label><input type="radio" name="destaque" <?php if($destaque != 1) { ?>checked<?php }?> value="2" /> Não</label>
                    </td>
                </tr>
            </table>
            <table id="table_botoes_rodape">
                <tr>
                    <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
                    <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
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
        <form action="<?=$url_base?>/cgi/_mods/cnec_noticias/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
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
    <div id="tab-arquivos">
        <?php
        if(!$id) {
            echo '<p class="vazio">Salve a notícia antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/cnec_noticias/upload_arquivos.php" method="post" id="FArquivo" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
            <input type="file" name="input_arquivo" />
            <button type="submit">
                Enviar
            </button>
        </form>
        <h3>Arquivos:</h3>
        <div id="listaArquivos">
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
</style>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/uploadify.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/swfobject.js"> </script>
<script type="text/javascript">
    var dataFotos = "<?=$url_base?>/cgi/_mods/cnec_noticias/data_fotos.php";
    function pegaImagens(){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos, {'id_noticia': '<?=$id?>'}, function(data){
            $("#listaImagens").html(data);
        });
    }
    function editarImagem(self, id){
        $("#listaImagens").html('Processando...');
        var legenda = $(self).parent().find("input").val();
        $.post(dataFotos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_noticia':'<?=$id?>'}, pegaImagens);
    }
    function excluirImagem(id){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos,{'id':id, 'action':'del','id_noticia':'<?=$id?>'}, pegaImagens);
    }
    $(document).ready(function() {
        $("#listaImagens").html('Processando...');
        pegaImagens();
        $('#FFoto').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/cnec_noticias/upload_fotos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Fotos',
            'fileDesc' : 'Imagens(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_noticia':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
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

    var dataArquivos = "<?=$url_base?>/cgi/_mods/cnec_noticias/data_arquivos.php";
    function pegaArquivos(){
        $("#listaArquivos").html('Processando...');
        $.post(dataArquivos, {'id_noticia':'<?=$id?>'}, function(data){
            $("#listaArquivos").html(data);
        });
    }
    function editarArquivo(self, id){
        $("#listaArquivos").html('Processando...');
        var legenda = $(self).parent().find("input").val();
        $.post(dataArquivos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_noticia':'<?=$id?>'}, pegaArquivos);
    }
    function excluirArquivo(id){
        $.post(dataArquivos,{'id':id, 'action':'del','id_noticia':'<?=$id?>'}, pegaArquivos);
    }
    $(document).ready(function() {
        $("#listaArquivos").html('Processando...');
        pegaArquivos();
        $('#FArquivo').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/cnec_noticias/upload_arquivos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_css/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Arquivos',
            'fileDesc' : 'Arquivos(PDF)',
            'fileExt' : '*.pdf',
            'scriptData' : {'id_noticia':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
            onComplete: function(a,b,c,d,e) {
                if(d != "1"){
                    alert(d);
                }
            },
            onAllComplete: function() {
                pegaArquivos();
            }
        });
    });
</script>
    <?php
}
?>