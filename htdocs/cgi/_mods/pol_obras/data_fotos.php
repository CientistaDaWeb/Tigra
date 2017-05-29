<?php
session_start();
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$action = $_POST['action'];
$id_obra = $_POST['id_obra'];
$pagina = $_POST['pagina'];
$qtd = 20;
$inicio = ($pagina-1)*$qtd;
if($inicio < 0){
    $inicio = 0;
}
if($action) {
    $id = $_POST['id'];
    $legenda = $_POST['legenda'];
    $data = ajustadata($_POST['data'],'banco');

    if($action == 'edit') {
        $query = 'UPDATE obras_fotos SET legenda = "'.$legenda.'", data = "'.$data.'" WHERE id_obras_foto = '.$id;
        $con->query($query);
    }

    if($action == 'del') {
        $dominio = decripfy($_SESSION['dominio'],'h0s7');
        $query = 'SELECT foto FROM obras_fotos WHERE id_obras_foto = '.$id;
        $retorno = $con->query($query);
        if($retorno && $retorno->num_rows > 0) {
            $retorno = $retorno->fetch_assoc();
            unlink('/home/weentigra/www/images/'.$dominio.'/obras/galeria/'.$retorno['foto']);
            unlink('/home/weentigra/www/images/'.$dominio.'/obras/galeria/thumbs/'.$retorno['foto']);
        }
        $query = 'DELETE FROM obras_fotos WHERE id_obras_foto = '.$id;
        $con->query($query);
    }
}else {
    /*Pega os fotos*/
    $query = 'SELECT *, date_format(data,"%d/%m/%Y") as dataFormatada FROM obras_fotos WHERE id_obra = '.$id_obra.' ORDER BY data DESC, id_obras_foto DESC LIMIT '.$inicio.','.$qtd;
    $fotos = $con->query($query);
    if($fotos && $fotos->num_rows > 0) {
        while($foto = $fotos->fetch_assoc()) {
            ?>
<div class="box">
    <img src="http://images.weentigra.com.br/<?=decripfy($_SESSION['dominio'],"h0s7")?>/obras/galeria/thumbs/<?=$foto['foto']?>" />
    <input type="text" name="legenda" class="legenda" value="<?=$foto['legenda']?>" />
    <input type="text" name="data" class="data" value="<?=$foto['dataFormatada']?>" />
    <a class="btEditar" onclick="editarImagem(this, <?=$foto['id_obras_foto']?>)">Editar</a> | <a class="btExcluir" onclick="excluirImagem(<?=$foto['id_obras_foto']?>)">Excluir</a>
</div>
            <?php
        }
    }else {
        echo '<p>Não tem fotos cadastradas!</p>';
    }
}
$sql = 'SELECT count(id_obras_foto) as total FROM obras_fotos WHERE id_obra = '.$id_obra;
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
?>
<script>
    $(".data").datePicker({
        startDate: '01/01/2000',
        displayClose : true,
        clickInput : true
    });
</script>