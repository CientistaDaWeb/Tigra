<?php
require_once("produtos_categorias.php");
if($id)	{
	$pesquisa = new produtos_categorias();
	$pesquisa->busca($id);
	$id_produtos_categoria = $pesquisa->id_produtos_categoria;
    $tipo = $pesquisa->tipo;
	$categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_produtos_categoria?>" name="id_produtos_categoria" id="id_produtos_categoria" />
<table id="formulario">
    <tr>
        <td class="tit_campo">Tipo:</td>
    </tr>
    <tr>
        <td class="tit_campo">
        <select class="inpute" name="tipo">
        <?
            if($tipo && $tipo == 'maquinas'){
                echo '
                    <option value="maquinas" selected="selected">Máquinas</option>
                    <option value="produtos">Produtos</option>';
            }else if($tipo && $tipo == 'produtos'){
                echo '
                    <option value="maquinas">Máquinas</option>
                    <option value="produtos" selected="selected">Produtos</option>';
            }else{
                echo '
                    <option value="maquinas">Máquinas</option>
                    <option value="produtos">Produtos</option>';
            }
        ?>
        </select>
        </td>
    </tr>
	<tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
		<td><input type="text" name="categoria" id="categoria" maxlength="255" class="inpute gde obrigatorio" title="Categoria" value="<?=$categoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>