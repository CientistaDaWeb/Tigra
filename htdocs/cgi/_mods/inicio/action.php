<?php
require_once('_inc/function.php');
require_once('_classe/database.php');
$con = new database();

$senha_antiga = limpadados($_POST['senha_antiga']);
$senha_nova = limpadados($_POST['senha_nova']);

$usuario = $con->executa("SELECT id_tg_usuario FROM tg_usuarios WHERE id_tg_usuario = $_SESSION[id_tg_usuario] AND senha = '$senha_antiga'");
if($usuario && mysqli_num_rows($usuario)>0){
	$atualiza = $con ->executa("UPDATE tg_usuarios SET senha = '$senha_nova' WHERE id_tg_usuario = $_SESSION[id_tg_usuario]");
	$tg_alert_msg = 'Senha alterada com sucesso!';
	$tg_alert_titulo = 'Sucesso!';
	$tg_alert_tipo = 'sucesso';
	
}else{
	$tg_alert_msg = 'Senha antiga não confere.';
	$tg_alert_titulo = 'Erro!';
	$tg_alert_tipo = 'erro';
}
$tg_link = 	"$url_base/cgi/$mod";

$_SESSION['alert_msg'] = $tg_alert_msg;
$_SESSION['alert_titulo'] = $tg_alert_titulo;
$_SESSION['alert_tipo'] = $tg_alert_tipo;
?>
<script>
	window.location = '<?=$tg_link?>';
</script>