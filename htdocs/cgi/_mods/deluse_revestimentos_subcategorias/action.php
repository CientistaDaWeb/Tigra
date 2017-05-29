<?php
extract($_POST);
require_once('revestimentos_subcategorias.php');

$objeto = new revestimentos_subcategorias();
$objeto->id_revestimentos_subcategoria = limpadados($id_revestimentos_subcategoria);
$objeto->id_revestimentos_categoria = limpadados($id_revestimentos_categoria);
$objeto->subcategoria = limpadados($subcategoria);
$objeto->tipo = $tipo;
$objeto->slug = limpadados(deixa_amigavel($subcategoria));

$id = limpadados($id_revestimentos_subcategoria);
$tg_mod_tabela = 'revestimentos_subcategorias';
$tg_mod_tipo = 'subcategoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>