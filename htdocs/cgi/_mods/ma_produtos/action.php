<?php
extract($_POST);
require_once('produtos.php');
require_once('_classe/upload.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome = limpadados($nome);
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($nome));

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 500;
	$up->img_height = 500;
	
	$up->cli_img_dir = '_img/produtos/';
	
	$up->tmb_width = 150;
	$up->tmb_height = 150;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>