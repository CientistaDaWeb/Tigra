<?php
require_once('noticias_categorias.php');
if($id){
	$pesquisa = new noticias_categorias();
	$pesquisa->busca($id);
	$id_noticias_categoria = $pesquisa->id_noticias_categoria;
    $categoria = $pesquisa->categoria;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_noticias_categoria?>" name="id_noticias_categoria" id="id_noticias_categoria" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
        <td><input id="categoria" name="categoria" class="inpute gde obrigatorio" value="<?=$categoria?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>