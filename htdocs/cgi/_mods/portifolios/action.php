<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new portifolios();
$objeto->id_portifolio = limpadados($id_portifolio);
$objeto->cliente = limpadados($cliente);
$objeto->url = limpadados($url);
$objeto->descricao = limpadados($descricao);
$objeto->data = ajustadata(limpadados($data),'banco');

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 400;
	$up->img_height = 400;
	
	$up->cli_img_dir = '_img/portifolios/';
	
	$up->tmb_width = 180;
	$up->tmb_height = 180;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_portifolio);
$tg_mod_tabela = 'portifolios';
$tg_mod_tipo = 'Trabalho';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>