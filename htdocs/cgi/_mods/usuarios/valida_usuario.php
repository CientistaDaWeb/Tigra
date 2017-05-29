<?php
require_once('../../_inc/function.php');
require_once('../../_classe/database.php');
$con = new database();

$usuario = limpadados($_POST['usuario']);
$id_tg_cliente = limpadados($_POST['id_tg_cliente']);

$busca = $con->executa("SELECT * FROM tg_usuarios WHERE usuario = '$usuario' AND fk_tg_cliente = $id_tg_cliente");
if($busca && mysqli_num_rows($busca)>0){
	echo("Usuário já cadastrado!");
}
return false;
?>