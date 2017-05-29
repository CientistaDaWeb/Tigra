<?php
extract($_POST);
require_once("permitidos.php");

$objeto = new permitidos();
$objeto->id_permitido = limpadados($id_permitido);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->senha = limpadados($senha);

$id = limpadados($id_permitido);
$tg_mod_tabela = 'permitidos';
$tg_mod_tipo = 'Usuário';
$tg_mod_sexo = 'o';

if($id_permitido){
    $query = 'DELETE FROM obras_permitidos WHERE id_permitido = '.limpadados($id_permitido);
    $deleta = $con_cliente->query($query);
    $total = count($permits);
	for($i=0; $i<$total; $i++){
		$id_obra = $permits[$i];
        $query = "INSERT INTO obras_permitidos(id_obra, id_permitido) VALUES ($id_obra, $id_permitido)";
		$insere = $con_cliente->query($query);
	}
}
require_once('_inc/action2.php');
?>