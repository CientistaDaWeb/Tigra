<?php
extract($_POST);
require_once("obras_categorias.php");

$objeto = new obras_categorias();
$objeto->id_obras_categoria = limpadados($id_obras_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_obras_categoria);
$tg_mod_tabela = 'obras_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>