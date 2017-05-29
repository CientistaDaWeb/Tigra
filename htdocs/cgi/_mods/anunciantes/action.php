<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new anunciantes();
$objeto->id_anunciante = limpadados($id_anunciante);
$objeto->anunciante = limpadados($anunciante);
$objeto->contato = limpadados($contato);
$objeto->telefone = limpadados($telefone);

$id = limpadados($id_anunciante);
$tg_mod_tabela = 'anunciantes';
$tg_mod_tipo = 'Anunciante';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>