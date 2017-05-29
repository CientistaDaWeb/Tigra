<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_revestimento = limpadados($id_revestimento);
$id_produto = limpadados($id_produto);
$acao = limpadados($acao);

if($acao == 'adicionar'){
    $con->executa("INSERT INTO produtos_revestimentos (id_produto, id_revestimento) VALUES ($id_produto, $id_revestimento)");
}
if($acao == 'remover'){
    $con->executa("DELETE FROM produtos_revestimentos WHERE id_produto = $id_produto AND id_revestimento = $id_revestimento");
}
?>