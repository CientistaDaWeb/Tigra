<?php
session_start();
require_once('../cgi/_classe/database.php');
require_once('../cgi/_inc/function.php');

$con_ween = new database();

$usuario = limpadados($_POST['tg_usuario']);
$senha = limpadados($_POST['tg_senha']);

$loga = $con_ween->executa("SELECT * FROM tg_usuarios WHERE usuario = '$usuario' AND senha = '$senha' AND fk_tg_cliente = $_SESSION[id_tg_cliente]");
if($loga && mysqli_num_rows($loga) == 1){
	$loga = mysqli_fetch_assoc($loga);
	
	$cliente = $con_ween->executa("SELECT * FROM tg_clientes WHERE id_tg_cliente = $_SESSION[id_tg_cliente]");
	$cliente = mysqli_fetch_assoc($cliente);
	
	$_SESSION['id_tg_usuario'] = $loga['id_tg_usuario'];
	$_SESSION['nome'] = $loga['nome'];
	$_SESSION['dominio'] = $cliente['dominio'];
	$_SESSION['cliente'] = $cliente['nome'];
	$_SESSION['logado'] = 'weennn';
	$_SESSION['db_host'] = $cliente['db_host'];
	$_SESSION['db_user'] = $cliente['db_user'];
	$_SESSION['db_pass'] = $cliente['db_pass'];
	$_SESSION['db_dbname'] = $cliente['db_dbname'];
	$_SESSION['ftp_host'] = $cliente['ftp_host'];
	$_SESSION['ftp_user'] = $cliente['ftp_user'];
	$_SESSION['ftp_pass'] = $cliente['ftp_pass'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$data = date('Y/m/d');
	$entrada = date('H:i:s');
	
	$log = $con_ween->executa("INSERT INTO tg_acessos (fk_tg_usuario, fk_tg_cliente, data, entrada, ip) VALUES ($loga[id_tg_usuario], $cliente[id_tg_cliente], '$data', '$entrada', '$ip')");
	
	echo("Voc&ecirc; est&aacute; sendo direcionado ao site<br/><script>window.location = '../cgi'; </script>");
}else{
	echo('Dados Incorretos');
	?>
	<script>
		$("#botao_warning").html("<input type='button' id='close_warning' value='OK' onclick='close_warning();' />");
    </script>
	<?php
}
?>