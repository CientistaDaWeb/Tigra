<?php
extract($_POST);
require_once('servicos.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new servicos();
$objeto->id_servico = limpadados($id_servico);
$objeto->id_servicos_categoria = limpadados($id_servicos_categoria);
$objeto->servico = limpadados($servico);
$objeto->descricao = limpadados($descricao);
$objeto->slug = limpadados(deixa_amigavel($servico));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {

        $pasta = '/home/weentigra/www/images/'.$dominio.'/servicos';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 250;
        $upload->image_y = 250;
        $upload->process($pasta);

        $pasta = '/home/weentigra/www/images/'.$dominio.'/servicos/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 130;
        $upload->image_y = 130;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_servico);
$tg_mod_tabela = 'servicos';
$tg_mod_tipo = 'servico';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');