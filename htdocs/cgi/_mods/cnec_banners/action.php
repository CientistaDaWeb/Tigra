<?php
extract($_POST);
require_once('banners.php');
require_once('_classe/class.upload.php');

$dominio = decripfy($_SESSION['dominio'],'h0s7');

$objeto = new banners();
$objeto->id_banner = limpadados($id_banner);
$objeto->id_setor = limpadados($id_setor);
$objeto->titulo = limpadados($titulo);
$objeto->largura = limpadados($largura);
$objeto->altura = limpadados($altura);
$objeto->transparente = limpadados($transparente);
$objeto->slug = limpadados(deixa_amigavel($titulo));

if($_FILES['banner']['size'] > 0) {
$upload = new upload($_FILES['banner']);
    if ($upload->uploaded) {
        $pasta = '/home/weentigra/www/docs/'.$dominio.'/banners';
        $upload->process($pasta);
        $objeto->banner = $upload->file_dst_name;
    }
}
$id = limpadados($id_banner);
$tg_mod_tabela = 'banners';
$tg_mod_tipo = 'Banner';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');