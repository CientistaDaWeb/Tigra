<?php
extract($_POST);

require_once("$tg_mod.php");
require_once('_classe/email.php');
$objeto = new tg_usuarios();
$objeto->id_tg_usuario = limpadados($id_tg_usuario);
$objeto->nome = limpadados($nome);
$objeto->usuario = limpadados($usuario);
$objeto->senha = limpadados($senha);
$objeto->email = limpadados($email);
$objeto->fk_tg_cliente = limpadados($fk_tg_cliente);

if($enviar_senha){
	$cliente = $con_tigra->executa("SELECT * FROM tg_clientes WHERE id_tg_cliente = $fk_tg_cliente");
	if($cliente && mysqli_num_rows($cliente)>0){
		$cliente = mysqli_fetch_assoc($cliente);
		$id_crip = cripfy($cliente['id_tg_cliente'],'id_tg_cliente');
		$corpo = "Dados de acesso:<br>
		Usu&aacute;rio: $usuario<br>	
		Senha: $senha<br>
		Site: http://www.".decripfy($cliente['dominio'],"h0s7")."<br>
		Acesse o site atrav&eacute;s do link <a href=$url_base/login/$id_crip>$url_base/login/$id_crip</a>.";
		$assunto = 'Dados de acesso Tigra';
		$mail = new email($nome, $email, $assunto, $corpo, '', '');
		if(!$mail->Send()) {
		  echo "Erro ao enviar o e-mail!" . $mail->ErrorInfo;
		}
	}
}


$id = limpadados($id_tg_usuario);
$tg_mod_tabela = 'tg_usuarios';
$tg_mod_tipo = 'Usu&aacute;rio';
$tg_mod_sexo = 'o';

require_once('_inc/action.php');

if($id_tg_usuario){
	$deleta_permissoes = $con_tigra->executa("DELETE FROM tg_permissoes WHERE fk_tg_usuario = $objeto->id_tg_usuario");
	$total = count($permits);
	for($i=0; $i<$total; $i++){
		$permissao = split("/",$permits[$i]);
		$fk_tg_modulo = $permissao[0];
		$fk_tg_cat_modulo = $permissao[1];
		
		$insere = $con_tigra->executa("INSERT INTO tg_permissoes(fk_tg_usuario, fk_tg_modulo, fk_tg_cat_modulo) VALUES ($id_tg_usuario, $fk_tg_modulo, $fk_tg_cat_modulo)");
	}
}
?>