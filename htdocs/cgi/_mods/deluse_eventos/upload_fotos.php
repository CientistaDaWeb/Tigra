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
$id_evento = $_POST['id_evento'];

if(!empty($_FILES)) {
    foreach($_FILES AS $ARQUIVO) {
        $upload = new upload($ARQUIVO);
        if ($upload->uploaded) {

            $pasta = '/home/weentigra/www/images/'.$dominio.'/eventos/galeria';
            $upload->image_resize = true;
            $upload->image_ratio = true;
            $upload->image_x = 500;
            $upload->image_y = 500;
            $upload->process($pasta);

            $pasta = '/home/weentigra/www/images/'.$dominio.'/eventos/galeria/thumbs';
            $upload->image_resize = true;
            $upload->image_ratio_fill = true;
            $upload->image_x = 120;
            $upload->image_y = 120;
            $upload->process($pasta);
            $imagem = $upload->file_dst_name;

            $query = 'INSERT INTO eventos_fotos (id_evento, imagem, legenda) VALUES ('.$id_evento.',"'.$imagem.'", "'.substr($imagem,0,-4).'")';
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
?>