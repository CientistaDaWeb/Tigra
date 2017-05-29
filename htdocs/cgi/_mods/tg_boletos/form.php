<?php
require_once('tg_boletos.php');
$data = date('d/m/Y');
if($id) {
    $pesquisa = new tg_boletos();
    $pesquisa->busca($id);
    $id_tg_boleto = $pesquisa->id_tg_boleto;
    $id_tg_cliente = $pesquisa->id_tg_cliente;
    $data = ajustadata($pesquisa->data,'site');
    //$valor = number_format($pesquisa->valor,2,'.',',');
    $valor = $pesquisa->valor;
    $status = $pesquisa->status;
    $data_vencimento = ajustadata($pesquisa->data_vencimento,'site');
    $descritivo = $pesquisa->descritivo;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
        $("#data_vencimento").mask("99/99/9999");
        $("#valor").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_tg_boleto?>" name="id_tg_boleto" id="id_tg_boleto" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Cliente:</td>
        </tr>
        <tr>
            <td><select name="id_tg_cliente" id="id_tg_cliente" class="inpute medio">
                    <?php
                    $clientes = $con_tigra->executa('SELECT * FROM tg_clientes ORDER BY nome');
                    while($cliente = mysqli_fetch_assoc($clientes)) {
                        ?>
                    <option value="<?=$cliente['id_tg_cliente']?>" <?php if($id_tg_cliente == $cliente['id_tg_cliente']) { ?> selected="selected" <?php } ?>><?=$cliente['nome']?></option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Data:</td>
        </tr>
        <tr>
            <td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Valor:</td>
        </tr>
        <tr>
            <td>R$ <input type="text" name="valor" id="valor" maxlength="8" class="inpute pqno" title="Valor" value="<?=$valor?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Data Vencimento:</td>
        </tr>
        <tr>
            <td><input type="text" name="data_vencimento" id="data_vencimento" maxlength="10" class="inpute pqno obrigatorio" title="Data de Vencimento" value="<?=$data_vencimento?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Descritivo:</td>
        </tr>
        <tr>
            <td><input type="text" name="descritivo" id="descritivo" maxlength="255" class="inpute gde obrigatorio" title="Descritivo" value="<?=$descritivo?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>