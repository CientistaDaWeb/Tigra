<?php
require_once('produtos.php');
if($id)	{
	$pesquisa = new produtos();
	$pesquisa->busca($id);
	$id_produto = $pesquisa->id_produto;
    $id_marca = $pesquisa->id_marca;
    $id_categorias_produto = $pesquisa->id_categorias_produto;
    $codigo = $pesquisa->codigo;
	$produto = $pesquisa->produto;
    $preco = $pesquisa->preco;
    $peca = $pesquisa->peca;
    $destaque = $pesquisa->destaque;
	$imagem = $pesquisa->imagem;
	$descricao = $pesquisa->descricao;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
    $("#preco").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Marca</td>
    </tr>
    <tr>
		<td><select name="id_marca" class="inpute medio">
        	<?php
			$marcas = $con_cliente->executa("SELECT * FROM marcas ORDER BY marca");
			if($marcas && mysqli_num_rows($marcas)>0){
				while($marca = mysqli_fetch_assoc($marcas)){
					if($marca['id_marca'] == $id_marca){
						$marca_sel[$categoria['id_marca']] = 'selected ="selected"';
					}
				?>
                <option value="<?=$marca['id_marca']?>" <?=$marca_sel[$marca['id_marca']]?>><?=$marca['marca']?></option>
                <?php
				}
			}
			?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Categoria</td>
    </tr>
    <tr>
		<td><select name="id_categorias_produto" class="inpute">
        	<?php
			$categorias = $con_cliente->executa("SELECT * FROM categorias_produtos ORDER BY categoria");
			if($categorias && mysqli_num_rows($categorias)>0){
				while($categoria = mysqli_fetch_assoc($categorias)){
					if($categoria['id_categorias_produto'] == $id_categorias_produto){
						$categoria_sel[$categoria['id_categorias_produto']] = 'selected ="selected"';
					}
				?>
                <option value="<?=$categoria['id_categorias_produto']?>" <?=$categoria_sel[$categoria['id_categorias_produto']]?>><?=$categoria['categoria']?></option>
                <?php
				}
			}
			?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Nome do Produto</td>
    </tr>
    <tr>
		<td><input type="text" name="produto" id="produto" maxlength="255" class="inpute gde obrigatorio" title="Nome do produto" value="<?=$produto?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Código do Produto</td>
    </tr>
    <tr>
		<td><input type="text" name="codigo" id="codigo" maxlength="255" class="inpute gde obrigatorio" title="Código do produto" value="<?=$codigo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Preço do Produto</td>
    </tr>
    <tr>
		<td>R$ <input type="text" name="preco" id="preco" maxlength="5" class="inpute medio" title="Preço do Produto" value="<?=$preco?>" /></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Peça:</td>
    </tr>
    <?php
	$radio_peca = array(1=>'','',);
	$radio_peca[$peca] = 'checked="checked"';
	?>
    <tr>
    	<td class="campo_radio"><label for="radio2">Sim</label>
        <input type="radio" name="peca" id="radio2" value="2" <?=$radio_peca[2]?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio1">Não</label>
        <input type="radio" name="peca" id="radio1" value="1" <?=$radio_peca[1]?> /></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Destaque:</td>
    </tr>
    <?php
	$radio_destaque = array(1=>'','',);
	$radio_destaque[$destaque] = 'checked="checked"';
	?>
    <tr>
    	<td class="campo_radio"><label for="radio22">Sim</label>
        <input type="radio" name="destaque" id="radio22" value="2" <?=$radio_destaque[2]?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio21">Não</label>
        <input type="radio" name="destaque" id="radio21" value="1" <?=$radio_destaque[1]?> /></td>
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
    <tr>
		<td class="tit_campo">Dados Técnicos:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
    </tr>
</table>
<?php
	if($id_categorias_produto){
		$caracteristicas = $con_cliente->executa('SELECT * FROM caracteristicas_categorias WHERE id_categorias_produto = '.$id_categorias_produto);
		if($caracteristicas && mysqli_num_rows($caracteristicas)>0){
            $query = 'SELECT id_caracteristicas_categoria FROM produtos_caracteristicas WHERE id_produto = '.$id_produto;
            $prod_caracs = $con_cliente->query($query);
            if($prod_caracs && $prod_caracs->num_rows > 0){
                while($prod_carac = $prod_caracs->fetch_assoc()){
                    $prod_carac_sel[$prod_carac['id_caracteristicas_categoria']] = 'checked="checked"';
                }
            }
            $query = 'SELECT id_opcoes_caracteristica FROM produtos_opcoes WHERE id_produto = '.$id_produto;
            $prod_opts = $con_cliente->query($query);
            if($prod_opts && $prod_opts->num_rows > 0){
                while($prod_opt = $prod_opts->fetch_assoc()){
                    $prod_opt_sel[$prod_opt['id_opcoes_caracteristica']] = 'checked="checked"';
                }
            }
			while($caracteristica = mysqli_fetch_assoc($caracteristicas)){
				?>
               <div class="subtitulos"><label for="caract_<?=$caracteristica['id_caracteristicas_categoria']?>"><?=$caracteristica['caracteristica']?></label>
                <input type="checkbox" name="caracteristicas[]" id="caract_<?=$caracteristica['id_caracteristicas_categoria']?>" value="<?=$caracteristica['id_caracteristicas_categoria']?>" <?=$prod_carac_sel[$caracteristica['id_caracteristicas_categoria']] ?> class="crirHiddenJS"/></div>
               <div>
               <?php
                $query = 'SELECT * from opcoes_caracteristicas WHERE id_caracteristicas_categoria = '.$caracteristica['id_caracteristicas_categoria'];
                $opcoes = $con_cliente->query($query);
                if($opcoes && $opcoes->num_rows > 0){
					while($opcao = mysqli_fetch_assoc($opcoes)){
                    ?>
                    <div class="quatrocolunas">
                        <label for="opcoes_<?=$opcao['id_opcoes_caracteristica']?>"><?=$opcao['opcao']?></label>
                        <input type="checkbox" name="opcoes[]" id="opcoes_<?=$opcao['id_opcoes_caracteristica']?>" value="<?=$opcao['id_opcoes_caracteristica']?>" <?=$prod_opt_sel[$opcao['id_opcoes_caracteristica']]?> class="crirHiddenJS"/>
                    </div>
                    <?
					}
				}?>
                </div>
                <?php
			}
		}else{
		echo("<div><span class='vazio'>Crie ao menos uma caracteristicas para essa categoria.</span></div>");
		}
	}
?>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>
<?php
if($id){
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script type="text/javascript">
function deleta_foto(id){
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_fotos.php?noob="+ new Date().getTime(),
		data: "id_produto=<?=$id_produto?>&del_item="+id,
		success: function(msg){
			$('#fotos').empty();
			$("#fotos").append(msg);
		}

	});
}
</script>
<div class="subtitulos" id="tit_foto">Galeria de Fotos</div>
<div id="div_foto">
    <form id="upload_flash" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?=$id_produto?>" name="id_produto" id="id_produto" />
        <div>
        <table>
        <tr>
            <td class="tit_campo">Foto:</td>
        </tr>
        <tr>
            <td><input type="file" id="foto" name="foto" class="inpute gde"  value="Procurar"/></td>
        </tr>
        <tr>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload_fotos.php','fotos','<div class=carregando></div>Enviando...','Erro ao Enviar'); return false;" type="button">Enviar</button></td>
        </tr>
        </table>
        </div>
        </form>
        <div id="fotos">
    <?php
        $fotos = $con_cliente->executa("SELECT * FROM produtos_fotos WHERE id_produto = $id_produto");
        if($fotos && mysqli_num_rows($fotos)>0){
            while($foto = mysqli_fetch_assoc($fotos)){
    ?>
            <div class="miniatura">
                <p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/galeria/thumbs/<?=$foto['foto']?>" /></p>
                <p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_produtos_foto']?>);" style="cursor:pointer">Excluir</a></p>
            </div>
    <?php
            }
        }else{
        echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
        }
    ?>
    </div>
</div>
<?php
}
?>