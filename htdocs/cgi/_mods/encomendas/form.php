<?php
require_once("$tg_mod.php");
if($id)	{
    $pesquisa = new encomendas();
    $pesquisa->busca($id);
    $id_encomenda = $pesquisa->id_encomenda;
    $cnpj = $pesquisa->cnpj;
    $nf = $pesquisa->nf;
    $observacoes = $pesquisa->observacoes;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cnpj").mask("99.999.999/9999-99");
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_encomenda?>" name="id_encomenda" id="id_encomenda" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Nota Fiscal:</td>
        </tr>
        <tr>
            <td><input type="text" name="nf" id="nf" maxlength="255" class="inpute gde obrigatorio" title="Nota Fiscal" value="<?=$nf?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">CNPJ:</td>
        </tr>
        <tr>
            <td><input type="text" name="cnpj" id="cnpj" maxlength="255" class="inpute gde obrigatorio" title="CNPJ" value="<?=$cnpj?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Observa&ccedil;&otilde;es:</td>
        </tr>
        <tr>
            <td><textarea class="inpute" title="Observa&ccedil;&otilde;es" name="observacoes" id="observacoes"><?=$observacoes?></textarea></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>
<?php
if($id){
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
    function deleta_evento(id){
        $.ajax({
            type: "POST",
            url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/eventos.php?noob="+ new Date().getTime(),
            data: "id_encomenda=<?=$id_encomenda?>&id_evento="+id+"&acao=remover",
            success: function(msg){
                $('#eventos').empty();
                $("#eventos").append(msg);
            }

        });
    }
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
    });
</script>
<div class="subtitulos">Eventos</div>
<form id="upload_tag" enctype="multipart/form-data" method="POST">
    <input type="hidden" value="<?=$id_encomenda?>" name="id_encomenda" id="id_encomenda" />
    <input type="hidden" value="adicionar" name="acao" id="acao">
    <table>
        <tr>
            <td class="tit_campo">Data:</td>
        </tr>
        <tr>
        <td colspan="2"><input type="text" class="inpute pqno" maxlength="10" name="data" id="data" /></td>
        <tr>
            <td class="tit_campo">Evento:</td>
        </tr>
        <tr>
            <td><input type="text" class="inpute gde" maxlength="255" name="evento" id="evento" /></td>
        </tr>
        <tr>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/eventos.php','eventos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Adicionar</button></td>
        </tr>
    </table>
</form>
<div id="eventos">
    <?php
    $eventos = $con_cliente->executa("SELECT * FROM eventos WHERE id_encomenda = $id_encomenda ORDER BY data DESC");
    if($eventos && mysqli_num_rows($eventos)>0){
        while($evento = mysqli_fetch_assoc($eventos)){
            ?>
    <div class="duascolunas">
        <p><?=ajustadata($evento['data'],'site')?></p>
        <p><?=$evento['evento']?></p>
        <p><a onclick="deleta_evento(<?=$evento['id_evento']?>);" style="cursor:pointer">Excluir</a></p>
    </div>
    <?php
        }
    }else{
?>
    <p class="vazio">Não existem eventos cadatrados!</p>
    <?php
    }
    ?>
    </div>
<?php
}
?>
