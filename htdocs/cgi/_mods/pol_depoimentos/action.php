<?php
extract($_POST);
require_once('depoimentos.php');
require_once('_classe/upload.php');

$objeto = new depoimentos();
$id = limpadados($id_depoimento);
$objeto->id_depoimento = limpadados($id_depoimento);
$objeto->nome = limpadados($nome);
$objeto->cargo = limpadados($cargo);
$objeto->depoimento = limpadados($depoimento);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
    $up->img_width = 78;
    $up->img_height = 116;

	$up->cli_img_dir = '_img/depoimentos/';

	$up->img_resize(true, false);
	$objeto->imagem = $up->img_db_name;
}

$tg_mod_tabela = 'depoimentos';
$tg_mod_tipo = 'depoimento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>