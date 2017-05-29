<?php
extract($_POST);
require_once('revestimentos.php');
require_once('_classe/upload3.php');

$objeto = new revestimentos();
$objeto->id_revestimento = limpadados($id_revestimento);
$objeto->revestimento = limpadados($revestimento);
$objeto->slug = deixa_amigavel($revestimento);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 400;
	$up->img_height = 400;
	
	//$up->cli_img_dir = 'htdocs/img_revestimentos/';
	$up->cli_img_dir = 'img/revestimentos/';

    $up->mode = FTP_BINARY;

	$up->tmb_width = 120;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_revestimento);
$tg_mod_tabela = 'revestimentos';
$tg_mod_tipo = 'revestimento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>


