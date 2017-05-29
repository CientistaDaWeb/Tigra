<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/upload.php');
require_once('../../_classe/database2.php');
$con = new database2();

$id_obra = limpadados($id_obra);
$data = limpadados(ajustadata($data_texto,'banco'));
$del_item = limpadados($del_item);
$texto = limpadados($texto);
if($del_item){
    $apaga = $con->executa("DELETE FROM obras_textos WHERE id_obras_texto IN ($del_item)");
}else{
    $grava = $con->executa("INSERT INTO obras_textos (texto, id_obra, data) VALUES ('$texto', $id_obra, '$data')");
}
$textos = $con->executa("SELECT * FROM obras_textos WHERE id_obra = $id_obra");
if($textos && mysqli_num_rows($textos)>0){
	while($texto = mysqli_fetch_assoc($textos)){
?>
	<div class="galeria_texto">
		<?=$texto['texto']?>
        <p><?=ajustadata($texto['data'],'site')?></p>
        <p><?=$texto['legenda']?></p>
		<p style="text-align:center"><a onclick="deleta_texto(<?=$texto['id_obras_texto']?>);" style="cursor:pointer">Excluir</a></p>
	</div>
<?php
	}
}else{
echo("<p class='vazio'>Não tem textos cadastrados!</p>");
}
?>