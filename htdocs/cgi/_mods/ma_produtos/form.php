<?php
require_once('produtos.php');
if($id){
	$pesquisa = new produtos();
	$pesquisa->busca($id);
	$id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
	$nome = $pesquisa->nome;
	$imagem = $pesquisa->imagem;
    $descricao = $pesquisa->descricao;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Categoria:</td>
    </tr>
    <tr>
        <td><select class="inpute" name="id_produtos_categoria" id="id_produtos_categoria">
            <?php
            $query = 'SELECT * FROM produtos_categorias';
            $categorias = $con_cliente->query($query);
            if($categorias && $categorias->num_rows > 0){
                while($categoria = $categorias->fetch_assoc()){
            ?>
                <option value="<?=$categoria['id_produtos_categoria']?>" <?php if($categoria['id_produtos_categoria'] == $id_produtos_categoria){?>selected="selected"<?php }?>><?=$categoria['categoria']?></option>
            <?php
                }
            }
            ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Produto:</td>
    </tr>
    <tr>
		<td><input id="nome" name="nome" class="inpute gde obrigatorio"  value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/produtos/thumbs/<?=$imagem?>" /><br />
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