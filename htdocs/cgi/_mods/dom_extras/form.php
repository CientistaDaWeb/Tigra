<?php
require_once("extras.php");
    $id = 1;
    $pesquisa = new extras();
    $pesquisa->busca($id);
    $id_extra = 1;
    $frete = $pesquisa->frete;
    $vinhos_personalizados = $pesquisa->vinhos_personalizados;
    $embalagens_promocionais = $pesquisa->embalagens_promocionais;
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_produtos_categoria?>" name="id_produtos_categoria" id="id_produtos_categoria" />
    <table width="100%">
        <tr>
            <td class="subtitulos tit_campo">Frete</td>
        </tr>
        <tr>
            <td><textarea name="frete" class="inpute" id="frete" title="Frete" rows="5"><?=$frete?></textarea></td>
        </tr>
        <tr>
            <td  class="subtitulos tit_campo">Vinhos Personalizados</td>
        </tr>
        <tr>
            <td><textarea name="vinhos_personalizados" class="inpute" id="descricao" title="Vinhos Personalizados" rows="5"><?=$vinhos_personalizados?></textarea></td>
        </tr>
        <tr>
            <td  class="subtitulos tit_campo">Embalagens Promocionais</td>
        </tr>
        <tr>
            <td><textarea name="embalagens_promocionais" class="inpute" id="embalagens_promocionais" title="Embalagens Promocionais" rows="5"><?=$embalagens_promocionais?></textarea></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>