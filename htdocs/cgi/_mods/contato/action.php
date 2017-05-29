<div id="tit_mod"><img src="<?=$url_base?>/_img/modulos/titulos/contato.jpg" /></div>
<?php
require_once('_classe/email.php');
extract($_POST);
$nome = $_SESSION['nome'];
if($_SESSION['id_tg_usuario']){
	$email = $con_tigra->executa("SELECT email FROM tg_usuarios WHERE id_tg_usuario = $_SESSION[id_tg_usuario]");
	if($email && mysqli_num_rows($email)>0){
		$email = mysqli_fetch_assoc($email)	;
		$email = $email['email'];
	}
}
$tipo_contato = limpadados($tipo_contato);
$assunto = limpadados($assunto);
$msg = nl2br(limpadados($msg));

$tg_alert_msg = 'E-mail enviado com sucesso!';
$tg_alert_tipo = 'sucesso';
$tg_alert_titulo = 'Sucesso';

$corpo = "Usu&aacute;rio: $nome<br>	
	E-mail: $email<br>
	Mensagem:
	$msg";
	$mail = new email('', '', "[$tipo_contato] $assunto", $corpo, $nome, $email);
	if(!$mail->Send()) {
		$tg_alert_msg = 'Erro ao enviar o e-mail!';
		$tg_alert_tipo = 'erro';
		$tg_alert_titulo = 'Erro';
	}
$tg_link = 	"$url_base/cgi/$mod/";

$_SESSION['alert_msg'] = $tg_alert_msg;
$_SESSION['alert_titulo'] = $tg_alert_titulo;
$_SESSION['alert_tipo'] = $tg_alert_tipo;
?>
<script>
	window.location = '<?=$tg_link?>';
</script>