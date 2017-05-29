<?php
if($pagina != 'action'){
	if($_SESSION['alert_msg']){
	?>
    <div id="alerta" class="<?=$_SESSION['alert_tipo']?>">
        <?=$_SESSION['alert_msg']?>
    </div>
    <?	
	}
	$_SESSION['alert_titulo'] = '';
	$_SESSION['alert_tipo'] = '';
	$_SESSION['alert_msg'] = '';
}
?>