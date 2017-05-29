<?php
extract($_POST);
require_once('categorias_produtos.php');

$objeto = new categorias_produtos();
$objeto->id_categorias_produto = limpadados($id_categorias_produto);
$objeto->categoria = limpadados($categoria);

$id = limpadados($id_categorias_produto);
$tg_mod_tabela = 'categorias_produtos';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>