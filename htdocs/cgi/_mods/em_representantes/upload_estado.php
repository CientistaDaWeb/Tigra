<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_representante = limpadados($id_representante);
$id_estado = limpadados($id_estado);
$acao = limpadados($acao);

if($acao == 'adicionar'){
	$con->executa("INSERT INTO representantes_estados (id_representante, id_estado) VALUES ($id_representante, $id_estado)");
    echo "INSERT INTO representantes_estados (id_representante, id_estado) VALUES ($id_representante, $id_estado)";
}
if($acao == 'remover'){
	$con->executa("DELETE FROM representantes_estados WHERE id_representante = $id_representante AND id_estado = $id_estado");
}
?>