<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 25,
		"aaSorting": [[ 2, "desc" ]],
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
$busca = $con_cliente->executa('SELECT * FROM encomendas');
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
			<th>Data</th>
            <th>NF</th>
            <th>CNPJ</th>
			<th>Evento</th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){
		$alteracao = $con_cliente->executa("SELECT * FROM eventos WHERE id_encomenda = $item[id_encomenda] ORDER BY data DESC LIMIT 0,1");
		if($alteracao && mysqli_num_rows($alteracao)>0){
			$alteracao = mysqli_fetch_assoc($alteracao);
			$data = $alteracao['data'];
			$evento = $alteracao['evento'];
		}
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_encomenda']?>" id="label<?=$item['id_encomenda']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_encomenda']?>" value="<?=$item['id_encomenda']?>" /></td>
            <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_encomenda']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
			<td><span style="display:none"><?=$data?></span><?=ajustadata($data,"site")?></td>
            <td><?=str_replace("/"," ",$item['nf'])?></td>
            <td><?=$item['cnpj']?></td>
			<td><?=$evento?></td>
		</tr>
<?php
	}
?>
    </tbody>
</table>
<?php
}else{
	?>
		<div><span class="vazio">N&atilde;o foi encontrada nenhuma encomenda.</span></div>
<?php
}
?>
</form>
