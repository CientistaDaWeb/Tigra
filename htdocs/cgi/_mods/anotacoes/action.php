<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new anotacoes();
$objeto->id_anotacoe = limpadados($id_anotacoe);
$objeto->titulo = limpadados($titulo);
$objeto->texto = limpadados($texto);
$objeto->data = ajustadata(limpadados($data),'banco');
$objeto->fk_tg_usuario = $_SESSION["id_tg_usuario"];

$id = limpadados($id_anotacoe);
$tg_mod_tabela = 'anotacoes';
$tg_mod_tipo = 'Nota';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>