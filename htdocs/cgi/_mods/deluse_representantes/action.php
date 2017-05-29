<?php
extract($_POST);
require_once('representantes.php');

$objeto = new representantes();
$objeto->id_representante = limpadados($id_representante);
$objeto->nome = limpadados($nome);
$objeto->contato = limpadados($contato);
$objeto->cidade_regiao = limpadados($cidade_regiao);
$objeto->id_estado = limpadados($id_estado);
$objeto->fones = limpadados($fones);
$objeto->emails = limpadados($emails);

$id = limpadados($id_representante);
$tg_mod_tabela = 'representantes';
$tg_mod_tipo = 'Representante';
$tg_mod_sexo = 'o';

    /*
    $queryDel = 'DELETE FROM representantes_estados WHERE id_representante = '.limpadados($id_representante);
    $deleta = $con_cliente->query($queryDel);
    $queryIns = "INSERT INTO representantes_estados(id_representante, id_estado) VALUES ($id_representante, $id_estado)";
    $insere = $con_cliente->query($queryIns);
    */
	

require_once('_inc/action2.php');
?>