<?php
extract($_POST);
require_once 'eventos.php';
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new eventos();
$objeto->id_evento = limpadados($id_evento);
$objeto->evento = limpadados($evento);
$objeto->local = limpadados($local);

$objeto->descricao = limpadados($descricao);
$objeto->slug = deixa_amigavel($evento);

$data = explode('/', $data);
$objeto->data = limpadados($data[2].'-'.$data[1].'-'.$data[0]);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/eventos';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 400;
        $upload->image_y = 400;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/eventos/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 130;
        $upload->image_y = 130;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_evento);
$tg_mod_tabela = 'eventos';
$tg_mod_tipo = 'Evento';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');