<?
$segundos = date("H")*3600;
$segundos += date("i")*60;
$segundos += date("s");
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/validator.js"> </script>
<script type="text/javascript">
function hora_atual(){
	var hora_atual = document.getElementById("hora_atual");
	var hora_atual_sec = document.getElementById("hora_atual_sec");

	var value_hora_atual_sec = parseInt(hora_atual_sec.value)+1;
	var hora = parseInt(hora_atual_sec.value/3600);
	var minutos = parseInt(parseInt(hora_atual_sec.value%3600)/60);
	var segundos = hora_atual_sec.value%60;
	if(hora<10){
		hora = "0"+hora;	
	}
	if(minutos<10){
		minutos = "0"+minutos;	
	}
	if(segundos<10){
		segundos = "0"+segundos;	
	}
	var value_hora_atual = hora +":"+ minutos +":"+ segundos;
	
	hora_atual_sec.value = value_hora_atual_sec;
	hora_atual.value = value_hora_atual;
	setTimeout("hora_atual()",1000);
}
$(document).ready(function(){
	hora_atual();
	$('#logs').dataTable({
		"oLanguage": {
			"sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
		},
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 0, "desc" ]],
		"iDisplayLength": 10,
		"aoColumns":[
					 {"bSortable": true},
					 {"bSortable": false}
					 ]
	});
});
</script>
<div id="tit_mod"><img src="<?=$url_base?>/_img/modulos/titulos/home.jpg" /></div>
<div id="dados_inicio">
    <div class="duascolunas2" id="div_hora_atual">	
        <p><span id="data_atual"><?=date('d/m/Y')?> - </span>
        <input id="hora_atual" value="<?=date('H:i:s')?>" type="text" readonly="readonly"  /></p>
        <input id="hora_atual_sec" value="<?=$segundos?>" type="text" readonly="readonly"  />
    </div>
    <div class="duascolunas2" id="troca_senha">
        <form id="form_troca_senha" onsubmit="return ween_validator()" method="post" action="<?=$url_base?>/cgi/<?=$mod?>/action">
        <table>
            <tr>
                <td colspan="2"><h4>Alterar Senha:</h4></td>
            </tr>
            <tr>
                <td>Senha antiga:</td>
                <td><input type="password" name="senha_antiga" id="senha_antiga" class="inpute obrigatorio medio" title="Senha Antiga" /></td>
            </tr>
            <tr>
                <td>Senha nova:</td>
                <td><input type="password" name="senha_nova" id="senha_nova" class="inpute obrigatorio medio" title="Senha Nova" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Trocar Senha" id="btn_alterar_senha" /></td>
            </tr>
        </table>
        </form>
    </div>
</div>
<h4>Seja bem vindo(a) <?=$_SESSION['nome']?>.</h4>
<h4>Seus &uacute;ltimos acessos foram:</h4>
<table id="logs" class="display" border="0" cellpadding="0" cellspacing="0">
	<thead>    	
    	<tr>
            <th>Data</th>
            <th>IP</th>
        </tr>
    </thead>
    <tbody>
<?php
$log = $con_tigra->executa("SELECT * FROM tg_acessos WHERE fk_tg_usuario = $_SESSION[id_tg_usuario] AND saida != '00:00:00'");
if($log && mysqli_num_rows($log)>0){
	while($acesso = mysqli_fetch_assoc($log)){
?>
	<tr>
    	<td><span style="display:none"><?=$acesso['data']." - ". $acesso['entrada']?></span><?=ajustadata($acesso['data'],"site")?> - <?=$acesso['entrada']?> / <?=$acesso['saida']?></td>
        <td><?=$acesso['ip']?></td>
    </tr>
<?php
	}
}
?>
	</tbody>
</table>
