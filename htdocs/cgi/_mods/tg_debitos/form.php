<?php
require_once('tg_debitos.php');
if($id) {
    $pesquisa = new tg_debitos();
    $pesquisa->busca($id);
    $id_tg_debito = $pesquisa->id_tg_debito;
    $id_tg_fornecedore = $pesquisa->id_tg_fornecedore;
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
    <input type="hidden" value="<?=$id_tg_debito?>" name="id_tg_debito" id="id_tg_debito" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Fornecedor:</td>
        </tr>
        <tr>
            <td><select name="id_tg_fornecedore" id="id_tg_fornecedore" class="inpute medio">
                    <?php
                    $fornecedores = $con_tigra->executa('SELECT * FROM tg_fornecedores ORDER BY fornecedor');
                    while($fornecedore = mysqli_fetch_assoc($fornecedores)) {
                        ?>
                    <option value="<?=$fornecedore['id_tg_fornecedore']?>" <?php if($id_tg_fornecedore == $fornecedore['id_tg_fornecedore']) { ?> selected="selected" <?php } ?>><?=$fornecedore['fornecedor']?></option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Valor:</td>
        </tr>
        <tr>
            <td>R$ <input type="text" name="valor" id="valor" maxlength="8" class="inpute pqno" title="Valor" value="<?=$valor?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Data de Vencimento:</td>
        </tr>
        <tr>
            <td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Descritivo:</td>
        </tr>
        <tr>
            <td><input type="text" name="descritivo" id="descritivo" maxlength="254" class="inpute gde" title="Descritivo" value="<?=$descritivo?>" /></td>
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