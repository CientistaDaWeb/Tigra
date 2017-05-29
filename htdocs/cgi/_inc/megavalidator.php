<?php
$passou = false;
$permissao = $con_tigra->executa("SELECT * FROM tg_permissoes WHERE fk_tg_modulo = $seila[id_tg_modulo] AND fk_tg_usuario = $_SESSION[id_tg_usuario]");
if($permissao && mysqli_num_rows($permissao)>0){
	$permissaodupla = $con_tigra->executa("SELECT tg_catxmodulos.id_tg_catxmodulo FROM tg_catxmodulos, tg_cat_modulos WHERE tg_cat_modulos.fk_tg_cliente = $_SESSION[id_tg_cliente] AND tg_catxmodulos.fk_tg_modulo = $seila[id_tg_modulo] AND tg_cat_modulos.id_tg_cat_modulo = tg_catxmodulos.fk_tg_cat_modulo");		
	if($permissaodupla && mysqli_num_rows($permissaodupla)>0){
		$passou = true;	
	}
}else{
	$passou = false;
}
?>