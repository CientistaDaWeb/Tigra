<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new encomendas();
$objeto->id_encomenda = limpadados($id_encomenda);
$objeto->cnpj = limpadados($cnpj);
$objeto->observacoes = limpadados($observacoes);
$objeto->nf = limpadados($nf);

$id = limpadados($id_encomenda);
$tg_mod_tabela = 'encomendas';
$tg_mod_tipo = 'Encomenda';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>