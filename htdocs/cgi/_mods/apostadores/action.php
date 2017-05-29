<?php
extract($_POST);
require_once("apostadores.php");
require_once('_classe/phpmailer.php');

$objeto = new apostadores();
$objeto->id_apostadore = limpadados($id_apostadore);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->cidade = limpadados(cidade);
$objeto->estado = limpadados(estado);
$objeto->time_coracao = limpadados(time_coracao);
$objeto->vip = limpadados(vip);

if($enviar_vip){
	$mail = new PHPmailer();
    $nome = utf8_decode($nome);
    $mail->IsMail(true);
    $mail->IsHTML(true);
    $mail->SetLanguage("br");
    $mail->From       = 'bolaobr@bolaobr.com';
    $mail->FromName   = utf8_decode('Bolão BR');
    $mail->AddAddress($email, $nome);
    $criptografado = cripfy($email,'3m41L');

    $mensagem = utf8_decode("Sua conta vip acaba de ser liberada.<br><br>
        Caso não consiga acessar o conteúdo destinado a palpiteiros vip, clique em sair e depois logue-se novamente.<br><br>
        Fique a vontade para nos enviar qualquer dúvida, através do e-mail ou através dos formulários de recados e contato do site.<br><br>
        Abraços,<br>
        Equipe BolãoBR");

    $corpo = '<BODY style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; FONT-SIZE: 14px; PADDING-BOTTOM: 0px; MARGIN: 0px; COLOR: #949586; PADDING-TOP: 120px; FONT-FAMILY: Arial, Helvetica, sans-serif" bgColor=#ffffff><DIV id=cabecalho style="PADDING-RIGHT: 0px; DISPLAY: block; PADDING-LEFT: 0px; PADDING-BOTTOM: 10px; MARGIN: 0px 0px 20px; WIDTH: 100%; PADDING-TOP: 0px; BORDER-BOTTOM: #949586 2px solid; POSITION: absolute; TOP: 0px; HEIGHT: 110px; TEXT-ALIGN: center"><IMG src="http://www.bolaobr.com/mail/logo.jpg"></DIV><DIV>'.$mensagem.'</DIV></BODY></HTML>';
    $mail->Body = $corpo;
    $mail->Subject = utf8_decode('Cadastro BolãoBR');
    $mail->Send();
}

$id = limpadados($id_apostadore);
$tg_mod_tabela = 'apostadores';
$tg_mod_tipo = 'Apostador';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
?>