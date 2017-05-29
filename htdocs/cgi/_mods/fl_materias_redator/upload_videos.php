<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_materia = limpadados($id_materia);
$video = limpadados($video);
$video_server = limpadados($video_server);

$del_item = limpadados($del_item);

if($_FILES['imagem']['size'] > 0){
	$up = new upload($_FILES['imagem']);
	$up->file_tmp_dir = '../../../tmp_up/';
	
	$up->img_width = 120;
	$up->img_height = 90;
	$up->cli_img_dir = '_img/materias/videos/';
	$up->img_resize(true);
	
	$imagem = $up->img_db_name;
	$grava = $con->executa("INSERT INTO materias_videos (video, id_materia, titulo, imagem, video_server) VALUES ('$video', $id_materia, '$titulo', '$imagem', '$video_server')");
}

if($id_materias_video){
	$grava = $con->executa("UPDATE materias_videos SET titulo = '$titulo' WHERE id_materias_video = $id_materias_video");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM materias_videos WHERE id_materias_video IN ($del_item)");
	}
}
$videos = $con->executa("SELECT * FROM materias_videos WHERE id_materia = $id_materia");
if($videos && mysqli_num_rows($videos)>0){
	while($video = mysqli_fetch_assoc($videos)){
?>
	<div class="miniatura">
		<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/materias/videos/<?=$video['imagem']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_video(<?=$video['id_materias_video']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>N&atilde;o tem v&iacute;deos cadastrados!</p>");
}
?>