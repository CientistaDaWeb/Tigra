<?php
require_once('tg_creditos.php');
if($id) {
    $pesquisa = new tg_creditos();
    $pesquisa->busca($id);
    $id_tg_credito = $pesquisa->id_tg_credito;
    $id_tg_cliente = $pesquisa->id_tg_cliente;
    $data = ajustadata($pesquisa->data,'site');
    $valor = $pesquisa->valor;
    $data_pago = ajustadata($pesquisa->data_pago,'site');
    $valor_pago = $pesquisa->valor_pago;
    $status = $pesquisa->status;
    $descritivo = $pesquisa->descritivo;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data, #data_pago").mask("99/99/9999");
        $("#valor, #valor_pago").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_tg_credito?>" name="id_tg_credito" id="id_tg_credito" />
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
            <td class="tit_campo">Data de Vencimento:</td>
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
            <td class="tit_campo">Descritivo:</td>
        </tr>
        <tr>
            <td><input type="text" name="descritivo" id="descritivo" maxlength="255" class="inpute gde" title="Descritivo" value="<?=$descritivo?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Status do Pagamento:</td>
        </tr>
        <?php
        $radio_stat = array(1=>'unchecked','unchecked');
        $radio_stat[$status] = 'checked';
        ?>
        <tr>
            <td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Aguardando Pagamento</label>
                <input type="radio" name="status" id="radio1" value="1" class="crirHidden"/></td>
        </tr>
        <tr>
            <td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Pago</label>
                <input type="radio" name="status" id="radio2" value="2" class="crirHidden" /></td>
        </tr>
        <?php
        if($id){
        ?>
        <tr>
            <td class="tit_campo">Data de Pagamento:</td>
        </tr>
        <tr>
            <td><input type="text" name="data_pago" id="data_pago" maxlength="10" class="inpute pqno obrigatorio" title="Data de Pagamento" value="<?=$data_pago?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Valor Pago:</td>
        </tr>
        <tr>
            <td>R$ <input type="text" name="valor_pago" id="valor_pago" maxlength="8" class="inpute pqno" title="Valor Pago" value="<?=$valor_pago?>" /></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>