<?php
require_once('_classe/handler2.php');
if($id){
	$tg_link = "$url_base/cgi/$mod/form/$id";
    $grava = handler2::update($objeto);
    if($grava){
		$tg_alert_tipo = 'sucesso';
		$tg_alert_titulo = 'Sucesso';
		$tg_alert_msg = $tg_mod_tipo.' alterad'.$tg_mod_sexo.' com sucesso!';
	}else{
		$tg_alert_tipo = 'erro';
		$tg_alert_titulo = 'Erro';
		$tg_alert_msg = 'Nenhuma modificação feita!';
	}
}else{
	if($del_item){
		if(handler2::delete($tg_mod_tabela,$del_item)){
			$tg_alert_tipo = 'sucesso';
			$tg_alert_titulo = 'Sucesso';
			$tg_alert_msg = $tg_mod_tipo.'s excluid'.$tg_mod_sexo.'s com sucesso!';
		}else{
			$tg_alert_tipo = 'erro';
			$tg_alert_titulo = 'Erro';
			$tg_alert_msg = 'Nenhuma modificação feita!';
		}
        $tg_link = "$url_base/cgi/$mod";
	}else{
		if($id = handler2::add($objeto)){
			$tg_alert_tipo = 'sucesso';
			$tg_alert_titulo = 'Sucesso';
			$tg_alert_msg = $tg_mod_tipo.' inserid'.$tg_mod_sexo.' com sucesso!';
		}else{
			$tg_alert_tipo = 'erro';
			$tg_alert_titulo = 'Erro';
			$tg_alert_msg = 'Nenhuma modificação feita!';
		}
        $tg_link = "$url_base/cgi/$mod/form/$id";
	}
}
$_SESSION['alert_msg'] = $tg_alert_msg;
$_SESSION['alert_titulo'] = $tg_alert_titulo;
$_SESSION['alert_tipo'] = $tg_alert_tipo;
?>
<script>
	window.location = '<?=$tg_link?>';
</script>