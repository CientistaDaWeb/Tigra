<?php
extract($_POST);
require_once("eventos.php");
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new eventos();
$objeto->id_evento = limpadados($id_evento);
$objeto->titulo = limpadados($titulo);
$objeto->texto = limpadados($texto);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->slug = limpadados(deixa_amigavel($titulo));

$id = limpadados($id_evento);
$tg_mod_tabela = 'eventos';
$tg_mod_tipo = 'evento';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');