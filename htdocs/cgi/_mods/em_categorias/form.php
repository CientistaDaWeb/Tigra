<?php
require_once('categorias_produtos.php');
if($id){
	$pesquisa = new categorias_produtos();
	$pesquisa->busca($id);
	$id_categorias_produto = $pesquisa->id_categorias_produto;
    $categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_categorias_produto?>" name="id_categorias_produto" id="id_categorias_produto" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
        <td><input id="categoria" name="categoria" class="inpute gde obrigatorio"  value="<?=$categoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>