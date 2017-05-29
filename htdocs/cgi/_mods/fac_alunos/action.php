<?php
extract($_POST);
require_once('fac_alunos.php');

if(!$trocasenha){
$objeto = new fac_alunos();
$objeto->id_fac_aluno = limpadados($id_fac_aluno);
$objeto->matricula = limpadados($matricula);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->sexo = limpadados($sexo);
$objeto->data_nascimento = ajustadata(limpadados($data_nascimento),'banco');
$objeto->telefone = limpadados($telefone);
}else{
	$objeto = new fac_alunos();
	$objeto->id_fac_aluno = limpadados($id_fac_aluno);
	$objeto->matricula = limpadados($matricula);
	$objeto->senha = md5($senhanova);
}
$id = limpadados($id_fac_aluno);
$tg_mod_tabela = 'fac_alunos';
$tg_mod_tipo = 'Aluno';
$tg_mod_sexo = 'o';


require_once('_inc/action2.php');
?>