<?php
extract($_POST);
require_once('produtos_categorias.php');

$objeto = new produtos_categorias();
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->categoria_pt = limpadados($categoria_pt);
$objeto->slug_pt = limpadados(deixa_amigavel($categoria_pt));
$objeto->categoria_es = limpadados($categoria_es);
$objeto->slug_es = limpadados(deixa_amigavel($categoria_es));

$id = limpadados($id_produtos_categoria);
$tg_mod_tabela = 'produtos_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');