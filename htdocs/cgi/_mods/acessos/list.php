<script type="text/javascript">
$(document).ready(function(){
	$('#logs').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 0, "desc" ]],
		"iDisplayLength": 10,
		"aoColumns":[
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": true},
					 {"bSortable": false}
					 ]
	});
});
</script>
<table id="logs" class="display" border="0" cellpadding="0" cellspacing="0">
	<thead>    	
    	<tr>
            <th>Data</th>
            <th>Nome</th>
            <th>Usu&aacute;rio</th>
            <th>IP</th>
        </tr>
    </thead>
    <tbody>
<?php
$log = $con_tigra->executa("SELECT * FROM tg_acessos WHERE fk_tg_cliente = $_SESSION[id_tg_cliente] AND saida != '00:00:00'");
if($log && mysqli_num_rows($log)>0){
	while($acesso = mysqli_fetch_assoc($log)){
		$usuario = $con_tigra->executa("SELECT * FROM tg_usuarios WHERE id_tg_usuario = $acesso[fk_tg_usuario]");
		$usuario = mysqli_fetch_assoc($usuario);
?>
	<tr>
    	<td><span style="display:none"><?=$acesso['data']." - ".$acesso['entrada']?></span><?=ajustadata($acesso['data'],'site')?> - <?=$acesso['entrada']?> / <?=$acesso['saida']?></td>
        <td><?=$usuario['nome']?></td>
        <td><?=$usuario['usuario']?></td>
        <td><?=$acesso['ip']?></td>
    </tr>
<?php
	}
}
?>
	</tbody>
</table>
