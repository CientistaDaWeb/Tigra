<h2>Gerar boletos em remessa</h2>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" name="remessa" id="remessa" value="true" />
    <table id="formulario">
        <tr>
            <td class="tit_campo"><label>fornecedore</label></td>
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
            <td class="tit_campo"><label for="diaPagamento">Dia do Pagamento</label></td>
        </tr>
        <tr>
            <td><input type="text" id="diaPagamento" name="diaPagamento"></td>
        </tr>
        <tr>
            <td class="tit_campo"><label for="diasPagamento">Dias para o primeiro pagamento</label></td>
        </tr>
        <tr>
            <td><input type="text" id="diasPagamento" name="diasPagamento"></td>
        </tr>
        <tr>
            <td class="tit_campo"><label for="valor">Valor</label></td>
        </tr>
        <tr>
            <td><input type="text" id="valor" name="valor"></td>
        </tr>
        <tr>
            <td class="tit_campo"><label for="dia">Parcelas</label></td>
        </tr>
        <tr>
            <td><input type="text" id="parcelas" name="parcelas"></td>
        </tr>
        <tr>
            <td class="tit_campo">Descritivo:</td>
        </tr>
        <tr>
            <td><input type="text" name="descritivo" id="descritivo" /></td>
        </tr>
        <tr>
            <td><a id="gerarParcelas">Gerar Parcelas</a>
        <tr>
            <td><div id="tableParcelas"></div></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#valor").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
        $("#gerarParcelas").click(function(){
            var diasPagamento = $('#diasPagamento').val();
            var diaPagamento = $('#diaPagamento').val();
            var valor = $('#valor').val();
            var parcelas = $('#parcelas').val();
            $.post('<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/parcelas.php','valor='+valor+'&parcelas='+parcelas+'&diasPagamento='+diasPagamento+'&diaPagamento='+diaPagamento, function(data){
                $('#tableParcelas').html(data);
            });
        });
    });
</script>