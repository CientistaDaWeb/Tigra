<script type="text/javascript">
$(document).ready(function(){
	$('#lista').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"iDisplayLength": 25,
		"aoColumns":[
					 {"bSortable": false},
					 {"bSortable": false},
					 {"bSortable": true},
                     {"bSortable": false},
                     {"bSortable": true},
                     {"bSortable": false}
					 ]
	});
});
</script>
<?php
$query = "SELECT sigla, ano FROM campeonatos ORDER BY sigla, ano";
$campeonatos = $con_cliente->query($query);
if($campeonatos && $campeonatos->num_rows > 0){
    while($campeonato = $campeonatos->fetch_assoc()){
        ?>
        <div class="duascolunas">
        <form method="post">
            <input type="hidden" name="sigla" value="<?=$campeonato['sigla']?>" />
            <input type="hidden" name="ano" value="<?=$campeonato['ano']?>" />
            <input type="submit" value="<?=$campeonato['sigla']?> - <?=$campeonato['ano']?>" />
        </form>
        </div>
        <?
    }
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" id="form_deletar" onsubmit="return valida_deletar();" style="clear:both">
<table id="table_botoes">
    <tr>
        <td><input type="button" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>/form'" value="Novo" id="bt_novo" /></td>
        <td><input type="submit" value="Excluir" id="bt_excluir" /></td>
    </tr>
</table>
<?php
extract($_POST);
if(!$sigla){
    $sigla = 'bra';
}
if(!$ano){
    $ano = 2009;
}
$query = "SELECT j.id_time_casa, j.id_time_fora, j.id_jogo, c.sigla, c.ano FROM jogos AS j, campeonatos AS c WHERE j.id_campeonato = c.id_campeonato AND c.sigla = '$sigla' AND c.ano = $ano";
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
            <th>Time de casa</th>
            <th>x</th>
            <th>Time de Fora</th>
            <th></th>
         </tr>
     </thead>
     <tbody>
<?php
	while($item = mysqli_fetch_assoc($busca)){
        $query = 'SELECT nome_abreviado FROM times WHERE id_time = '.$item['id_time_casa'];
        $time_casa = $con_cliente->query($query);
        $time_casa = $time_casa->fetch_assoc();
        $time_casa = $time_casa['nome_abreviado'];
        $query = 'SELECT nome_abreviado FROM times WHERE id_time = '.$item['id_time_fora'];
        $time_fora = $con_cliente->query($query);
        $time_fora = $time_fora->fetch_assoc();
        $time_fora = $time_fora['nome_abreviado'];
	?>
		<tr>
        	<td class="campo_checkbox"><label for="checkbox<?=$item['id_jogo']?>" id="label<?=$item['id_jogo']?>"></label><input type="checkbox" class="crirHiddenJS" name="del_item[]" id="checkbox<?=$item['id_jogo']?>" value="<?=$item['id_jogo']?>" /></td>
            <td class="campo_editar"><a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$item['id_jogo']?>"><img src="_css/_img/btn/btn_editar.png" /></a></td>
            <td><?=$time_casa?></td>
            <td>x</td>
            <td><?=$time_fora?></td>
            <td><?=$item['sigla']?> - <?=$item['ano']?></td>
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
