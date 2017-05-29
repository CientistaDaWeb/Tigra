<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new tg_cat_modulos();
$objeto->id_tg_cat_modulo = limpadados($id_tg_cat_modulo);
$objeto->categoria = limpadados($categoria);
$objeto->fk_tg_cliente = limpadados($fk_tg_cliente);
if($_FILES['icone']['size'] > 0){
	$up = new upload($_FILES['icone']);
	$up->img_width = 165;
	$up->img_height = 40;
	$up->cli_img_dir = '_img/modulos/categorias/';
	$up->img_resize(true);
	$objeto->icone = $up->img_db_name;
}

$id = limpadados($id_tg_cat_modulo);
$tg_mod_tabela = 'tg_cat_modulos';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

if($id_tg_cat_modulo){
	$deleta_permissoes = $con_tigra->executa("DELETE FROM tg_catxmodulos WHERE fk_tg_cat_modulo = $objeto->id_tg_cat_modulo");
	$total = count($fk_tg_modulo);
	
	for($i=0; $i<$total; $i++){
		$insere = $con_tigra->executa("INSERT INTO tg_catxmodulos(fk_tg_cat_modulo, fk_tg_modulo) VALUES ($id_tg_cat_modulo, $fk_tg_modulo[$i])");
	}
}
require_once('_inc/action.php');
?>