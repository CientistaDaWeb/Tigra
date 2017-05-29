<?php
extract($_POST);
require_once('produtos.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome = limpadados($nome);
$objeto->referencia = limpadados($referencia);
$objeto->dimensao = limpadados($dimensao);
$objeto->imagem = limpadados($imagem);
$objeto->slug = deixa_amigavel(limpadados($nome));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 500;
        $upload->image_y = 500;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 120;
        $upload->image_y = 120;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');