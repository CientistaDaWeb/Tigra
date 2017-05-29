<?php
extract($_POST);
require_once('revestimentos_categorias.php');

$objeto = new revestimentos_categorias();
$objeto->id_revestimentos_categoria = limpadados($id_revestimentos_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->tipo = $tipo;
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_revestimentos_categoria);
$tg_mod_tabela = 'revestimentos_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>