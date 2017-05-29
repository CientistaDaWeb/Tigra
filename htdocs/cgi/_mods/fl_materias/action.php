<?php
extract($_POST);
require_once("_mods/fl_materias_redator/materias.php");
require_once('_classe/upload.php');

$objeto = new materias();
$objeto->id_materia = limpadados($id_materia);
$categoria = split(",",$categoria);
$objeto->id_materias_categoria = limpadados($categoria[0]);
$objeto->id_materias_subcategoria = limpadados($categoria[1]);
$objeto->titulo = limpadados($titulo);
$objeto->linha_apoio = limpadados($linha_apoio);
$objeto->texto = limpadados($texto);
$objeto->id_redatore = $_SESSION['id_tg_usuario'];
$objeto->status = limpadados($status);
$objeto->data = date("Y-m-d H:i:s");
$objeto->legenda_foto = limpadados($legenda_foto);
$objeto->credito_foto = limpadados($credito_foto);
$objeto->video_link = limpadados($video_link);
$objeto->video_tipo = limpadados($video_tipo);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	if($categoria[1] == 12){
		$up->img_width = 580;
		$up->img_height = 300;
	}else{
		$up->img_width = 300;
		$up->img_height = 300;
	}
	$up->cli_img_dir = '_img/materias/';
	
	$up->tmb_width = 160;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_materia);
$tg_mod_tabela = 'materias';
$tg_mod_tipo = 'Mat&eacute;ria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>