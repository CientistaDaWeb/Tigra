<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new clientes();
$objeto->id_cliente = limpadados($id_cliente);
$objeto->cliente = limpadados($cliente);
$objeto->link = limpadados($link);

$id = limpadados($id_cliente);
$tg_mod_tabela = 'clientes';
$tg_mod_tipo = 'Cliente';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>