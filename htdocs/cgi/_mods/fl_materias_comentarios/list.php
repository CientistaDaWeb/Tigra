<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 25,
		"aaSorting": [[2,'desc'],[3,'desc']],
		"aoColumns":[
					 {"bSortable": false},
					 {"bSortable": false},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bVisible": false, "sType":'html'}
					 ]
	});
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();">
<table id="table_botoes">
    <tr>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<?php
$busca = $con_cliente->executa("SELECT *, materias_comentarios.status as aprovacao FROM materias_comentarios, materias WHERE materias.id_materia = materias_comentarios.id_materia");
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
            <th></th>
            <th>Data</th>
            <th>Nome</th>
            <th>Mat&eacute;ria</th>
            <th style="display:none;">Resumo</th>            
         </tr>
     </thead>     
     <tbody>
<?php
	$situacao = array(1=>'reprovado', 'aprovado', 'aguardando');
	while($item = mysqli_fetch_assoc($busca)){
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_materias_comentario']?>" id="label<?=$item['id_materias_comentario']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_materias_comentario']?>" value="<?=$item['id_materias_comentario']?>" /></td>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_materias_comentario']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><span class="situacao <?=$situacao[$item['aprovacao']]?>"></span></td>
            <td><span style="display:none"><?=$item['data']?></span><?=ajustadata($item['data'],'timestamp')?></td>
            <td><?=$item['nome']?></td>
            <td><?=$item['titulo']?></td>
            <td style="display:none;"><?=$item['comentario']?></td>
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
