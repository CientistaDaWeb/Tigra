<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new parceiros();
$objeto->id_parceiro = limpadados($id_parceiro);
$objeto->parceiro = limpadados($parceiro);
$objeto->url_site = limpadados($url_site);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 140;
	$up->img_height = 90;
	$up->cli_img_dir = '_img/parceiros/';
	$up->img_resize(true, false);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_parceiro);
$tg_mod_tabela = 'parceiros';
$tg_mod_tipo = 'Parceiro';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>