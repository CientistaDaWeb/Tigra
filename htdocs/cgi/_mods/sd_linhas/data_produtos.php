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
        $query = 'UPDATE linhas_produtos SET legenda = "'.$legenda.'" WHERE id_linhas_produto = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT imagem FROM linhas_produtos WHERE id_linhas_produto = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0) {
            $retorno = $retorno->fetch_assoc();
            unlink('/home/weentigra/www/images/'.$dominio.'/produtos/'.$retorno['imagem']);
            unlink('/home/weentigra/www/images/'.$dominio.'/produtos/thumbs/'.$retorno['imagem']);
        }
        $query = 'DELETE FROM linhas_produtos WHERE id_linhas_produto = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os produtos*/
    $query = 'SELECT * FROM linhas_produtos WHERE id_linha = '.$id_linha.' ORDER BY id_linhas_produto DESC LIMIT '.$inicio.','.$qtd;
    $produtos = $con->query($query);
    if($produtos && $produtos->num_rows > 0) {
        while($produto = $produtos->fetch_assoc()) {
            ?>
<div class="box">
    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/produtos/thumbs/<?=$produto['imagem']?>" />
    <input type="text" name="legenda" class="legenda" value="<?=$produto['legenda']?>" />
    <a class="btEditar" onclick="editarProdutos(this, <?=$produto['id_linhas_produto']?>)">Editar</a> | <a class="btExcluir" onclick="excluirProdutos(<?=$produto['id_linhas_produto']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem produtos cadastrados!</p>';
    }
}
$sql = 'SELECT count(id_linhas_produto) as total FROM linhas_produtos WHERE id_linha = '.$id_linha;
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
    <a href="#" onclick="javascript:pegaProdutos(<?php echo $i; ?>)"><?php echo $i; ?></a>
    <?php
    }
    ?>
</div>
    <?php
}