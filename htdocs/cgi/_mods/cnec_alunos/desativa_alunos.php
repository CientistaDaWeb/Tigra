<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();
$id_setor = $_POST['id_setor'];

$query = 'UPDATE alunos SET ativo = "N"';
$con->query($query);

echo 'Alunos desativados com sucesso!';