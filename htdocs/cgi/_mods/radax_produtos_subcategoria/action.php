<?php
extract($_POST);
require_once("produtos_subcategorias.php");

$objeto = new produtos_subcategorias();
$objeto->id_produtos_subcategoria = limpadados($id_produtos_subcategoria);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->subcategoria = limpadados($subcategoria);
$objeto->slug = limpadados(deixa_amigavel($subcategoria));

$id = limpadados($id_produtos_subcategoria);
$tg_mod_tabela = 'produtos_subcategorias';
$tg_mod_tipo = 'Subcategoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>