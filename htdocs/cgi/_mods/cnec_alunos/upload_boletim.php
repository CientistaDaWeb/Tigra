<?php

session_start();
$id_tg_cliente = $_POST['id_tg_cliente'];

require_once('../../_inc/function.php');
require_once('../../_classe/database.php');
require_once('../../_classe/database2.php');
require_once('../cnec_setores/setores.php');
$con = new database();
$con2 = new database2();
$query = 'SELECT * FROM tg_clientes WHERE id_tg_cliente =' . $id_tg_cliente;
$cliente = $con->query($query);
$cliente = mysqli_fetch_assoc($cliente);
$dominio = decripfy($cliente['dominio'], 'h0s7');

extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
require_once('../../_classe/class.upload.php');
$setor = $_POST['setor'];
if ($_FILES['arquivo']['size'] > 0) {
    foreach ($_FILES AS $ARQUIVO) {
        $upload = new upload($ARQUIVO);
        if ($upload->uploaded) {
            $pasta = '/home/serverws/public_html/docs/' . $dominio . '/boletim/' . $setor;
            $upload->file_new_name_body = 'boletim';
            $upload->file_overwrite = true;
            $upload->file_new_name_ext = 'csv';

            $upload->process($pasta);

            if ($upload->processed) {
                $upload->clean();
                $setores = new setors();
                $setores->buscaPorSlug($setor);

                $arquivo = realpath($pasta . '/boletim.csv');
                if (is_file($arquivo)) {
                    $fp = fopen($arquivo, "r");
                    $query = 'DELETE FROM historico WHERE id_setor = ' . $setores->id_setor;
                    $con2->query($query);
                    while (($dados = fgetcsv($fp, 0, ";")) !== FALSE) {
                        $data = NULL;
                        $data['matricula'] = utf8_encode($dados[0]);
                        $data['codigo'] = utf8_encode($dados[2]);
                        $data['disciplina'] = utf8_encode($dados[3]);
                        $data['semestre'] = utf8_encode($dados[6]);
                        $data['carga'] = utf8_encode($dados[7]);
                        $data['creditos'] = utf8_encode($dados[8]);
                        $data['nota'] = utf8_encode($dados[10]);
                        $data['situacao'] = utf8_encode($dados[9]);
                        $query = 'INSERT INTO historico VALUES("","' . $setores->id_setor . '", "' . $data['matricula'] . '",
                                "' . $data['codigo'] . '", "' . $data['disciplina'] . '", "' . $data['semestre'] . '",
                                "' . $data['carga'] . '", "' . $data['creditos'] . '", "' . $data['nota'] . '", "' . $data['situacao'] . '")';
                        $con2->query($query);
                    }
                    fclose($fp);
                }
                echo 'Boletim enviado';
            } else {
                echo 'error : ' . $upload->error;
            }
        }
    }
}
?>