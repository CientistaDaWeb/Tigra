
<script type="text/javascript">
$(document).ready(function() {
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 2, "asc" ]],
		"iDisplayLength": 25,
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
        <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Adicionar" id="bt_novo" /></td>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<?php
$busca = $con_cliente->executa("SELECT * FROM $tg_mod");
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
            <th>Empresa</th>
            <th>Telefone</th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){
	?>
		<tr>
			<td class="campo_checkbox"><label for="checkbox<?=$item['id_agenda_telefone']?>" id="label<?=$item['id_agenda_telefone']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_agenda_telefone']?>" value="<?=$item['id_agenda_telefone']?>" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_agenda_telefone']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><?=$item['nome']?></td>
            <td><?=$item['empresa']?></td>
            <td><?=$item['tel_com']?></td>
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
