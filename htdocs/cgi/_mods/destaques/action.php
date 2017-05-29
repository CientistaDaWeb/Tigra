<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new destaques();
$objeto->id_destaque = limpadados($id_destaque);
$objeto->titulo = limpadados($titulo);
$objeto->resumo_texto = limpadados($resumo_texto);
$objeto->descricao = limpadados($descricao);
$objeto->data = ajustadata(limpadados($data),'banco');

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 300;
	$up->img_height = 400;
	$up->cli_img_dir = '_img/destaques/';
	
	$up->tmb_width = 90;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_destaque);
$tg_mod_tabela = 'destaques';
$tg_mod_tipo = 'Destaque';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>