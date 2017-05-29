<div id="tit_mod"><img src="<?=$url_base?>/_img/modulos/titulos/sair.jpg" /></div>
<?php
$log = $con_tigra->executa("SELECT MAX(id_tg_acesso) as id_saida FROM tg_acessos WHERE fk_tg_usuario = $_SESSION[id_tg_usuario]");
if($log && mysqli_num_rows($log)>0){
	$log = mysqli_fetch_assoc($log);
	echo("<p>Registrando a saida.</p>");
	$saida = date('H:i:s');
	$con_tigra->executa("UPDATE tg_acessos SET saida = '$saida' WHERE id_tg_acesso = $log[id_saida]");
}
$_SESSION['logado'] = "";
?>
<p id="vazio">Saindo...</p>
<script>
window.location="<?=$url_base?>/login/"
</script>