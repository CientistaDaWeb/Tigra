<?php
extract($_POST);
require_once('opcoes_caracteristicas.php');

$objeto = new opcoes_caracteristicas();
$objeto->id_opcoes_caracteristica = limpadados($id_opcoes_caracteristica);
$objeto->id_caracteristicas_categoria = limpadados($id_caracteristicas_categoria);
$objeto->opcao = limpadados($opcao);
$objeto->opc = limpadados(deixa_amigavel($opcao));

$id = limpadados($id_opcoes_caracteristica);
$tg_mod_tabela = 'opcoes_caracteristicas';
$tg_mod_tipo = 'Opção';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>