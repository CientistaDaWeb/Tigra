<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_obra = limpadados($id_obra);
$data = limpadados(ajustadata($data_video,'banco'));
$legenda = limpadados($legenda_video);
$duracao = limpadados($duracao);
$del_item = limpadados($del_item);

if($_FILES['video']['size'] > 0){
	$up = new upload($_FILES['video'],'all');
    $up->file_tmp_dir = '../../../tmp_up/';
    $up->cli_img_dir = '_videos/obras/';
    $up->send_file();
	
	$video = $up->img_db_name;
	$grava = $con->executa("INSERT INTO obras_videos (video, id_obra, data, legenda, duracao) VALUES ('$video', $id_obra, '$data', '$legenda', '$duracao')");
}
if($del_item){
    $apaga = $con->executa("DELETE FROM obras_videos WHERE id_obras_video IN ($del_item)");
}
$videos = $con->executa("SELECT * FROM obras_videos WHERE id_obra = $id_obra data DESC, id_obras_videos DESC");
if($videos && mysqli_num_rows($videos)>0){
	while($video = mysqli_fetch_assoc($videos)){
?>
	<div class="miniatura">
		<p><?=$video['video']?></p>
        <p><?=ajustadata($video['data'],'site')?></p>
        <p><?=$video['legenda']?></p>
        <p><?=$video['duracao']?></p>
		<p style="text-align:center"><a onclick="deleta_video(<?=$video['id_obras_video']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>Não tem videos cadastrados!</p>");
}
?>