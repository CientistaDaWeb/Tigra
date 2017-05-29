<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();
$id_jogo = limpadados($_POST['id_jogo']);
$usuarios = $con->query('SELECT id_apostadore FROM apostadores WHERE vip = 3');
$i = 0;
if($usuarios && $usuarios->num_rows > 0){
    while($usuario = $usuarios->fetch_assoc()){
        $query = "SELECT * FROM apostas WHERE id_apostadore = $usuario[id_apostadore] AND id_jogo = $id_jogo";
        $apostas = $con->query($query);
        if($apostas && $apostas->num_rows > 0){
        }else{
            $placar_casa = rand(0, 4);
            $placar_fora = rand(0, 4);
            $query = "INSERT INTO apostas (id_jogo, id_apostadore, placar_casa, placar_fora, ip, data) VALUES ($id_jogo, $usuario[id_apostadore], $placar_casa, $placar_fora, 'SISTEMA', NOW())";
            $con->executa($query);
            $i++;
        }
    }
    echo 'Inseridas '.$i.' apostas';
}
?>
