<?php
require_once('eventos.php');
if($id){
    $pesquisa = new eventos();
    $pesquisa->busca($id);
    $id_evento = $pesquisa->id_evento;
    $titulo = $pesquisa->titulo;
    $local = $pesquisa->local;
    $descricao = $pesquisa->descricao;
    $data = ajustadata($pesquisa->data,'site');
    ?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
    function deleta_recado(id){
        zera_sessao();
        $.ajax({
            type: "POST",
            url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/recados.action.php?noob="+ new Date().getTime(),
            data: "id_evento=<?=$id_evento?>&del_item="+id,
            success: function(msg){
                $('#recados').empty();
                $("#recados").append(msg);
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
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
    });
    $(function(){
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#tab-eventos">Evento</a></li>
        <li><a href="#tab-recados">Recados</a></li>
    </ul>
    <div id="tab-eventos">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
            <input type="hidden" value="<?=$id_evento?>" name="id_evento" id="id_evento" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Título da Evento:</td>
                </tr>
                <tr>
                    <td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="Título da evento" value="<?=$titulo?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Local:</td>
                </tr>
                <tr>
                    <td><input type="text" name="local" id="local" maxlength="255" class="inpute gde obrigatorio" title="Local" value="<?=$local?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Descrição:</td>
                </tr>
                <tr>
                    <td><textarea class="inpute" name="descricao" id="descricao" rows="15"><?=$descricao?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data:</td>
                </tr>
                <tr>
                    <td><input type="text" name="data" id="data" maxlength="255" class="inpute medio obrigatorio" title="Data" value="<?=$data?>" /></td>
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
    <div id="tab-recados">
        <?php
        if(!$id){
            echo '<p class="vazio">Salve a evento antes!</p>';
        }else{
            ?>
        <div id="recados">
            <?php
            $recados = $con_cliente->executa("SELECT * FROM eventos_recados WHERE id_evento = $id_evento ORDER BY id_eventos_recado DESC");
            if($recados && mysqli_num_rows($recados)>0){
                while($recado = mysqli_fetch_assoc($recados)){
                    ?>
            <div>
                <p><?=ajustadata($recado['data'],'site')?> - <?=$recado['nome']?></p>
                <p><?=$recado['recado']?></p>
                <p style="text-align:center"><a onclick="deleta_recado(<?=$recado['id_eventos_recado']?>);" style="cursor:pointer">Excluir</a></p>
            </div>
            <?php
        }
    }else{
        echo("<p class='vazio'>Não tem recados cadastrados!</p>");
    }
    ?>
        </div>
        <?php
    }
    ?>
    </div>
</div>