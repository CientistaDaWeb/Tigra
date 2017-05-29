<?php
require_once("noticias.php");
if($id)	{
    $pesquisa = new noticias();
    $pesquisa->busca($id);
    $id_noticia = $pesquisa->id_noticia;
    $titulo = $pesquisa->titulo;
    $linha_apoio = $pesquisa->linha_apoio;
    $texto = $pesquisa->texto;
    $data = ajustadata($pesquisa->data,'site');
    $imagem = $pesquisa->imagem;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
    });
    $(function() {
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#tab-noticia">Noticia</a></li>
        <li><a href="#tab-fotos">Fotos</a></li>
    </ul>
    <div id="tab-noticia">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
            <input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Titulo:</td>
                </tr>
                <tr>
                    <td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$titulo?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Linha de Apoio:</td>
                </tr>
                <tr>
                    <td><input type="text" name="linha_apoio" id="linha_apoio" maxlength="255" class="inpute gde obrigatorio" title="Linha de Apoio" value="<?=$linha_apoio?>" /></td>
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
                        if($imagem){
                            ?>
                        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/noticias/thumbs/<?=$imagem?>" /><br />
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
                    <td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
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
        if ($id){
            ?>
        <script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
        <script type="text/javascript">
            function deleta_foto(id){
                $.ajax({
                    type: "POST",
                    url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_fotos.php?noob="+ new Date().getTime(),
                    data: "id_noticia=<?=$id_noticia?>&del_item="+id,
                    success: function(msg){
                        $('#fotos').empty();
                        $("#fotos").append(msg);
                    }

                });
            }
        </script>
        <div id="div_foto">
            <form id="upload_flash" enctype="multipart/form-data" method="POST">
                <input type="hidden" value="<?=$id_noticia?>" name="id_noticia" id="id_noticia" />
                <div>
                    <table>
                        <tr>
                            <td class="tit_campo">Foto:</td>
                        </tr>
                        <tr>
                            <td><input type="file" id="foto" name="foto" class="inpute gde"  value="Procurar"/></td>
                        </tr>
                        <tr>
                            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_fotos.php','fotos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Enviar</button></td>

                        </tr>
                    </table>
                </div>
            </form>
            <div id="fotos">
                <?php
                $fotos = $con_cliente->executa("SELECT * FROM noticias_fotos WHERE id_noticia = $id_noticia");
                if($fotos && mysqli_num_rows($fotos)>0){
                    while($foto = mysqli_fetch_assoc($fotos)){
                        ?>
                <div class="miniatura">
                    <p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/noticias/galeria/thumbs/<?=$foto['foto']?>" /></p>
                    <p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_noticias_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_noticias_foto']?>);" style="cursor:pointer">Editar</a></p>
                </div>
                <?php
            }
        }else{
            echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
        }
        ?>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
</div>