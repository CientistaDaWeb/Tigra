<?php
extract($_POST);
require_once('lojas.php');

$objeto = new lojas();
$objeto->id_loja = limpadados($id_loja);
$objeto->id_estado = limpadados($id_estado);
$objeto->nome = limpadados($nome);
$objeto->endereco = limpadados($endereco);
$objeto->bairro = limpadados($bairro);
$objeto->cidade = limpadados($cidade);
$objeto->telefone = limpadados($telefone);
$objeto->telefone2 = limpadados($telefone2);
$objeto->email = limpadados($email);

$id = limpadados($id_loja);
$tg_mod_tabela = 'lojas';
$tg_mod_tipo = 'loja';
$tg_mod_sexo = 'a';

    /*
    $queryDel = 'DELETE FROM lojas_estados WHERE id_loja = '.limpadados($id_loja);
    $deleta = $con_cliente->query($queryDel);
    $queryIns = "INSERT INTO lojas_estados(id_loja, id_estado) VALUES ($id_loja, $id_estado)";
    $insere = $con_cliente->query($queryIns);
    */

require_once('_inc/action2.php');
?>