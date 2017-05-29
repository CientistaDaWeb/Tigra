<?php

extract($_POST);
require_once('produtos.php');
require_once('_classe/upload3.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome = limpadados($nome);
$objeto->referencia = limpadados($referencia);
$objeto->descricao = limpadados($descricao);
$objeto->valor = limpadados($valor);
$objeto->slug = deixa_amigavel($nome);
$objeto->visibilidade = limpadados($visibilidade);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 500;
	$up->img_height = 400;
	
	$up->cli_img_dir = 'htdocs/img_produtos/';

    $up->mode = FTP_BINARY;

	$up->tmb_width = 100;
	$up->tmb_height = 100;
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


