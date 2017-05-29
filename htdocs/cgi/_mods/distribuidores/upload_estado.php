<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_representante = limpadados($id_distribuidore);
$id_estado = limpadados($id_estado);
$acao = limpadados($acao);

if($acao == 'adicionar'){
	$con->executa("INSERT INTO distribuidores_estados (id_distribuidore, id_estado) VALUES ($id_distribuidore, $id_estado)");
    echo "INSERT INTO distribuidores_estados (id_distribuidore, id_estado) VALUES ($id_distribuidore, $id_estado)";
}
if($acao == 'remover'){
	$con->executa("DELETE FROM distribuidores_estados WHERE id_distribuidore = $id_distribuidore AND id_estado = $id_estado");
}
?>