<?php
extract($_POST);
require_once('premios_classificacoes.php');

$objeto = new premios_classificacoes();
$objeto->id_premios_classificacoe = limpadados($id_premios_classificacoe);
$objeto->classificacao = limpadados($classificacao);
$objeto->slug = limpadados(deixa_amigavel($classificacao));

$id = limpadados($id_premios_classificacoe);
$tg_mod_tabela = 'premios_classificacoes';
$tg_mod_tipo = 'Prêmios Classificações';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>