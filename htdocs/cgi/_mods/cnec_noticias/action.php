<?php
extract($_POST);
require_once('noticias.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new noticias();
$objeto->id_noticia = limpadados($id_noticia);
$objeto->id_noticias_categoria = limpadados($id_noticias_categoria);
$objeto->id_setor = limpadados($id_setor);
$objeto->titulo = limpadados($titulo);
$objeto->texto = limpadados($texto);
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->destaque = limpadados($destaque);
$objeto->slug = limpadados(deixa_amigavel($titulo));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/noticias';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 600;
        $upload->image_y = 600;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/noticias/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 120;
        $upload->image_y = 120;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_noticia);
$tg_mod_tabela = 'noticias';
$tg_mod_tipo = 'Notícia';
$tg_mod_sexo = 'a';

$_SESSION['tg_debug'] = false;

require_once('_inc/action2.php');