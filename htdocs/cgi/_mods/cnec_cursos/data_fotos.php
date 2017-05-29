<?php
session_start();
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$action = $_POST['action'];
$id_curso = $_POST['id_curso'];
if($action) {
    $id = $_POST['id'];
    $legenda = $_POST['legenda'];

    if($action == 'edit') {
        $query = 'UPDATE cursos_fotos SET legenda = "'.$legenda.'" WHERE id_cursos_foto = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT imagem FROM cursos_fotos WHERE id_cursos_foto = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0){
            $retorno = $retorno->fetch_assoc();
               unlink('/home/weentigra/www/images/'.$dominio.'/cursos/galeria/'.$retorno['imagem']);
               unlink('/home/weentigra/www/images/'.$dominio.'/cursos/galeria/thumbs/'.$retorno['imagem']);
        }
        $query = 'DELETE FROM cursos_fotos WHERE id_cursos_foto = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os fotos*/
    $query = 'SELECT * FROM cursos_fotos WHERE id_curso = '.$id_curso;
    $fotos = $con->query($query);
    if($fotos && $fotos->num_rows > 0) {
        while($foto = $fotos->fetch_assoc()) {
            ?>
<div class="box">
    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/cursos/galeria/thumbs/<?=$foto['imagem']?>" />
    <input type="text" name="legenda" id="legenda" value="<?=$foto['legenda']?>" />
    <a class="btEditar" onclick="editarImagem(this, <?=$foto['id_cursos_foto']?>)">Editar</a> | <a class="btExcluir" onclick="excluirImagem(<?=$foto['id_cursos_foto']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem fotos cadastradas!</p>';
    }
}
?>