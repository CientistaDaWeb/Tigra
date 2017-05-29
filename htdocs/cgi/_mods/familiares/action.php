<?php
extract($_POST);
require_once("$tg_mod.php");
require_once('_classe/upload.php');

$objeto = new familiares();
$fam->id_familiare = limpadados($id_familiare);
$objeto->fk_pai = limpadados($fk_pai);
$objeto->nome = limpadados($nome);
$objeto->data_nascimento = ajustadata(limpadados($data_nascimento),"banco");
$objeto->data_falecimento = ajustadata(limpadados($data_falecimento),"banco");
$objeto->conjuge = limpadados($conjuge);
$objeto->conj_data_nascimento = ajustadata(limpadados($conj_data_nascimento),"banco");
$objeto->conj_data_falecimento = ajustadata(limpadados($conj_data_falecimento),"banco");
$objeto->endereco = limpadados($endereco);
$objeto->cidade = limpadados($cidade);
$objeto->cep = limpadados($cep);
$objeto->estado = limpadados($estado);
$objeto->email = limpadados($email);
$objeto->telefone = limpadados($telefone);
$objeto->profissao = limpadados($profissao);
$objeto->chefe = limpadados($chefe);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 130;
	$up->img_height = 160;
	$up->cli_img_dir = '_img/familiares/';

	$up->img_resize(true,false);
	$objeto->imagem = $up->img_db_name;
}
if($_FILES['imagem_conjuge']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 130;
	$up->img_height = 160;
	$up->cli_img_dir = '_img/familiares/conjuge';

	$up->img_resize(true,false);
	$objeto->imagem_conjuge = $up->img_db_name;
}

$id = limpadados($id_familiare);
$tg_mod_tabela = 'familiares';
$tg_mod_tipo = 'Familiar';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>