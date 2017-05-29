<?php
extract($_POST);
require_once 'imagens.php';
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new imagens();
$objeto->id_imagen = limpadados($id_imagen);
$objeto->legenda = limpadados($legenda);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/home';
        $upload->image_background_color = '#C4161C';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 450;
        $upload->image_y = 450;
        
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_imagen);
$tg_mod_tabela = 'imagens';
$tg_mod_tipo = 'imagem';
$tg_mod_sexo = 'o';


require_once('_inc/action2.php');