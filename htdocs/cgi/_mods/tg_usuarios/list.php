<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 25,
		"aaSorting": [[ 2, "asc" ]],
		"aoColumns":[
					 {"bSortable": false},
					 {"bSortable": false},
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
        <td><input class="btn_adicionar" type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="" id="bt_novo" /></td>
        <td><input class="btn_remover" type="submit" value="" id="bt_excluir" /></td>
    </tr>
</table>
<?php
$busca = $con_tigra->executa("SELECT * FROM $tg_mod ORDER BY nome");
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
            <th>Nome</th>
            <th>Usu&aacute;rio</th>
            <th>Cliente</th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){	
		$cliente = $con_tigra->executa("SELECT * FROM tg_clientes WHERE id_tg_cliente = $item[fk_tg_cliente]");
		$cliente = mysqli_fetch_assoc($cliente);
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_tg_usuario']?>" id="label<?=$item['id_tg_usuario']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_tg_usuario']?>" value="<?=$item['id_tg_usuario']?>" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_tg_usuario']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><?=$item['nome']?></td>
            <td><?=$item['usuario']?></td>
            <td><?=$cliente['nome']?></td>
		</tr>
<?php
	}
?>
    </tbody>
</table>
<?php
}else{
	?>
		<div><span class="vazio">N&atilde;o foi encontrado nenhum registro.</span></div>
<?php
}
?>
</form>