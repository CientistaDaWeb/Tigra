<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_produto = limpadados($id_produto);
$del_item = limpadados($del_item);

if($_FILES['foto']['size'] > 0){
    $up = new upload($_FILES['foto']);

    $up->file_tmp_dir = '../../../tmp_up/';

	$up->cli_img_dir = '_img/galeria/';
    $up->img_width = 500;
	$up->img_height = 500;

    $up->cli_tmb_dir = 'thumbs/';
    $up->tmb_width = 138;
	$up->tmb_height = 138;

	$up->mode = FTP_BINARY;

	$up->img_resize(true, true);
	$foto = $up->img_db_name;
	$grava = $con->executa("INSERT INTO produtos_fotos (foto, id_produto) VALUES ('$foto', $id_produto)");
}

if($id_produtos_foto){
	$grava = $con->executa("UPDATE produtos_fotos SET legenda = '$legenda' WHERE id_produtos_foto = $id_produtos_foto");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM produtos_fotos WHERE id_produtos_foto IN ($del_item)");
	}
}
$fotos = $con->executa("SELECT * FROM produtos_fotos WHERE id_produto = $id_produto");
if($fotos && mysqli_num_rows($fotos)>0){
	while($foto = mysqli_fetch_assoc($fotos)){
?>
	<div class="miniatura">
		<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/galeria/thumbs/<?=$foto['foto']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_produtos_foto']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
}
?>