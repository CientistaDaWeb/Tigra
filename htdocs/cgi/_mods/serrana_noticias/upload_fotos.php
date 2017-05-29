<?php
session_start();
$id_tg_cliente = $_POST['id_tg_cliente'];

require_once('../../_inc/function.php');
require_once('../../_classe/database.php');

$con = new database();
$query = 'SELECT * FROM tg_clientes WHERE id_tg_cliente ='. $id_tg_cliente;
$cliente = $con->query($query);
$cliente = mysqli_fetch_assoc($cliente);
$dominio = decripfy($cliente['dominio'],'h0s7');

$_SESSION['db_host'] = $cliente['db_host'];
$_SESSION['db_user'] = $cliente['db_user'];
$_SESSION['db_pass'] = $cliente['db_pass'];
$_SESSION['db_dbname'] = $cliente['db_dbname'];

require_once('../../_classe/class.upload.php');
require_once('../../_classe/database2.php');

$con = new database2();
$id_noticia = $_POST['id_noticia'];
$legenda = $_POST['legenda'];

if(!empty($_FILES)) {
    foreach($_FILES AS $ARQUIVO) {
        $upload = new upload($ARQUIVO);
        if ($upload->uploaded) {

            $pasta = '/home/weentigra/www/images/'.$dominio.'/noticias/galeria';
            $upload->image_resize = true;
            $upload->image_ratio = true;
            $upload->image_x = 600;
            $upload->image_y = 600;
            $upload->process($pasta);

            $pasta = '/home/weentigra/www/images/'.$dominio.'/noticias/galeria/thumbs';
            $upload->image_resize = true;
            $upload->image_ratio_crop = true;
            $upload->image_x = 120;
            $upload->image_y = 120;
            $upload->process($pasta);
            $imagem = $upload->file_dst_name;

            $query = 'INSERT INTO noticias_fotos (id_noticia, imagem, legenda) VALUES ('.$id_noticia.',"'.$imagem.'", "'.$legenda.'")';
            $con->query($query);
            if ($upload->processed) {
                echo '1';
                $upload->clean();
            } else {
                echo 'error : ' . $upload->error;
            }
        }
    }
}