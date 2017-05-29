<?php

require_once('produtos.php');
if($id){
	$pesquisa = new produtos();
	$pesquisa->busca($id);
	$id_produto = $pesquisa->id_produto;
    $id_produtos_categoria = $pesquisa->id_produtos_categoria;
	$nome_pt = $pesquisa->nome_pt;
    $caracteristicas_pt = $pesquisa->caracteristicas_pt;
    $detalhes_pt = $pesquisa->detalhes_pt;
    $nome_en = $pesquisa->nome_en;
    $caracteristicas_en = $pesquisa->caracteristicas_en;
    $detalhes_en = $pesquisa->detalhes_en;
    $nome_es = $pesquisa->nome_es;
    $caracteristicas_es = $pesquisa->caracteristicas_es;
    $detalhes_es = $pesquisa->detalhes_es;
	$imagem = $pesquisa->imagem;
    $codigo_vinhovirtual = $pesquisa->codigo_vinhovirtual;
    $ano = $pesquisa->ano;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
    $(".preco").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:true});
});
</script>
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
                <option value="<?=$categoria['id_produtos_categoria']?>" <?php if($categoria['id_produtos_categoria'] == $id_produtos_categoria){?>selected="selected"<?php }?>><?=$categoria['categoria_pt']?></option>
            <?php
                }
            }
            ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Código Vinho Virtual:</td>
    </tr>
    <tr>
		<td><input id="codigo_vinhovirtual" name="codigo_vinhovirtual" class="inpute gde" title="Código Vinho Virtual" value="<?=$codigo_vinhovirtual?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Ano da Safra:</td>
    </tr>
    <tr>
		<td><input id="ano" name="ano" class="inpute pqno" title="Ano da Safra" value="<?=$ano?>" /></td>
    </tr>
    <tr>
        <td class="tit_campo">Imagem</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/produtos/thumbs/<?=$imagem?>" /><br />
        <? } ?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td class="subtitulos tit_campo">Nome do Produto</td>
    </tr>
    <tr>
		<td class="tit_campo"><em>Português</em></td>
    </tr>
    <tr>
		<td><input id="nome_pt" name="nome_pt" class="inpute gde obrigatorio" title="Produto em Português" value="<?=$nome_pt?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo"><em>Inglês</em></td>
    </tr>
    <tr>
		<td><input id="nome_en" name="nome_en" class="inpute gde obrigatorio" title="Produto em Inglês" value="<?=$nome_en?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo"><em>Espanhol</em></td>
    </tr>
    <tr>
		<td><input id="nome_es" name="nome_es" class="inpute gde obrigatorio" title="Produto em Espanhol" value="<?=$nome_es?>" /></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td class="subtitulos tit_campo">Características do Produto</td>
    </tr>
    <tr>
		<td class="tit_campo">em <em>Português</em></td>
    </tr>
    <tr>
		<td><textarea name="caracteristicas_pt" class="inpute" id="caracteristicas_pt" title="Caracteristicas em Português" rows="5"><?=$caracteristicas_pt?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">em <em>Inglês</em></td>
    </tr>
    <tr>
		<td><textarea name="caracteristicas_en" class="inpute" id="caracteristicas_en" title="Caracteristicas em Inglês" rows="5"><?=$caracteristicas_en?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">em <em>Espanhol</em></td>
    </tr>
    <tr>
		<td><textarea name="caracteristicas_es" class="inpute" id="caracteristicas_es" title="Caracteristicas em Espanhol" rows="5"><?=$caracteristicas_es?></textarea></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td class="subtitulos tit_campo">Detalhes do Produto</td>
    </tr>
    <tr>
		<td class="tit_campo">em <em>Português</em></td>
    </tr>
    <tr>
		<td><textarea name="detalhes_pt" class="inpute" id="detalhes_pt" title="Detalhes em Português" rows="5"><?=$detalhes_pt?></textarea></td>
    </tr>
     <tr>
		<td class="tit_campo">em <em>Inglês</em></td>
    </tr>
    <tr>
		<td><textarea name="detalhes_en" class="inpute" id="detalhes_en" title="Detalhes em Inglês" rows="5"><?=$detalhes_en?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">em <em>Espanhol</em></td>
    </tr>
    <tr>
		<td><textarea name="detalhes_es" class="inpute" id="detalhes_es" title="Detalhes em Espanhol" rows="5"><?=$detalhes_es?></textarea></td>
    </tr>
</table>
<?php
if($id){?>
<div class="subtitulos">Embalagens:</div>
<?php
	//$con = new database2();
	$query = 'SELECT * FROM produtos_embalagens WHERE id_produto = '.$id;
	$embalagens = $con_cliente->query($query);
	if($embalagens && $embalagens->num_rows > 0){
		while($embalagem = $embalagens->fetch_assoc()){
			$emb[$embalagem['id_embalagen']] = $embalagem['preco'];
		}
	}
	
	$query = 'SELECT * FROM embalagens';
	$embalagens = $con_cliente->query($query);
	if($embalagens && $embalagens->num_rows > 0){
		while($embalagem = $embalagens->fetch_assoc()){
			?>
			<div class="embalagem">
				<div class="duascolunas">
					<input type="checkbox" name="emb[]" id="emb[]" value="<?=$embalagem['id_embalagen']?>" <?php if($emb[$embalagem['id_embalagen']]){echo 'checked';}?> />
					<?=$embalagem['embalagem_pt']?>
				</div>
				<div class="duascolunas">
					Preço: <input type="text" name="preco[<?=$embalagem['id_embalagen']?>]" id="preco[<?=$embalagem['id_embalagen']?>]" value="<?=$emb[$embalagem['id_embalagen']]?>" class="inpute pqno preco" />
				</div>
			</div>
			<?php
		}
	}else{
		echo '<p class="erro" id="alerta">Cadastre alguma embalagem antes!</p>';
	}
}
?>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>