<?php
extract($_POST);

require_once('tg_fornecedores.php');
require_once('_classe/upload.php');

$objeto = new tg_fornecedores();
$objeto->id_tg_fornecedore = $id_tg_fornecedore;
$objeto->fornecedor = limpadados($fornecedor);

$id = limpadados($id_tg_fornecedore);
$tg_mod_tabela = 'tg_fornecedores';
$tg_mod_tipo = 'fornecedor';
$tg_mod_sexo = 'o';

require_once('_inc/action.php');