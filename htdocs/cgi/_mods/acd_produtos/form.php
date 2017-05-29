<?php
require_once('produtos.php');
if($id){
	$pesquisa = new produtos();
	$pesquisa->busca($id);
	$id_produto = $pesquisa->id_produto;
	$id_produtos_categoria = $pesquisa->id_produtos_categoria;
	$nome_pt = $pesquisa->nome_pt;
	$referencia = $pesquisa->referencia;
	$codigo = $pesquisa->codigo;
	$composicao_pt = $pesquisa->composicao_pt;
	$lancamento = $pesquisa->lancamento;
	$imagem = $pesquisa->imagem;
	$cores = $pesquisa->cores;
	$nome_es = $pesquisa->nome_es;
	$composicao_es = $pesquisa->composicao_es;
	$ordem = $pesquisa->ordem;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post"
	enctype="multipart/form-data" id="form_edicao"
	onsubmit="return ween_validator()"><input type="hidden"
	value="<?=$id_produto?>" name="id_produto" id="id_produto" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Ordem:</td>
	</tr>
	<tr>
		<td><input type="text" id="ordem" " name="ordem" title="Ordem"
			class="inpute pqno obrigatorio" value="<?=$ordem?>" /></td>
	</tr>
	<tr>
		<td class="tit_campo">Categoria:</td>
	</tr>
	<tr>
		<td><select class="inpute gde" name="id_produtos_categoria"
			id="id_produtos_categoria">
			<?php
			$query = 'SELECT * FROM produtos_categorias ORDER BY categoria_pt';
			$categorias = $con_cliente->query($query);
			if($categorias && $categorias->num_rows > 0){
				while($categoria = $categorias->fetch_assoc()){
					if($categoria['id_produtos_categoria'] == $id_produtos_categoria){
						echo '<option value="'.$categoria['id_produtos_categoria'].'" selected="selected">'.$categoria['categoria_pt'].'</option>';
					}else{
						echo '<option value="'.$categoria['id_produtos_categoria'].'">'.$categoria['categoria_pt'].'</option>';
					}
					?>
					<?php
				}
			}
			?>
		</select></td>
	</tr>
	<tr>
		<td class="tit_campo">Referência:</td>
	</tr>
	<tr>
		<td><input type="text" id="referencia" name="referencia"
			class="inpute gde obrigatorio" value="<?=$referencia?>" /></td>
	</tr>
	<tr>
		<td class="tit_campo">Código:</td>
	</tr>
	<tr>
		<td><input type="text" id="codigo" " name="codigo"
			class="inpute gde obrigatorio" value="<?=$codigo?>" /></td>
	</tr>
	<tr>
		<td class="tit_campo">Nome (Português):</td>
	</tr>
	<tr>
		<td><input type="text" id="nome_pt" name="nome_pt"
			class="inpute gde obrigatorio" value="<?=$nome_pt?>" /></td>
	</tr>
		<tr>
		<td class="tit_campo">Nome (Espanhol):</td>
	</tr>
	<tr>
		<td><input type="text" id="nome_es" name="nome_es"
			class="inpute gde obrigatorio" value="<?=$nome_es?>" /></td>
	</tr>
	<tr>
		<td class="tit_campo">Composição (Português):</td>
	</tr>
	<tr>
		<td><textarea id="composicao_pt" name="composicao_pt"
			class="inpute gde"><?=$composicao_pt?></textarea></td>
	</tr>
	<tr>
		<td class="tit_campo">Composição (Espanhol):</td>
	</tr>
	<tr>
		<td><textarea id="composicao_es" " name="composicao_es"
			class="inpute gde"><?=$composicao_es?></textarea></td>
	</tr>
	<tr>
		<td class="tit_campo">Imagem:</td>
	</tr>
	<tr>
		<td><?php
		if($imagem){
			?> <img
			src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/produtos/thumbs/<?=$imagem?>" /><br />
			<?php
		}
		?> <input type="file" name="imagem" id="imagem" class="inpute"></td>
	</tr>
	<tr>
		<td class="tit_campo">Cores:</td>
	</tr>
	<tr>
		<td><?php
		if($cores){
			?> <img
			src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/produtos/cores/<?=$cores?>" /><br />
			<?php
		}
		?> <input type="file" name="cores" id="cores" class="inpute"></td>
	</tr>
	<tr>
		<td><label><input type="checkbox" id="lancamento" " name="lancamento"
			value="1" <?php if($lancamento == 1){ ?> checked <?php }?> />
		Lançamento</label></td>
	</tr>
</table>
<table id="table_botoes_rodape">
	<tr>
		<td><input type="submit" value="Salvar" id="bt_salvar" /></td>
		<td><input type="button" value="Cancelar"
			onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'"
			id="bt_cancelar" /></td>
	</tr>
</table>
</form>
