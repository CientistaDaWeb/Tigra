<?php
extract($_POST);
require_once('categorias_subcategorias.php');

$objeto = new categorias_subcategorias();
$objeto->id_categorias_subcategoria = limpadados($id_categorias_subcategoria);
$objeto->id_produtos_categorias = $id_categorias_produtos;
$objeto->subcategoria = limpadados($subcategoria);
$objeto->slug = limpadados(deixa_amigavel($subcategoria));

$id = limpadados($id_categorias_subcategoria);
$tg_mod_tabela = 'categorias_subcategorias';
$tg_mod_tipo = 'Subcategoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>