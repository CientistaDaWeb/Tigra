<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_noticia = limpadados($id_noticia);
$del_item = limpadados($del_item);

if($_FILES['foto']['size'] > 0){
	$up = new upload($_FILES['foto']);
	$up->file_tmp_dir = '../../../tmp_up/';
	
	$up->img_width = 600;
	$up->img_height = 600;
	$up->cli_img_dir = '_img/noticias/galeria/';
		
	$up->tmb_width = 120;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	
	$up->img_resize(true, true);
	$foto = $up->img_db_name;
	$grava = $con->executa("INSERT INTO noticias_fotos (foto, id_noticia) VALUES ('$foto', $id_noticia)");
}

if($id_noticias_foto){
	$grava = $con->executa("UPDATE noticias_fotos SET legenda = '$legenda' WHERE id_noticias_foto = $id_noticias_foto");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM noticias_fotos WHERE id_noticias_foto IN ($del_item)");
	}
}
$fotos = $con->executa("SELECT * FROM noticias_fotos WHERE id_noticia = $id_noticia");
if($fotos && mysqli_num_rows($fotos)>0){
	while($foto = mysqli_fetch_assoc($fotos)){
?>
	<div class="miniatura">
		<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/noticias/galeria/thumbs/<?=$foto['foto']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_noticias_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_noticias_foto']?>);" style="cursor:pointer">Editar</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
}
?>