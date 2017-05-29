<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new frotas();
$objeto->id_frota = limpadados($id_frota);
$objeto->descricao = limpadados($descricao);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 500;
	$up->img_height = 375;
	
	$up->cli_img_dir = '_img/frotas/';
	
	$up->tmb_width = 144;
	$up->tmb_height = 108;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_frota);
$tg_mod_tabela = 'frotas';
$tg_mod_tipo = 'Carro';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>