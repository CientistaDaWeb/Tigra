<?php
$status = 1;
extract($_POST);
require_once('produtos_categorias.php');
$objeto = new produtos_categorias();
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->tipo = $tipo;
$objeto->status = $status;
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_produtos_categoria);
$tg_mod_tabela = 'produtos_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>