<?php
extract($_POST);
require_once('servicos_categorias.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new servicos_categorias();
$objeto->id_servicos_categoria = limpadados($id_servicos_categoria);
$objeto->categoria = limpadados($categoria);
$objeto->slug = limpadados(deixa_amigavel($categoria));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {

        $pasta = '/home/weentigra/www/images/'.$dominio.'/servicos_categorias';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 250;
        $upload->image_y = 250;
        $upload->process($pasta);

        $pasta = '/home/weentigra/www/images/'.$dominio.'/servicos_categorias/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 160;
        $upload->image_y = 130;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_servicos_categoria);
$tg_mod_tabela = 'servicos_categorias';
$tg_mod_tipo = 'categoria';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');