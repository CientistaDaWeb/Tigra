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
                     {"bSortable": true}
					 ]
	});
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
<table id="table_botoes">
    <tr>
        <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<?php
$query = '
SELECT
  p.id_premio, p.concurso, p.vinho_premiado, pc.classificacao
FROM
  premios p
INNER JOIN
  premios_classificacoes pc
ON
  p.id_premios_classificacoe = pc.id_premios_classificacoe
ORDER BY
  pc.classificacao
';
$busca = $con_cliente->executa($query);
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
            <th>Classificação</th>
            <th>Concurso</th>
            <th>Vinho Premiado</th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){	
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_premio']?>" id="label<?=$item['id_premio']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_promio']?>" value="<?=$item['id_premio']?>" /></td>
            <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_premio']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><?=$item['classificacao']?></td>
            <td><?=$item['concurso']?></td>
            <td><?=$item['vinho_premiado']?></td>
		</tr>
<?php
	}
?>
    </tbody>
</table>
<?php
}else{
	?>
		<div><span class="vazio">N&atilde;o foi encontrado nenhum Produto.</span></div>
<?php
}
?>
</form>
