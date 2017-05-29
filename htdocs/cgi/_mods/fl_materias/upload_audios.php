<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload2.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_materia = limpadados($id_materia);
$titulo = limpadados($titulo);
$del_item = limpadados($del_item);

if($_FILES['audio']['size'] > 0){
	$up = new upload($_FILES['audio'],'all');
	$up->file_tmp_dir = '../../../tmp_up/';
	$up->cli_img_dir = '_audios/';
	
	$up->send_file();
		
	$audio = $up->img_db_name;
	
	$grava = $con->executa("INSERT INTO materias_audios (audio, id_materia, titulo) VALUES ('$audio', $id_materia, '$titulo')");
}

if($id_materias_audio){
	$grava = $con->executa("UPDATE materias_audios SET titulo = '$titulo' WHERE id_materias_audio = $id_materias_audio");
}else{
	if($del_item){
		$apaga = $con->executa("DELETE FROM materias_audios WHERE id_materias_audio IN ($del_item)");
	}
}
$audios = $con->executa("SELECT * FROM materias_audios WHERE id_materia = $id_materia");
if($audios && mysqli_num_rows($audios)>0){
	while($audio = mysqli_fetch_assoc($audios)){
?>
	<div class="miniatura">
		<p><a href="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_audios/<?=$audio['audio']?>" />Ouvir</a></p>
		<p><input type="text" class="inpute pqno" id="titulo[<?=$audio['id_materias_audio']?>]" name="titulo[<?=$audio['id_materias_audio']?>]" value="<?=$audio['titulo']?>" /></p>
		<p style="text-align:center"><a onclick="deleta_audio(<?=$audio['id_materias_audio']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_audio(<?=$audio['id_materias_audio']?>);" style="cursor:pointer">Editar</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>N&atilde;o tem audios cadastrados!</p>");
}
?>