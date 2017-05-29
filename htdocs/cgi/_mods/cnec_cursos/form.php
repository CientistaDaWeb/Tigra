<?php
require_once("cursos.php");
if($id) {
    $pesquisa = new cursos();
    $pesquisa->busca($id);
    $id_curso = $pesquisa->id_curso;
    $id_cursos_categoria = $pesquisa->id_cursos_categoria;
    $curso = $pesquisa->curso;
    $descricao = $pesquisa->descricao;
}
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-curso">Curso</a>
        </li>
        <li>
            <a href="#tab-fotos">Fotos</a>
        </li>
        <li>
            <a href="#tab-arquivos">Arquivos</a>
        </li>
    </ul>
    <div id="tab-curso">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
            <input type="hidden" value="<?=$id_curso?>" name="id_curso" id="id_curso" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Categoria:</td>
                </tr>
                <tr>
                    <td><select name="id_cursos_categoria" id="id_cursos_categoria" class="inpute">
                            <?php
                            $query = 'SELECT * FROM cursos_categorias ORDER BY categoria';
                            $categorias = $con_cliente->query($query);
                            if($categorias && $categorias-> num_rows > 0) {
                                while($categoria = $categorias->fetch_assoc()) {
                                    ?>
                            <option value="<?=$categoria['id_cursos_categoria']?>" <? if($categoria['id_cursos_categoria'] == $id_cursos_categoria) {?>selected<?}?>><?=$categoria['categoria']?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Curso:</td>
                </tr>
                <tr>
                    <td><input type="text" name="curso" id="curso" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$curso?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição:</td>
                </tr>
                <tr>
                    <td><textarea name="descricao" class="inpute" id="descricao" rows="5"><?=$descricao?></textarea></td>
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
            echo '<p class="vazio">Salve o curso antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/cnec_cursos/upload_fotos.php" method="post" id="FFoto" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_curso?>" name="id_curso" id="id_curso" />
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
            echo '<p class="vazio">Salve o curso antes!</p>';
        }else {
            ?>
        <form action="<?=$url_base?>/cgi/_mods/cnec_cursos/upload_arquivos.php" method="post" id="FArquivo" enctype="multipart/form-data">
            <input type="hidden" value="<?=$id_curso?>" name="id_curso" id="id_curso" />
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
    var dataFotos = "<?=$url_base?>/cgi/_mods/cnec_cursos/data_fotos.php";
    function pegaImagens(){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos, {'id_curso': '<?=$id?>'}, function(data){
            $("#listaImagens").html(data);
        });
    }
    function editarImagem(self, id){
        $("#listaImagens").html('Processando...');
        var legenda = $(self).parent().find("input").val();
        $.post(dataFotos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_curso':'<?=$id?>'}, pegaImagens);
    }
    function excluirImagem(id){
        $("#listaImagens").html('Processando...');
        $.post(dataFotos,{'id':id, 'action':'del','id_curso':'<?=$id?>'}, pegaImagens);
    }
    $(document).ready(function() {
        $("#listaImagens").html('Processando...');
        pegaImagens();
        $('#FFoto').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/cnec_cursos/upload_fotos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Fotos',
            'fileDesc' : 'Imagens(JPG e GIF)',
            'fileExt' : '*.jpg;*.gif',
            'scriptData' : {'id_curso':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
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

    var dataArquivos = "<?=$url_base?>/cgi/_mods/cnec_cursos/data_arquivos.php";
    function pegaArquivos(){
        $("#listaArquivos").html('Processando...');
        $.post(dataArquivos, {'id_curso':'<?=$id?>'}, function(data){
            $("#listaArquivos").html(data);
        });
    }
    function editarArquivo(self, id){
        $("#listaArquivos").html('Processando...');
        var legenda = $(self).parent().find("input").val();
        $.post(dataArquivos,{'legenda':legenda, 'id':id, 'action':'edit', 'id_curso':'<?=$id?>'}, pegaArquivos);
    }
    function excluirArquivo(id){
        $.post(dataArquivos,{'id':id, 'action':'del','id_curso':'<?=$id?>'}, pegaArquivos);
    }
    $(document).ready(function() {
        $("#listaArquivos").html('Processando...');
        pegaArquivos();
        $('#FArquivo').uploadify({
            'uploader' : '<?=$url_base?>/cgi/_swf/uploadify.swf',
            'script' : '<?=$url_base?>/cgi/_mods/cnec_cursos/upload_arquivos.php',
            'cancelImg' : '<?=$url_base?>/cgi/_css/_img/cancel.png',
            'auto' : true,
            'multi' : true,
            'scriptAccess': 'always',
            'buttonText' : 'Enviar Arquivos',
            'fileDesc' : 'Arquivos(PDF)',
            'fileExt' : '*.pdf',
            'scriptData' : {'id_curso':<?=$id?>, 'id_tg_cliente':<?=$_SESSION['id_tg_cliente']?>},
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