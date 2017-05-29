<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_materia = limpadados($id_materia);
$legenda = limpadados($legenda);
$del_item = limpadados($del_item);

if($_FILES['foto']['size'] > 0){
	$up = new upload($_FILES['foto']);
	$up->file_tmp_dir = '../../../tmp_up/';
	
	$up->img_width = 450;
	$up->img_height = 600;
	$up->cli_img_dir = '_img/materias/galeria/';
		
	$up->tmb_width = 90;
	$up->tmb_height = 120;
	$up->cli_tmb_dir = 'thumbs/';
	
	$up->img_resize(true, true);
	$foto = $up->img_db_name;
	$grava = $con->executa("INSERT INTO materias_fotos (foto, id_materia, legenda) VALUES ('$foto', $id_materia, '$legenda')");
}

if($id_materias_foto){
	$grava = $con->executa("UPDATE materias_fotos SET legenda = '$legenda' WHERE id_materias_foto = $id_materias_foto");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM materias_fotos WHERE id_materias_foto IN ($del_item)");
	}
}
$fotos = $con->executa("SELECT * FROM materias_fotos WHERE id_materia = $id_materia");
if($fotos && mysqli_num_rows($fotos)>0){
	while($foto = mysqli_fetch_assoc($fotos)){
?>
	<div class="miniatura">
		<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/materias/galeria/thumbs/<?=$foto['foto']?>" /></p>
		<p><input type="text" class="inpute pqno" id="legenda[<?=$foto['id_materias_foto']?>]" name="legenda[<?=$foto['id_materias_foto']?>]" value="<?=$foto['legenda']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_materias_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_materias_foto']?>);" style="cursor:pointer">Editar</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
}
?>