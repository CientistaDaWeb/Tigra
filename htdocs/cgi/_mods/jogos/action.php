<?php
extract($_POST);
require_once('jogos.php');

$objeto = new jogos();
$objeto->id_jogo = limpadados($id_jogo);
$objeto->id_time_casa = limpadados($id_time_casa);
$objeto->id_time_fora = limpadados($id_time_fora);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->hora = limpadados($hora);
$objeto->estadio = limpadados($estadio);
$objeto->rodada = limpadados($rodada);



$id = limpadados($id_jogo);
$tg_mod_tabela = 'jogos';
$tg_mod_tipo = 'Jogo';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>