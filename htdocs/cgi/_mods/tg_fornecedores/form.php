<?php
require_once('tg_fornecedores.php');
$avaliacao = 1;
if($id) {
    $pesquisa = new tg_fornecedores();
    $pesquisa->busca($id);
    $id_tg_fornecedore = $pesquisa->id_tg_fornecedore;
    $fornecedor = $pesquisa->fornecedor;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script>
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
        $("#telefone").mask("(99) 9999-9999");
        $("#cep").mask("99999-999");
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_tg_fornecedore?>" name="id_tg_fornecedore" id="id_tg_fornecedore" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Fornecedor:</td>
        </tr>
        <tr>
            <td><input type="text" name="fornecedor" id="fornecedor" maxlength="255" class="inpute gde obrigatorio" title="fornecedor" value="<?=$fornecedor?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>