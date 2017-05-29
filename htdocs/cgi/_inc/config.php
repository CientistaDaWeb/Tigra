<?php
$url = $_SERVER['REQUEST_URI'];
$var = explode('/', $url);

$url_base = 'http://'.$_SERVER['HTTP_HOST'];

$mod = $var[2];
$pagina = $var[3];
$id = $var[4];

if($mod){
	$tg_mod = decripfy($mod, 'm0dul0');
}else{
	$tg_mod = 'inicio';
}
if(!$pagina){
	$pagina = 'list';
}
?>