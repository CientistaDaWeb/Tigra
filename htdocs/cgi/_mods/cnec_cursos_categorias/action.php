<?php
extract($_POST);
require_once('cursos_categorias.php');

$objeto = new cursos_categorias();
$objeto->id_cursos_categoria = limpadados($id_cursos_categoria);
$objeto->id_setor = limpadados($id_setor);
$objeto->categoria = limpadados($categoria);
$objeto->slug = limpadados(deixa_amigavel($categoria));

$id = limpadados($id_cursos_categoria);
$tg_mod_tabela = 'cursos_categorias';
$tg_mod_tipo = 'Categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');