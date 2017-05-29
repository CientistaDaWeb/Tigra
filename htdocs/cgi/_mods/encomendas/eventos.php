<?php
session_start();
extract($_POST);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_encomenda = limpadados($id_encomenda);
$id_evento = limpadados($id_evento);
$acao = limpadados($acao);
$evento = limpadados($evento);
$data = limpadados(ajustadata($data,'banco'));

if($acao == 'adicionar'){
	$con->executa("INSERT INTO eventos (id_encomenda, evento, data) VALUES ($id_encomenda, '$evento', '$data')");
}

if($acao == 'remover'){
	$con->executa("DELETE FROM eventos WHERE id_encomenda = $id_encomenda AND id_evento = $id_evento");
}

$eventos = $con->executa("SELECT * FROM eventos WHERE id_encomenda = $id_encomenda ORDER BY data DESC");
	if($eventos && mysqli_num_rows($eventos)>0){
		while($evento = mysqli_fetch_assoc($eventos)){
?>
	<div class="duascolunas">
		<p><?=ajustadata($evento['data'],'site')?></p>
		<p><?=$evento['evento']?></p>
		<p><a onclick="deleta_evento(<?=$evento['id_evento']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
		}
	}else{
?>
	<p class="vazio">Não existem eventos cadatrados!</p>
<?php
	}
?>