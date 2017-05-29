<?php
extract($_POST);
require_once('extras.php');

$objeto = new extras();
$objeto->id_extra = 1;
$objeto->frete = limpadados($frete);
$objeto->vinhos_personalizados = limpadados($vinhos_personalizados);
$objeto->embalagens_promocionais = limpadados($embalagens_promocionais);

$id = 1;
$tg_mod_tabela = 'extras';
$tg_mod_tipo = 'Extras';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>