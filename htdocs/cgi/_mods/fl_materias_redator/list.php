<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 10,
		"aaSorting": [[2,'desc']],
		"aoColumns":[
					 {"bSortable": false},
					 {"bSortable": false},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bVisible": false, "sType":'html'},
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
$busca = $con_cliente->executa("SELECT * 
								FROM materias, materias_categorias, materias_subcategorias, redatores
								WHERE materias.id_materias_categoria = materias_categorias.id_materias_categoria
								AND materias.id_redatore = redatores.id_redatore
								AND materias.id_materias_categoria = materias_categorias.id_materias_categoria
								AND materias.id_materias_subcategoria = materias_subcategorias.id_materias_subcategoria
								AND materias_subcategorias.id_materias_categoria = materias_categorias.id_materias_categoria
								GROUP BY materias.id_materia");
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
            <th></th>
            <th>Titulo</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th style="display:none">Resumo</th>
            <th>Redator</th>            
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){
		switch($item['status']){
			case '1':
				$situacao = 'reprovado';
			break;
			case '2':
				$situacao = 'aprovado';
			break;
			case '3':
				$situacao = 'aguardando';
			break;
		}
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_materia']?>" id="label<?=$item['id_materia']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_materia']?>" value="<?=$item['id_materia']?>" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_materia']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><span style="display:none"><?=$item['data']?></span><?=ajustadata($item['data'],'timestamp')?></td>
            <td><span class="situacao <?=$situacao?>"></span></td>
            <td><?=$item['titulo']?></td>
            <td><?=$item['categoria']?></td>
            <td><?=$item['subcategoria']?></td>
            <td style="display:none"><?=$item['texto']?></td>
            <td><?=$item['nome']?></td>            
		</tr>
<?php
	}
?>
    </tbody>
</table>
<?php
}else{
	?>
		<div><span class="vazio">N&atilde;o foi encontrada nenhuma not&iacute;cia.</span></div>
<?php
}
?>
</form>
