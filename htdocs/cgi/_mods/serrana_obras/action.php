<?php
$destaque = '0';
$lancamento = '0';
$concluido = '0';
extract($_POST);
require_once("obras.php");
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new obras();
$objeto->id_obra = limpadados($id_obra);
$objeto->nome = limpadados($nome);
$objeto->descricao = limpadados($descricao);
$objeto->longitude = limpadados($longitude);
$objeto->latitude = limpadados($latitude);
$objeto->endereco = limpadados($endereco);
$objeto->lancamento = limpadados($lancamento);
$objeto->destaque = limpadados($destaque);
$objeto->descricao_destaque = limpadados($descricao_destaque);
$objeto->concluido = limpadados($concluido);
$objeto->slug = limpadados(deixa_amigavel($nome));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {

        $pasta = '/home/weentigra/www/images/'.$dominio.'/obras';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 330;
        $upload->image_y = 290;
        $upload->process($pasta);

        $pasta = '/home/weentigra/www/images/'.$dominio.'/obras/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 120;
        $upload->image_y = 120;
        $upload->process($pasta);

        if ($upload->processed) {
            $objeto->imagem = $upload->file_dst_name;
        } else {
            echo 'error : ' . $upload->error;
        }
    }
}
if($_FILES['pdf']['size'] > 0) {
    $upload = new upload($_FILES['pdf']);
    if ($upload->uploaded) {
        $pasta = '/home/weentigra/www/docs/'.$dominio.'/obras';

        $upload->process($pasta);
        $arquivo = $upload->file_dst_name;

        if ($upload->processed) {
            $objeto->pdf = $upload->file_dst_name;
        } else {
            echo 'error : ' . $upload->error;
        }
    }
}
$id = limpadados($id_obra);
$tg_mod_tabela = 'obras';
$tg_mod_tipo = 'Obra';
$tg_mod_sexo = 'a';

require_once('_inc/action2.php');