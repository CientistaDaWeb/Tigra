<?php
extract($_POST);
require_once('produtos.php');
require_once('_classe/upload.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome_pt = limpadados($nome_pt);
$objeto->caracteristicas_pt = limpadados($caracteristicas_pt);
$objeto->detalhes_pt = limpadados($detalhes_pt);
$objeto->slug_pt = limpadados(deixa_amigavel($nome_pt));
$objeto->nome_en = limpadados($nome_en);
$objeto->caracteristicas_en = limpadados($caracteristicas_en);
$objeto->detalhes_en = limpadados($detalhes_en);
$objeto->slug_en = limpadados(deixa_amigavel($nome_en));
$objeto->nome_es = limpadados($nome_es);
$objeto->caracteristicas_es = limpadados($caracteristicas_es);
$objeto->detalhes_es = limpadados($detalhes_es);
$objeto->slug_es = limpadados(deixa_amigavel($nome_es));
$objeto->codigo_vinhovirtual = limpadados($codigo_vinhovirtual);
$objeto->ano = limpadados($ano);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->img_width = 400;
	$up->img_height = 400;
	
	$up->cli_img_dir = '_img/produtos/';
	
	$up->tmb_width = 150;
	$up->tmb_height = 250;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$query = 'DELETE FROM produtos_embalagens WHERE id_produto = '.$id_produto;
$limpa = $con_cliente->query($query);

foreach($emb AS $chave=>$id_embalagem){
	$query = 'INSERT INTO produtos_embalagens (id_embalagen, id_produto, preco) VALUES ('.$id_embalagem.', '.$id_produto.', "'.$preco[$id_embalagem].'")';
	$insere = $con_cliente->query($query);
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>