<?php
extract($_POST);
require_once("obras.php");

$objeto = new obras();
$objeto->id_obra = limpadados($id_obra);
$objeto->nome = limpadados($nome);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($nome));

$id = limpadados($id_obra);
$tg_mod_tabela = 'obras';
$tg_mod_tipo = 'Obra';
$tg_mod_sexo = 'a';
require_once('_inc/action2.php');