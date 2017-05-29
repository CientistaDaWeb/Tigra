<?php
extract($_POST);
require_once('premios.php');
require_once('_classe/upload.php');

$objeto = new premios();
$objeto->id_premio = limpadados($id_premio);
$objeto->id_premios_classificacoe = limpadados($id_premios_classificacoe);
$objeto->concurso = limpadados($concurso);
$objeto->descricao = limpadados($descricao);
$objeto->vinho_premiado = limpadados($vinho_premiado);
$objeto->slug = deixa_amigavel($concurso);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 400;
	$up->img_height = 400;
	
	$up->cli_img_dir = 'img_premios/';
	
	$up->tmb_width = 120;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_premio);
$tg_mod_tabela = 'premios';
$tg_mod_tipo = 'Prêmios';
$tg_mod_sexo = 'o';


require_once('_inc/action2.php');
?>