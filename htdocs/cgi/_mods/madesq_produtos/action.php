<?php
extract($_POST);
    $query = "DELETE FROM produtos_revestimentos WHERE id_produto = $id_produto";
    $revestimentos = $con_cliente->query($query);

foreach($_POST['revestimento'] as $rev) {
    $query = "INSERT INTO produtos_revestimentos (id_produto, id_revestimento) VALUES ('$id_produto','$rev')";
    $revestimentos = $con_cliente->query($query);
}

require_once('produtos.php');
require_once('_classe/upload3.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome = limpadados($nome);
$objeto->referencia = limpadados($referencia);
$objeto->descricao = limpadados($descricao);
$objeto->slug = deixa_amigavel($nome).'-'.deixa_amigavel($referencia);

if($_FILES['imagem_1']['size'] > 0) {
    $up = new upload($_FILES['imagem_1']);
    $up->img_width = 500;
    $up->img_height = 500;

    $up->cli_img_dir = 'img/produtos/';

    $up->mode = FTP_BINARY;

    $up->tmb_width = 120;
    $up->tmb_height = 120;
    $up->cli_tmb_dir = 'thumbs/';
    $up->img_resize(true, true);
    $objeto->imagem_1 = $up->img_db_name;
}
if($_FILES['imagem_2']['size'] > 0) {
    $up2 = new upload($_FILES['imagem_2']);
    $up2->img_width = 500;
    $up2->img_height = 500;

    $up2->cli_img_dir = 'img/produtos/';

    $up2->mode = FTP_BINARY;

    $up2->tmb_width = 120;
    $up2->tmb_height = 120;
    $up2->cli_tmb_dir = 'thumbs/';
    $up2->img_resize(true, true);
    $objeto->imagem_2 = $up2->img_db_name;
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>


