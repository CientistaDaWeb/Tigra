<?php
extract($_POST);
require_once("obras.php");
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new obras();
$objeto->id_obra = limpadados($id_obra);
$objeto->id_obras_categoria = limpadados($id_obras_categoria);
$objeto->nome = limpadados($nome);
$objeto->descricao = limpadados($descricao);
$objeto->participacao = limpadados($participacao);
$objeto->andamento = limpadados($andamento);
$objeto->slug = limpadados(deixa_amigavel($nome));
$objeto->ordem = limpadados($ordem);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
        if ($upload->uploaded) {

            $pasta = '/home/weentigra/www/images/'.$dominio.'/obras';
            $upload->image_resize = true;
            $upload->image_ratio = true;
            $upload->image_x = 670;
            $upload->image_y = 500;
            $upload->process($pasta);

            $pasta = '/home/weentigra/www/images/'.$dominio.'/obras/thumbs';
            $upload->image_resize = true;
            $upload->image_ratio_crop = true;
            $upload->image_x = 250;
            $upload->image_y = 180;
            $upload->process($pasta);

            if ($upload->processed) {
                $objeto->imagem = $upload->file_dst_name;
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