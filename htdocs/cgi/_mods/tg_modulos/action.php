<?php
extract($_POST);

require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new tg_modulos();
$objeto->id_tg_modulo = $id_tg_modulo;
$objeto->modulo = limpadados($modulo);
$objeto->pasta = cripfy(limpadados($pasta),'m0dul0');
$objeto->descricao = limpadados($descricao);
$objeto->tooltip_msg = limpadados($tooltip_msg);
$objeto->sql_tabela = limpadados($sql_tabela);
//$objeto->mensalidade = limpadados(number_format($mensalidade,"2",".",","));
$objeto->mensalidade = limpadados($mensalidade);

if($_FILES['icone']['size'] > 0){
	$up = new upload($_FILES['icone']);
	$up->img_width = 165;
	$up->img_height = 50;
	$up->cli_img_dir = '_img/modulos/icones/';
	$up->img_resize(true, false);
	$objeto->icone = $up->img_db_name;
}
if($_FILES['titulo']['size'] > 0){
	$up = new upload($_FILES['titulo']);
	$up->img_width = 560;
	$up->img_height = 50;
	$up->cli_img_dir = '_img/modulos/titulos/';
	$up->img_resize(true, false);
	$objeto->titulo = $up->img_db_name;
}
	
$id = limpadados($id_tg_modulo);
$tg_mod_tabela = 'tg_modulos';
$tg_mod_tipo = 'M&oacute;dulo';
$tg_mod_sexo = 'o';

require_once('_inc/action.php');
?>