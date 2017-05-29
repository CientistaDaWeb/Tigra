<?php
extract($_POST);

require_once('produtos.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_subcategoria = limpadados($id_produtos_subcategoria);
$objeto->nome = limpadados($nome);
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($nome));


if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos';
        $upload->image_resize = true;
        $upload->image_border = 10;
        $upload->image_border_color = '#FFFFFF';
        $upload->image_ratio_fill = true;
        $upload->image_x = 430;
        $upload->image_y = 430;
        $upload->process($pasta);
        
        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/produtos/thumbs';
        $upload->image_resize = true;
        $upload->image_border = 5;
        $upload->image_border_color = '#FFFFFF';
        $upload->image_ratio_fill = true;
        $upload->image_x = 120;
        $upload->image_y = 120;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
        $upload->clean();
    }
}


$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');