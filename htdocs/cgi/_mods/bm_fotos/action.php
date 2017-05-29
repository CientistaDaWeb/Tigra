<?php
extract($_POST);
require_once("fotos.php");
require_once('_classe/upload.php');

$objeto = new fotos();
$objeto->id_foto = limpadados($id_foto);
$objeto->legenda = limpadados($legenda);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 500;
	$up->img_height = 500;

	$up->cli_img_dir = 'img_fotos/';

	$up->tmb_width = 150;
	$up->tmb_height = 150;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}


$id = limpadados($id_foto);
$tg_mod_tabela = 'fotos';
$tg_mod_tipo = 'foto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>