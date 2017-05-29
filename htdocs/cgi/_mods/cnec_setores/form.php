<?php
require_once("setores.php");
if($id) {
    $pesquisa = new setors();
    $pesquisa->busca($id);
    $id_setor = $pesquisa->id_setor;
    $setor = $pesquisa->setor;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_setor?>" name="id_setor" id="id_setor" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Setor:</td>
        </tr>
        <tr>
            <td><input type="text" name="setor" id="setor" maxlength="255" class="inpute gde obrigatorio" title="setor" value="<?=$setor?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>