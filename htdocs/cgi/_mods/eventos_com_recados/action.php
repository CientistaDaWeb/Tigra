<?php
extract($_POST);
require_once("eventos.php");

$objeto = new eventos();
$objeto->id_evento = limpadados($id_evento);
$objeto->titulo = limpadados($titulo);
$objeto->local = limpadados($local);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($titulo));

$id = limpadados($id_evento);
$tg_mod_tabela = 'eventos';
$tg_mod_tipo = 'evento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>