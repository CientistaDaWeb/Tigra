<?php
extract($_POST);
require_once('catalogo_categorias.php');

$objeto = new catalogo_categorias();
$objeto->id_catalogo_categoria = limpadados($id_catalogo_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->tipo = $tipo;
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_catalogo_categoria);
$tg_mod_tabela = 'catalogo_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>