<?php
extract($_POST);
require_once('revestimentos.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new revestimentos();
$objeto->id_revestimento = limpadados($id_revestimento);
$ids = limpadados($ids_revestimentos);
$ids = explode(',', $ids);
$objeto->id_revestimentos_categoria = limpadados($ids[0]);
$objeto->id_revestimentos_subcategoria = limpadados($ids[1]);
$objeto->nome = limpadados($nome);
$objeto->referencia = limpadados($referencia);
$objeto->slug = deixa_amigavel($nome).'-'.deixa_amigavel($referencia);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/revestimentos';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 500;
        $upload->image_y = 500;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/revestimentos/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 130;
        $upload->image_y = 130;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_revestimento);
$tg_mod_tabela = 'revestimentos';
$tg_mod_tipo = 'revestimento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');