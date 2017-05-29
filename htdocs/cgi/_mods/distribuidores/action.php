<?php
extract($_POST);
require_once('distribuidores.php');

$objeto = new distribuidores();
$objeto->id_distribuidore = limpadados($id_distribuidore);
$objeto->nome = limpadados($nome);
$objeto->contato = limpadados($contato);
$objeto->cidade_regiao = limpadados($cidade_regiao);
$objeto->id_estado = limpadados($id_estado);
$objeto->fone1 = limpadados($fone1);
$objeto->fone2 = limpadados($fone2);
$objeto->fone3 = limpadados($fone3);
$objeto->email = limpadados($email);

$id = limpadados($id_distribuidore);
$tg_mod_tabela = 'distribuidores';
$tg_mod_tipo = 'distribuidores';
$tg_mod_sexo = 'o';

    /*
    $queryDel = 'DELETE FROM distribuidores_estados WHERE id_distribuidore = '.limpadados($id_distribuidore);
    $deleta = $con_cliente->query($queryDel);
    $queryIns = "INSERT INTO distribuidores_estados(id_distribuidore, id_estado) VALUES ($id_distribuidore, $id_estado)";
    $insere = $con_cliente->query($queryIns);
    */

require_once('_inc/action2.php');
?>