<?php
extract($_POST);
require_once("materias_comentarios.php");

$objeto = new materias_comentarios();
$objeto->id_materias_comentario = limpadados($id_materias_comentario);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->url_site = limpadados($url_site);
$objeto->comentario = limpadados($comentario);
$objeto->status = limpadados($status);

$id = limpadados($id_materias_comentario);
$tg_mod_tabela = 'materias_comentarios';
$tg_mod_tipo = 'Coment&aacute;rio';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>