<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new eventos();
$objeto->id_evento = limpadados($id_evento);
$objeto->evento = limpadados($evento);
$objeto->subtitulo = limpadados($subtitulo);
$objeto->local = limpadados($local);
$objeto->data = ajustadata(limpadados($data),'banco');
$objeto->descricao = limpadados($descricao);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 300;
	$up->tmb_width = 95;
	$up->img_height = 400;
	$up->tmb_height = 71;
	$up->cli_img_dir = '_img/eventos/';
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_evento);
$tg_mod_tabela = 'eventos';
$tg_mod_tipo = 'Evento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>