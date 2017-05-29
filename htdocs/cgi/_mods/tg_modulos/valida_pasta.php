<?php
require_once('../../_inc/function.php');
require_once('../../_classe/database.php');
$con = new database();

$pasta = limpadados($_POST['pasta']);

$busca = $con->executa("SELECT pasta FROM tg_modulos");
if($busca && mysqli_num_rows($busca)>0){
	while($item = mysqli_fetch_assoc($busca)){
		if(decripfy($item['pasta'],"m0dul0") == $pasta){
			echo("Pasta $pasta já utilizada");
			break;
		}
	}
}
return false;
?>