<?php 
require_once ('embalagens.php');
if ($id) {
    $pesquisa = new embalagens();
    $pesquisa->busca($id);
    $id_embalagen = $pesquisa->id_embalagen;
    $embalagem_pt = $pesquisa->embalagem_pt;
    $embalagem_en = $pesquisa->embalagem_en;
    $embalagem_es = $pesquisa->embalagem_es;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_embalagen?>" name="id_embalagen" id="id_embalagen" />
    <table id="formulario">
        <tr>
            <td class="subtitulos tit_campo">
                Nome da Embalagem
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                <em>Português</em>
            </td>
        </tr>
        <tr>
            <td>
                <input id="embalagem_pt" name="embalagem_pt" class="inpute gde obrigatorio" title="Embalagem em Português" value="<?=$embalagem_pt?>" />
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                <em>Inglês</em>
            </td>
        </tr>
        <tr>
            <td>
                <input id="embalagem_en" name="embalagem_en" class="inpute gde obrigatorio" title="Embalagem em Inglês" value="<?=$embalagem_en?>" />
            </td>
        </tr>
		 <tr>
            <td class="tit_campo">
                <em>Espanhol</em>
            </td>
        </tr>
        <tr>
            <td>
                <input id="embalagem_es" name="embalagem_es" class="inpute gde obrigatorio" title="Embalagem em Espanhol" value="<?=$embalagem_es?>" />
            </td>
        </tr>
		</table>
    <table id="table_botoes_rodape">
        <tr>
            <td>
                <input type="submit" value="Salvar" id="bt_salvar"/>
            </td>
            <td>
                <input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" />
            </td>
        </tr>
    </table>
</form>