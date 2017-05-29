<?php
session_start();
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$action = $_POST['action'];
$id_noticia = $_POST['id_noticia'];
$pagina = $_POST['pagina'];
$qtd = 20;
$inicio = ($pagina-1)*$qtd;
if($inicio < 0){
    $inicio = 0;
}
if($action) {
    $id = $_POST['id'];
    $legenda = $_POST['legenda'];

    if($action == 'edit') {
        $query = 'UPDATE noticias_fotos SET legenda = "'.$legenda.'" WHERE id_noticias_foto = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT imagem FROM noticias_fotos WHERE id_noticias_foto = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0) {
            $retorno = $retorno->fetch_assoc();
            unlink('/home/weentigra/www/images/'.$dominio.'/noticias/galeria/'.$retorno['imagem']);
            unlink('/home/weentigra/www/images/'.$dominio.'/noticias/galeria/thumbs/'.$retorno['imagem']);
        }
        $query = 'DELETE FROM noticias_fotos WHERE id_noticias_foto = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os fotos*/
    $query = 'SELECT * FROM noticias_fotos WHERE id_noticia = '.$id_noticia.' ORDER BY id_noticias_foto DESC LIMIT '.$inicio.','.$qtd;
    $fotos = $con->query($query);
    if($fotos && $fotos->num_rows > 0) {
        while($foto = $fotos->fetch_assoc()) {
            ?>
<div class="box">
    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/noticias/galeria/thumbs/<?=$foto['imagem']?>" />
    <input type="text" name="legenda" class="legenda" value="<?=$foto['legenda']?>" />
    <a class="btEditar" onclick="editarImagem(this, <?=$foto['id_noticias_foto']?>)">Editar</a> | <a class="btExcluir" onclick="excluirImagem(<?=$foto['id_noticias_foto']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem fotos cadastradas!</p>';
    }
}
$sql = 'SELECT count(id_noticias_foto) as total FROM noticias_fotos WHERE id_noticia = '.$id_noticia;
$query = $con->query($sql);
if($query && $query->num_rows>0){
    $query = $query->fetch_assoc();
    $total = $query['total'];
    $paginas = ceil($total/$qtd);
    ?>
<div class="paginacao">
    <p>Páginas</p>
    <?php
    for($i=1;$i<=$paginas;$i++){
    ?>
    <a href="#" onclick="javascript:pegaImagens(<?php echo $i; ?>)"><?php echo $i; ?></a>
    <?php
    }
    ?>
</div>
    <?php
}