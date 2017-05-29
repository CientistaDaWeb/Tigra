<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new recados();
$id = limpadados($id_recado);
$objeto->id_recado = limpadados($id_recado);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->recado = limpadados($recado);
$objeto->data = ajustadata(limpadados($data),'banco');
$objeto->aprovado = limpadados($aprovado);


$tg_mod_tabela = 'recados';
$tg_mod_tipo = 'Recado';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>