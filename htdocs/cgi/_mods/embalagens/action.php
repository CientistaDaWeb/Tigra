<?php
extract($_POST);
require_once('embalagens.php');

$objeto = new embalagens();
$objeto->id_embalagen = limpadados($id_embalagen);
$objeto->embalagem_pt = limpadados($embalagem_pt);
$objeto->embalagem_en = limpadados($embalagem_en);
$objeto->embalagem_es = limpadados($embalagem_es);

$id = limpadados($id_embalagen);
$tg_mod_tabela = 'embalagens';
$tg_mod_tipo = 'embalagem';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>