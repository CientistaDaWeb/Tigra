<?php
extract($_POST);
require_once('caracteristicas_categorias.php');

$objeto = new caracteristicas_categorias();
$objeto->id_caracteristicas_categoria = limpadados($id_caracteristicas_categoria);
$objeto->id_categorias_produto = limpadados($id_categorias_produto);
$objeto->caracteristica = limpadados($caracteristica);
$objeto->carac = limpadados(deixa_amigavel($caracteristica));

$id = limpadados($id_caracteristicas_categoria);
$tg_mod_tabela = 'caracteristicas_categorias';
$tg_mod_tipo = 'Característica';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>