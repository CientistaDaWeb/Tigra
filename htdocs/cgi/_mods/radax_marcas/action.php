<?php
extract($_POST);
require_once('marcas.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new marcas();
$objeto->id_marca = limpadados($id_marca);
$objeto->marca = limpadados($marca);
$objeto->slug = limpadados(deixa_amigavel($marca));

if($_FILES['imagem']['size'] > 0) {
$upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        $pasta = '/home/weentigra/www/images/'.$dominio.'/marcas';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 130;
        $upload->image_y = 70;
        $upload->image_background_color = '#505050';

        $upload->process($pasta);
        $objeto->imagem = $upload->file_dst_name;
    }
}
$id = limpadados($id_marca);
$tg_mod_tabela = 'marcas';
$tg_mod_tipo = 'marca';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');