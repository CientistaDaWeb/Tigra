<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$fk_evento = limpadados($fk_evento);
$legenda = limpadados($legenda);
$del_item = limpadados($del_item);

if($_FILES['foto']['size'] > 0){
	$up = new upload($_FILES['foto']);
	$up->file_tmp_dir = '../../../tmp_up/';
	
	$up->img_width = 300;
	$up->img_height = 400;
	$up->cli_img_dir = '_img/eventos/fotos/';
		
	$up->tmb_width = 95;
	$up->tmb_height = 71;
	$up->cli_tmb_dir = 'thumbs/';
	
	$up->img_resize(true, true);
	$foto = $up->img_db_name;
	$grava = $con->executa("INSERT INTO eventos_fotos (foto, fk_evento, legenda) VALUES ('$foto', $fk_evento, '$legenda')");
}

if($id_eventos_foto){
	$grava = $con->executa("UPDATE eventos_fotos SET legenda = '$legenda' WHERE id_eventos_foto = $id_eventos_foto");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM eventos_fotos WHERE id_eventos_foto IN ($del_item)");
	}
}
$fotos = $con->executa("SELECT * FROM eventos_fotos WHERE fk_evento = $fk_evento");
if($fotos && mysqli_num_rows($fotos)>0){
	while($foto = mysqli_fetch_assoc($fotos)){
?>
	<div class="miniatura">
		<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/eventos/fotos/thumbs/<?=$foto['foto']?>" /></p>
		<p><input type="text" class="inpute pqno" id="legenda[<?=$foto['id_eventos_foto']?>]" name="legenda[<?=$foto['id_eventos_foto']?>]" value="<?=$foto['legenda']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_eventos_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_eventos_foto']?>);" style="cursor:pointer">Editar</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>Não existem fotos cadastradas</p>");
}
?>