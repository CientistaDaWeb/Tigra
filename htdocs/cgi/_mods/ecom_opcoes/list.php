<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 25,
		"aaSorting": [[2,'asc']],
		"aoColumns":[
					 {"bSortable": false},
					 {"bSortable": false},
					 {"bSortable": true},
                     {"bSortable": true},
                     {"bSortable": true},
                     {"bSortable": true}
					 ]
	});
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
<table id="table_botoes">
    <tr>
        <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Adicionar" id="bt_novo" /></td>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<?php
$busca = $con_cliente->executa('SELECT op.id_opcoes_caracteristica, op.opcao, op.opc, cc.caracteristica, cp.categoria FROM caracteristicas_categorias AS cc, categorias_produtos AS cp, opcoes_caracteristicas AS op WHERE cc.id_categorias_produto = cp.id_categorias_produto AND op.id_caracteristicas_categoria = cc.id_caracteristicas_categoria');
if($busca && mysqli_num_rows($busca)>0){
?>
<table width="100%">
    <tr>
        <td class="campo_checkbox" id="selectall"><label for="select_all" id="label_select_all">Selecionar / Deselecionar</label><input type="checkbox" class="crirHiddenJS" name="select_all" id="select_all" onchange="check_all()" /></td>
    </tr>
</table>
<table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
    <thead>    	
        <tr>
        	<th></th>
            <th></th>
            <th>Opção</th>
            <th>Característica</th>
            <th>Categoria</th>
            <th>link</th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){			
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_opcoes_caracteristica']?>" id="label<?=$item['id_caracteristicas_categoria']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_opcoes_caracteristica']?>" value="<?=$item['id_opcoes_caracteristica']?>" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_opcoes_caracteristica']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><?=$item['opcao']?></td>
            <td><?=$item['caracteristica']?></td>
            <td><?=$item['categoria']?></td>
            <td><?=$item['opc']?></td>
		</tr>
<?php
	}
?>
    </tbody>
</table>
<?php
}else{
	?>
		<div><span class="vazio">N&atilde;o foi encontrada nenhuma Opção de Caracteristica.</span></div>
<?php
}
?>
</form>
