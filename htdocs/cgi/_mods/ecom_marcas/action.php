<?php
extract($_POST);
require_once('marcas.php');

$objeto = new marcas();
$objeto->id_marca = limpadados($id_marca);
$objeto->marca = limpadados($marca);

$id = limpadados($id_marca);
$tg_mod_tabela = 'marcas';
$tg_mod_tipo = 'Marca';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>