<?php
session_start();
require_once('../../_classe/pagination_class.php');
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

extract($_POST);

$qry = "SELECT * FROM obras_fotos WHERE id_obra =".$id_obra;
$order = ' ORDER BY data DESC, id_obras_foto DESC';

$qry .= $order;


$starting = $page;
$recpage = 10;
$obj = new pagination_class($qry, $starting, $recpage, $con);
$result = $obj->result;

$linhas = array('odd', 'even');

if($result->num_rows != 0){
	$counter = 0;
	while($data = $result->fetch_array()){
		?>
<div class="miniatura">
<p class="foto_miniatura"><img
	src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/obras/galeria/thumbs/<?=$data['foto']?>" />
</p>
<p><?= ajustadata($data['data'], 'site')?></p>
<p><?= $data['legenda']?></p>
<p style="text-align: center"><a
	onclick="deleta_foto(<?=$data['id_obras_foto']?>);"
	style="cursor: pointer">Excluir</a></p>
</div>
		<?php
		$counter ++;
	}
	?>
<div class="dataTables_info"><?=$obj->total?></div>
<div class="dataTables_paginate"><?=$obj->anchors?></div>
	<?
}else{
	?>
<div><span class='vazio'>Não tem fotos cadastradas!</span></div>
	<?
}
?>
<style type="text/css">
.dataTables_info {
	clear: both;
}
.miniatura{
	height: 250px;
}
</style>
