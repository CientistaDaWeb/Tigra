<?php
extract($_POST);
require_once("materias_subcategorias.php");

$objeto = new materias_subcategorias();
$objeto->id_materias_subcategoria = limpadados($id_materias_subcategoria);
$objeto->id_materias_categoria = limpadados($id_materias_categoria);
$objeto->subcategoria = limpadados($subcategoria);
$objeto->subcat = limpadados($subcat);

$id = limpadados($id_materias_subcategoria);
$tg_mod_tabela = 'materias_subcategorias';
$tg_mod_tipo = 'Subcategoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>