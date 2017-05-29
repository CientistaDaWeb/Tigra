<?php
extract($_POST);
require_once("clippings.php");
require_once('_classe/upload2.php');

$objeto = new clippings();
$objeto->id_clipping = limpadados($id_clipping);
$objeto->assunto = limpadados($assunto);
$objeto->midia = limpadados($midia);
$objeto->local = limpadados($local);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->link = limpadados($link);
$objeto->slug = limpadados(deixa_amigavel($assunto."-".$midia));

if($_FILES['arquivo']['size'] > 0){
	$up = new upload($_FILES['arquivo'],'all');
	$up->cli_img_dir = 'clippings/';
    $up->send_file();

	$objeto->arquivo = $up->img_db_name;
}

$id = limpadados($id_clipping);
$tg_mod_tabela = 'clippings';
$tg_mod_tipo = 'Clipping';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>