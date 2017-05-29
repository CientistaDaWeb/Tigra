<?php
extract($_POST);
require_once('cursos.php');

$objeto = new cursos();
$objeto->id_curso = limpadados($id_curso);
$objeto->id_cursos_categoria = limpadados($id_cursos_categoria);
$objeto->curso = limpadados($curso);
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($curso));

$id = limpadados($id_curso);
$tg_mod_tabela = 'cursos';
$tg_mod_tipo = 'Curso';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');