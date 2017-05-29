<?php
$status = '0';
extract($_POST);
require_once('produtos.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome = limpadados($nome);
$objeto->referencia = limpadados($referencia);
$objeto->imagem = limpadados($imagem);
$objeto->slug = deixa_amigavel(limpadados($nome));
$objeto->status = limpadados($status);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 600;
        $upload->image_y = 400;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 150;
        $upload->image_y = 100;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');