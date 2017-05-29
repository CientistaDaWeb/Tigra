<?php
extract($_POST);
require_once('setores.php');

$objeto = new setors();
$objeto->id_setor = limpadados($id_setor);
$objeto->setor = limpadados($setor);
$objeto->slug = limpadados(deixa_amigavel($setor));

$id = limpadados($id_setor);
$tg_mod_tabela = 'setors';
$tg_mod_tipo = 'setor';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');