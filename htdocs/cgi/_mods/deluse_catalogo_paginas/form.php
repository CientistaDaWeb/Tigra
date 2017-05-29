<?php
require_once('catalogo_paginas.php');
require_once('_mods/deluse_catalogo_categorias/catalogo_categorias.php');
$pagina  = "";
if($id){
	$pesquisa = new catalogo_paginas();
	$pesquisa->busca($id);
	$id_catalogo_pagina = $pesquisa->id_catalogo_pagina;
    $id_catalogo_categoria = $pesquisa->id_catalogo_categoria;
	$pagina = $pesquisa->pagina;
	$imagem = $pesquisa->imagem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_catalogo_pagina?>" name="id_catalogo_pagina" id="id_catalogo_pagina" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
        <td><select class="inpute" name="id_catalogo_categoria" id="id_catalogo_categoria">
            <?php
            $categorias = catalogo_categorias::lista();
            foreach($categorias as $categoria){
            ?>
                <option value="<?=$categoria['id_catalogo_categoria']?>" <?php if($categoria['id_catalogo_categoria'] == $id_catalogo_categoria){?>selected="selected"<?php }?>><?=$categoria['categoria']?></option>
            <?php
            }
            ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Página:</td>
    </tr>
    <tr>
		<td><input id="pagina" name="pagina" class="inpute gde obrigatorio"  value="<?=$pagina?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/catalogo_virtual/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>