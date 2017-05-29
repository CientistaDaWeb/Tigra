<?php
extract($_POST);
require_once("_mods/tg_usuarios/tg_usuarios.php");
require_once("redatores.php");
require_once('_classe/email.php');
require_once('_classe/upload.php');
require_once('_classe/handler.php');
require_once('_classe/handler2.php');

$objeto = new tg_usuarios();
$objeto->id_tg_usuario = limpadados($id_tg_usuario);
$objeto->nome = limpadados($nome);
$objeto->usuario = limpadados($usuario);
$objeto->senha = limpadados($senha);
$objeto->email = limpadados($email);
$objeto->fk_tg_cliente = $_SESSION['id_tg_cliente'];

$objeto2 = new redatores();
$objeto2->id_redatore = limpadados($id_tg_usuario);
$objeto2->nome = limpadados($nome);
$objeto2->perfil = limpadados($perfil);

if($_FILES['foto']['size'] > 0){
	$up = new upload($_FILES['foto']);
	$up->img_width = 150;
	$up->img_height = 200;
	$up->cli_img_dir = '_img/redatores/';
	
	$up->tmb_width = 43;
	$up->tmb_height = 57;
	$up->cli_tmb_dir = 'thumbs/';
	$up->img_resize(true, true);
	$objeto2->foto = $up->img_db_name;
}
if($enviar_senha){
	$id_crip = cripfy($_SESSION['id_tg_cliente'],'id_tg_cliente');
	$corpo = "Dados de Acesso<br>
	Usu&aacute;rio: $usuario<br>	
	Senha: $senha<br>
	Site: http://www.".decripfy($_SESSION['dominio'],"h0s7")."<br>
	Acesse o site atrav&eacute;s do link <a href=$url_base/login/$id_crip>$url_base/login/$id_crip</a>.";
	$assunto = 'Dados de acesso Tigra';
	$mail = new email($nome, $email, $assunto, $corpo, '', '');
	if(!$mail->Send()) {
	  echo "Erro ao enviar o e-mail!" . $mail->ErrorInfo;
	}
}

if($id_tg_usuario){
	$grava = handler::update($objeto);
	$grava = handler2::update($objeto2);

	$deleta_permissoes = $con_tigra->executa("DELETE FROM tg_permissoes WHERE fk_tg_usuario = $objeto->id_tg_usuario");
	$total = count($permits);
	for($i=0; $i<$total; $i++){
		$permissao = split("/",$permits[$i]);
		$fk_tg_modulo = $permissao[0];
		$fk_tg_cat_modulo = $permissao[1];
		$insere = $con_tigra->executa("INSERT INTO tg_permissoes(fk_tg_usuario, fk_tg_modulo, fk_tg_cat_modulo) VALUES ($id_tg_usuario, $fk_tg_modulo, $fk_tg_cat_modulo)");
	}

	$tg_alert_tipo = 'sucesso';
	$tg_alert_titulo = 'Sucesso!';
	$tg_alert_msg = 'Usu&aacute;rio alterados com sucesso!';
	$tg_link = 	"$url_base/cgi/$mod/form/$id_tg_usuario";
}else{
	$tg_link = 	"$url_base/cgi/$mod";
	if($del_item){
		$apaga = handler::delete("tg_usuarios", $del_item);
		$apaga = handler2::delete("redatores", $del_item);
		$tg_alert_tipo = 'sucesso';
		$tg_alert_titulo = 'Sucesso!';
		$tg_alert_msg = 'Usu&aacute;rio excluido com sucesso!';
	}else{
		$grava = handler::add($objeto);
		
		$id_tg_usuario = $con_tigra->executa("SELECT id_tg_usuario FROM tg_usuarios WHERE usuario = '$objeto->usuario' AND fk_tg_cliente =  $objeto->fk_tg_cliente ORDER BY id_tg_usuario DESC LIMIT 0,1");
		$id_tg_usuario = mysqli_fetch_assoc($id_tg_usuario);
		$id_tg_usuario = $id_tg_usuario['id_tg_usuario'];
		
		$objeto2->id_redatore = $id_tg_usuario;
		$grava = handler2::add($objeto2);
		
		$total = count($permits);	
		for($i=0; $i<$total; $i++){
			$permissao = split("/",$permits[$i]);
			$fk_tg_modulo = $permissao[0];
			$fk_tg_cat_modulo = $permissao[1];
			
			$insere = $con_tigra->executa("INSERT INTO tg_permissoes(fk_tg_usuario, fk_tg_modulo, fk_tg_cat_modulo) VALUES ($id_tg_usuario, $fk_tg_modulo, $fk_tg_cat_modulo)");
		}	
		
		$tg_alert_msg = 'Usu&aacute;rio inseridos com sucesso!';
		$tg_alert_tipo = 'sucesso';
		$tg_alert_titulo = 'Sucesso!';
	}
}

$_SESSION['alert_msg'] = $tg_alert_msg;
$_SESSION['alert_titulo'] = $tg_alert_titulo;
$_SESSION['alert_tipo'] = $tg_alert_tipo;
?>
<script>
	window.location = '<?=$tg_link?>';
</script>