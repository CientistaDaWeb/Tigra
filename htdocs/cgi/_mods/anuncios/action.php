<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new anuncios();
$objeto->id_anuncio = limpadados($id_anuncio);
$objeto->id_anunciante = limpadados($id_anunciante);
$objeto->altura = limpadados($altura);
$objeto->largura = limpadados($largura);
$objeto->tamanho = limpadados($tamanho);
$objeto->impressoes_contratadas = limpadados($impressoes_contratadas);

$id = limpadados($id_anuncio);
$tg_mod_tabela = 'anuncios';
$tg_mod_tipo = 'An&uacute;ncio';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>