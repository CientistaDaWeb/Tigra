<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_evento = limpadados($id_evento);
$del_item = limpadados($del_item);

if($del_item){
    $apaga = $con->executa("DELETE FROM eventos_recados WHERE id_eventos_recado IN ($del_item)");
}
$recados = $con->executa("SELECT * FROM eventos_recados WHERE id_evento = $id_evento ORDER BY id_eventos_recado DESC");
if($recados && mysqli_num_rows($recados)>0){
	while($recado = mysqli_fetch_assoc($recados)){
?>
	<div>
		<p><?=ajustadata($recado['data'],'site')?> - <?=$recado['nome']?></p>
        <p><?=$recado['recado']?></p>
        <p style="text-align:center"><a onclick="deleta_recado(<?=$recado['id_eventos_recado']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>Não tem recados cadastrados!</p>");
}
?>