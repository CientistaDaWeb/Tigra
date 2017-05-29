<?php
session_start();
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$action = $_POST['action'];
$id_linha = $_POST['id_linha'];
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
        $query = 'UPDATE linhas_ambientes SET legenda = "'.$legenda.'" WHERE id_linhas_ambiente = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT imagem FROM linhas_ambientes WHERE id_linhas_ambiente = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0) {
            $retorno = $retorno->fetch_assoc();
            unlink('/home/weentigra/www/images/'.$dominio.'/ambientes/'.$retorno['imagem']);
            unlink('/home/weentigra/www/images/'.$dominio.'/ambientes/thumbs/'.$retorno['imagem']);
        }
        $query = 'DELETE FROM linhas_ambientes WHERE id_linhas_ambiente = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os ambientes*/
    $query = 'SELECT * FROM linhas_ambientes WHERE id_linha = '.$id_linha.' ORDER BY id_linhas_ambiente DESC LIMIT '.$inicio.','.$qtd;
    $ambientes = $con->query($query);
    if($ambientes && $ambientes->num_rows > 0) {
        while($ambiente = $ambientes->fetch_assoc()) {
            ?>
<div class="box">
    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/ambientes/thumbs/<?=$ambiente['imagem']?>" />
    <input type="text" name="legenda" class="legenda" value="<?=$ambiente['legenda']?>" />
    <a class="btEditar" onclick="editarAmbiente(this, <?=$ambiente['id_linhas_ambiente']?>)">Editar</a> | <a class="btExcluir" onclick="excluirAmbiente(<?=$ambiente['id_linhas_ambiente']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem ambientes cadastrados!</p>';
    }
}
$sql = 'SELECT count(id_linhas_ambiente) as total FROM linhas_ambientes WHERE id_linha = '.$id_linha;
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
    <a href="#" onclick="javascript:pegaAmbientes(<?php echo $i; ?>)"><?php echo $i; ?></a>
    <?php
    }
    ?>
</div>
    <?php
}