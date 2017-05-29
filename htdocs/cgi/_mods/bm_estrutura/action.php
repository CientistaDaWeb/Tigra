<?php
extract($_POST);
require_once("estruturas.php");
require_once('_classe/upload.php');

$objeto = new estruturas();
$objeto->id_estrutura = limpadados($id_estrutura);
$objeto->descricao = limpadados($descricao);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 500;
	$up->img_height = 500;

	$up->cli_img_dir = 'img_estrutura/';

	$up->tmb_width = 150;
	$up->tmb_height = 150;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$_SESSION['tg_debug'] = false;

$id = limpadados($id_estrutura);
$tg_mod_tabela = 'estruturas';
$tg_mod_tipo = 'estrutura';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>