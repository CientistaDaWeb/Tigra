<?php
$status = '0';
extract($_POST);
require_once("usuarios_permitidos.php");
if($status == 1) {
    require_once '_classe/phpmailer.class.php';

    $your_email = "sillonfine@sillonfine.com.br";
    $your_smtp = "smtp.gmail.com";
    $your_smtp_user = "no-reply@weentigra.com.br";
    $your_smtp_pass = "c6tbdyimw7";

    $mail = new PHPMailer();
    $body = 'O acesso restrito ao site www.sillonfine.com.br foi aprovado, logue com seu email e sua senha.<br /><br />E-mail enviado automaticamente, não responda ele.';

    $mail->body = $body;

    $mail->CharSet = 'utf-8';
    $mail->From = $your_email;
    $mail->FromName = 'Sillon Fine';
    $mail->Host = $your_smtp;
    $mail->Mailer   = "smtp";
    $mail->Password = $your_smtp_pass;
    $mail->Username = $your_smtp_user;
    $mail->Subject = "Aprovação de acesso ao site www.sillonfine.com.br";
    $mail->SMTPAuth  =  "true";

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->AltBody = "Para ver esse e-mail, habilite a abertura de e-mails HTML!";
    $mail->MsgHTML($body);

    $mail->AddAddress($email, $rs_nome);
    $mail->AddReplyTo('sillonfine@sillonfine.com.br','Sillon Fine - Home e Office');

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Messagem enviada!";
    }

}
$objeto = new usuarios_permitidos();
$objeto->id_usuarios_permitido = limpadados($id_usuarios_permitido);
$objeto->nome = limpadados($nome);
$objeto->email = limpadados($email);
$objeto->endereco = limpadados($endereco);
$objeto->cnpj = limpadados($cnpj);
$objeto->telefone = limpadados($telefone);
$objeto->status = limpadados($status);

$id = limpadados($id_usuarios_permitido);
$tg_mod_tabela = 'usuarios_permitidos';
$tg_mod_tipo = 'Usuário';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');