<?php
extract($_POST);
require_once("usuarios.php");

$objeto = new usuarios();
$objeto->id_usuario = limpadados($id_usuario);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->usuario = limpadados($usuario);
$objeto->senha = limpadados($senha);

$id = limpadados($id_usuario);
$tg_mod_tabela = 'usuarios';
$tg_mod_tipo = 'Usuário';
$tg_mod_sexo = 'o';

if($id_usuario){
    $query = 'DELETE FROM produtos_usuarios WHERE id_usuario = '.limpadados($id_usuario);
    $deleta = $con_cliente->query($query);
    $total = count($permits);
	for($i=0; $i<$total; $i++){
		$id_produtos_categoria = $permits[$i];
        $query = "INSERT INTO produtos_usuarios(id_produtos_categoria, id_usuario) VALUES ($id_produtos_categoria, $id_usuario)";
		$insere = $con_cliente->query($query);
	}
}
require_once('_inc/action2.php');
?>