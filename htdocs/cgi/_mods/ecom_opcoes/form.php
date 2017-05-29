<?php
require_once("opcoes_caracteristicas.php");
if($id)	{
	$pesquisa = new opcoes_caracteristicas();
	$pesquisa->busca($id);
    $id_opcoes_caracteristica = $pesquisa->id_opcoes_caracteristica;
    $id_caracteristicas_categoria = $pesquisa->id_caracteristicas_categoria;
	$opcao = $pesquisa->opcao;
    $opc = $pesquisa->opc;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_opcoes_caracteristica?>" name="id_opcoes_caracteristica" id="id_opcoes_caracteristica" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Caracteristica</td>
    </tr>
    <tr>
		<td><select name="id_caracteristicas_categoria" class="inpute gde">
        	<?php
			$caracteristicas = $con_cliente->executa("SELECT cc.caracteristica, cp.categoria, cc.id_caracteristicas_categoria FROM caracteristicas_categorias AS cc, categorias_produtos AS cp WHERE cp.id_categorias_produto = cc.id_categorias_produto ORDER BY caracteristica");
			if($caracteristicas && mysqli_num_rows($caracteristicas)>0){
				while($caracteristica = mysqli_fetch_assoc($caracteristicas)){
					if($caracteristica['id_caracteristicas_categoria'] == $id_caracteristicas_categoria){
						$caracteristica_sel[$caracteristica['id_caracteristicas_categoria']] = 'selected ="selected"';
					}
				?>
                <option value="<?=$caracteristica['id_caracteristicas_categoria']?>" <?=$caracteristica_sel[$caracteristica['id_caracteristicas_categoria']]?>><?=$caracteristica['caracteristica']?> - <?=$caracteristica['categoria']?></option>
                <?php
				}
			}
			?>
        </select>
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Opção</td>
    </tr>
    <tr>
		<td><input type="text" name="opcao" id="opcao" maxlength="255" class="inpute gde obrigatorio" title="Opção" value="<?=$opcao?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>