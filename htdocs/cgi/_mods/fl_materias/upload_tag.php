<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_materia = limpadados($id_materia);
$id_tag = limpadados($id_tag);
$acao = limpadados($acao);
$tag = limpadados($tag);

if($acao == 'adicionar'){
	$con->executa("INSERT INTO tag_materias (id_materia, id_tag) VALUES ($id_materia, $id_tag)");
}

if($acao == 'remover'){
	$con->executa("DELETE FROM tag_materias WHERE id_materia = $id_materia AND id_tag = $id_tag");
}

if($tag){
	$con->executa("INSERT INTO tags (tag) VALUES ('$tag')");
	$idtag = $con->executa("SELECT id_tag FROM tags WHERE tag = '$tag' ORDER BY id_tag DESC LIMIT 0,1 ");
	if($idtag && mysqli_num_rows($idtag)>0){
		$idtag = mysqli_fetch_assoc($idtag);
		$id_tag = $idtag['id_tag'];
		$con->executa("INSERT INTO tag_materias (id_materia, id_tag) VALUES ($id_materia, $id_tag)");
	}
	$checkbox_stat = array();
	$permissoes = $con->executa("SELECT * FROM tag_materias WHERE id_materia = $id_materia");
	if($permissoes && mysqli_num_rows($permissoes)>0){
		while($permissao = mysqli_fetch_assoc($permissoes)){
			$checkbox_stat[$permissao['id_tag']] = 'checked="checked"';
		}
	}
	$tags = $con->executa("SELECT * FROM tags ORDER BY tag");
	if($tags && mysqli_num_rows($tags)>0){
		while($tag = mysqli_fetch_assoc($tags)){
?>
		<div class="quatrocolunas">
			<label for="permit<?=$tag['id_tag']?>" onclick="muda_tag(<?=$tag['id_tag']?>)"><?=$tag['tag']?></label>
			<input type="checkbox" name="permits[]" id="permit<?=$tag['id_tag']?>" value="<?=$tag['id_tag']?>" <?=$checkbox_stat[$tag['id_tag']]?> class="crirHiddenJS"/>
		</div>
<?php
		}
	}
}
?>