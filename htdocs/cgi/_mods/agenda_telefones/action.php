<?php
extract($_POST);
require_once("$tg_mod.php");

$objeto = new agenda_telefones();
$objeto->id_agenda_telefone = limpadados($id_agenda_telefone);
$objeto->nome = limpadados($nome);
$objeto->empresa = limpadados($empresa);
$objeto->tel_res = limpadados($tel_res);
$objeto->tel_com = limpadados($tel_com);
$objeto->tel_cel = limpadados($tel_cel);
$objeto->email = limpadados($email);
$objeto->status = limpadados($status);

$id = limpadados($id_agenda_telefone);
$tg_mod_tabela = 'agenda_telefones';
$tg_mod_tipo = 'Contato';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>