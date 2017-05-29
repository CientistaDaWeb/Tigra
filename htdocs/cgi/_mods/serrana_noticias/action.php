<?php
extract($_POST);
require_once("noticias.php");
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new noticias();
$objeto->id_noticia = limpadados($id_noticia);
$objeto->titulo = limpadados($titulo);
$objeto->texto = limpadados($texto);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->slug = limpadados(deixa_amigavel($titulo));

$id = limpadados($id_noticia);
$tg_mod_tabela = 'noticias';
$tg_mod_tipo = 'noticia';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');