<?php
extract($_POST);
require_once('produtos.php');
require_once('_classe/upload.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_marca = limpadados($id_marca);
$objeto->id_categorias_produto = limpadados($id_categorias_produto);
$objeto->codigo = limpadados($codigo);
$objeto->produto = limpadados($produto);
$objeto->preco = limpadados($preco);
$objeto->peca = limpadados($peca);
$objeto->destaque = limpadados($destaque);
$objeto->descricao = limpadados($descricao);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->cli_img_dir = '_img/produtos/';
    $up->img_width = 500;
	$up->img_height = 500;

    $up->cli_tmb_dir = 'thumbs/';
    $up->tmb_width = 138;
	$up->tmb_height = 138;

	$up->mode = FTP_BINARY;
    
	$up->img_resize(true, true);
	$objeto->imagem = $up->img_db_name;
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'produto';
$tg_mod_sexo = 'o';
require_once('_inc/action2.php');

if($id_produto){
	$query = 'DELETE FROM produtos_caracteristicas WHERE id_produto = '.$id_produto;
    $deleta_caracteristicas = $con_cliente->query($query);

    $query = 'DELETE FROM produtos_opcoes WHERE id_produto = '.$id_produto;
    $deleta_opcoes = $con_cliente->query($query);

    foreach($caracteristicas as $caracteristica){
        $query = 'INSERT INTO produtos_caracteristicas (id_produto, id_caracteristicas_categoria) VALUES ('.$id_produto.', '.$caracteristica.')';
        $insere_caracteristica = $con_cliente->query($query);
    }
    foreach($opcoes as $opcoe){
        $query = 'INSERT INTO produtos_opcoes (id_produto, id_opcoes_caracteristica) VALUES ('.$id_produto.', '.$opcoe.')';
        $insere_opcoe = $con_cliente->query($query);
    }
}
?>