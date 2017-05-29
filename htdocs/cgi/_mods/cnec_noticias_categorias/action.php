<?php
extract($_POST);
require_once('noticias_categorias.php');

$objeto = new noticias_categorias();
$objeto->id_noticias_categoria = limpadados($id_noticias_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_noticias_categoria);
$tg_mod_tabela = 'noticias_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');