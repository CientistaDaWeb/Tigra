<?php
extract($_POST);
require_once('produtos.php');
require_once('_classe/upload.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$categoria = split(",",$categoria);
$objeto->id_produtos_categoria = limpadados($categoria[0]);
$objeto->id_categorias_subcategoria = limpadados($categoria[1]);
$objeto->produto = limpadados($produto);
$objeto->ref = limpadados($ref);
$objeto->descricao = limpadados($descricao);

$objeto->imagem = '';
$objeto->imagem2 = '';

$objeto->video = limpadados($video);
$objeto->slug = limpadados(deixa_amigavel($produto));

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 400;
	$up->img_height = 400;
	
	$up->cli_img_dir = 'imgs/pro/';
	
	$up->tmb_width = 120;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}
if($_FILES['imagem2']['size'] > 0){
	$up = new upload($_FILES['imagem2']);
	$up->img_width = 400;
	$up->img_height = 400;

	$up->cli_img_dir = 'imgs/pro2/';

	$up->tmb_width = 120;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem2 = $up->img_db_name;
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>