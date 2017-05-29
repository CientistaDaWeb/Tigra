<?php
extract($_POST);
require_once('alunos.php');

if(!$trocasenha) {
    $objeto = new alunos();
    $objeto->id_aluno = limpadados($id_aluno);
    $objeto->id_setor = limpadados($id_setor);
    $objeto->matricula = limpadados($matricula);
    $objeto->nome = limpadados($nome);
    $objeto->email = limpadados($email);
    $objeto->ativo = limpadados($ativo);
}else {
    $objeto = new alunos();
    $objeto->id_aluno = limpadados($id_aluno);
    $objeto->id_setor = limpadados($id_setor);
    $objeto->matricula = limpadados($matricula);
    $objeto->ativo = limpadados($ativo);
    $objeto->senha = md5($senhanova);
}
$id = limpadados($id_aluno);
$tg_mod_tabela = 'alunos';
$tg_mod_tipo = 'Aluno';
$tg_mod_sexo = 'o';

$_SESSION['tg_debug'] = false;
require_once('_inc/action2.php');