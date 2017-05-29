<?php
session_start();
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$action = $_POST['action'];
$id_noticia = $_POST['id_noticia'];
if($action) {
    $id = $_POST['id'];
    $legenda = $_POST['legenda'];

    if($action == 'edit') {
        $query = 'UPDATE noticias_arquivos SET legenda = "'.$legenda.'" WHERE id_noticias_arquivo = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT arquivo FROM noticias_arquivos WHERE id_noticias_arquivo = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0) {
            $retorno = $retorno->fetch_assoc();
            unlink('/home/weentigra/www/docs/'.$dominio.'/noticias/'.$retorno['arquivo']);
        }
        $query = 'DELETE FROM noticias_arquivos WHERE id_noticias_arquivo = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os arquivos*/
    $query = 'SELECT * FROM noticias_arquivos WHERE id_noticia = '.$id_noticia;
    $arquivos = $con->query($query);
    if($arquivos && $arquivos->num_rows > 0) {
        while($arquivo = $arquivos->fetch_assoc()) {
            ?>
<div class="box">
    <a href="http://docs.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/noticias/<?=$arquivo['arquivo']?>" target="_blank"><?=$arquivo['arquivo']?></a>
    <input type="text" name="legenda" id="legenda" value="<?=$arquivo['legenda']?>" />
    <a class="btEditar" onclick="editarArquivo(this, <?=$arquivo['id_noticias_arquivo']?>)">Editar</a> | <a class="btExcluir" onclick="excluirArquivo(<?=$arquivo['id_noticias_arquivo']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem arquivos cadastrados!</p>';
    }
}
?>
