<?php
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$tag = limpadados($_POST['tag']);

$busca = $con->executa("SELECT * FROM tags WHERE tag = '$tag'");
if($busca && mysqli_num_rows($busca)>0){
	echo("Palavra chave já cadastrada!");
}
return false;
?>