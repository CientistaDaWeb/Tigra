<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new filiais();
$objeto->id_filiai = limpadados($id_filiai);
$objeto->nome = limpadados($nome);
$objeto->endereco = limpadados($endereco);
$objeto->cep = limpadados($cep);
$objeto->cidade = limpadados($cidade);
$objeto->fk_estado = limpadados($fk_estado);
$objeto->fone = limpadados($fone);
$objeto->celular = limpadados($celular);
$objeto->contato = limpadados($contato);
$objeto->email = limpadados($email);

$id = limpadados($id_filiai);
$tg_mod_tabela = 'filiais';
$tg_mod_tipo = 'empresa';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');
?>