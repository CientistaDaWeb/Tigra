<?php
extract($_POST);
require_once("linhas.php");
require_once('_classe/class.upload.php');

$objeto = new linhas();
$objeto->id_linha = limpadados($id_linha);
$objeto->linha = limpadados($linha);
$objeto->slug = limpadados(deixa_amigavel($nome));

$id = limpadados($id_linha);
$tg_mod_tabela = 'linhas';
$tg_mod_tipo = 'linha';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');