<?php
extract($_POST);
require_once("noticias.php");
require_once('_classe/upload.php');

$objeto = new noticias();
$objeto->id_noticia = limpadados($id_noticia);
$objeto->titulo = limpadados($titulo);
$objeto->linha_apoio = limpadados($linha_apoio);
$objeto->texto = limpadados($texto);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->slug = limpadados(deixa_amigavel($titulo));

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 425;
	$up->img_height = 320;

	$up->cli_img_dir = '_img/noticias/';

	$up->tmb_width = 250;
	$up->tmb_height = 180;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_noticia);
$tg_mod_tabela = 'noticias';
$tg_mod_tipo = 'Not&iacute;cia';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>