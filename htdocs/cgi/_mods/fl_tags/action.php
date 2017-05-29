<?php
extract($_POST);
require_once("tags.php");

$objeto = new tags();
$objeto->id_tag = limpadados($id_tag);
$objeto->tag = limpadados($tag);

$id = limpadados($id_tag);
$tg_mod_tabela = 'tags';
$tg_mod_tipo = 'Palavra';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>