<?php
extract($_POST);
require_once('responsabilidades.php');
require_once('_classe/upload.php');

$objeto = new responsabilidades();
$id = limpadados($id_responsabilidade);
$objeto->id_responsabilidade = limpadados($id_responsabilidade);
$objeto->titulo = limpadados($titulo);
$objeto->linha_apoio = limpadados($linha_apoio);
$objeto->texto = limpadados($texto);
$objeto->slug = limpadados(deixa_amigavel($titulo));

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 420;
	$up->img_height = 420;

	$up->cli_img_dir = '_img/responsabilidades/';

	$up->tmb_width = 100;
	$up->tmb_height = 75;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$tg_mod_tabela = 'responsabilidades';
$tg_mod_tipo = 'Responsabilidade';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>