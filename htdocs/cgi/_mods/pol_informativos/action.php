<?php
extract($_POST);
require_once("informativos.php");
require_once('_classe/upload2.php');

$objeto = new informativos();
$objeto->id_informativo = limpadados($id_informativo);
$objeto->nome = limpadados($nome);
$objeto->mes = limpadados($mes);
$objeto->ano = limpadados($ano);
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($nome));

if($_FILES['arquivo']['size'] > 0){
	$up = new upload($_FILES['arquivo'],'all');
	$up->cli_img_dir = 'informativos/';
    $up->send_file();

	$objeto->arquivo = $up->img_db_name;
}

$id = limpadados($id_informativo);
$tg_mod_tabela = 'informativos';
$tg_mod_tipo = 'Informativo';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>