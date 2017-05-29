<?php
extract($_POST);
require_once("materias_categorias.php");

$objeto = new materias_categorias();
$objeto->id_materias_categoria = limpadados($id_materias_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->cat = limpadados($cat);

$id = limpadados($id_materias_categoria);
$tg_mod_tabela = 'materias_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>