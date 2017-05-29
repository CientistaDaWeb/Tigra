<?php

extract($_POST);
require_once("usuarios.php");

if($stats_aprovado == 1 && $aprovado == 2) {
    require_once '_classe/phpmailer.class.php';

    $your_email = "deluse@weentigra.com.br";
    $your_smtp = "smtp.gmail.com";
    $your_smtp_user = "no-reply@weentigra.com.br";
    $your_smtp_pass = "c6tbdyimw7";
    $your_website = "http://www.deluse.com.br";

    $mail = new PHPMailer();
    $body = 'O acesso restrito ao site www.deluse.com.br foi aprovado, logue com seu email e sua senha.<p><b>Email:</b> '.$email.'</p><p><b>Senha:</b> '.$senha.'</p>';
    /*
    $body = '<HTML>
		<HEAD>
		<style>
                    *{
                            margin:0;
                            padding:0;
                    }
                    BODY{
                            color:#555;
                            background:#FFFFFF;
                            padding:10px;
                            width:475px;
                    }
                    th{
                            text-align:center;
                    }
                    #cabecalho{
                            height: 130px;
                    }
                    </style>
                </HEAD>
		<BODY>
			<p id="cabecalho"><img src="http://www.deluse.saria.uni5.net/_img/mail_logo.gif" width="130" height="92" /></p>
			<p>O acesso restrito ao site www.deluse.com.br foi aprovado, logue com seu <b>email</b> e sua <b>senha</b></p>
			<p><b>CNPJ/CPF:</b> '.$cnpj_cpf.'</p>
			<p><b>Razão Social/Nome:</b> '.$rs_nome.'</p>
			<p><b>Telefone:</b> '.$telefone.'</p>
                        <p><b>Atividade principal da Empresa:</b> '.$atividade.'</p>
                        <p></p>
                        <p><b>Email:</b> '.$email.'</p>
                        <p><b>Senha:</b> '.$senha.'</p>
                        <p>----------------------------------------</p>
                        <p>IND. MOVEIS DELUSE LTDA</p>
                        <p>Rua Julio Dal Ponte, 338 - Bairro Licorsul - Bento Gonçalves - RS - 95700-000</p>
                        <p><b>Fone: 54 2105.7766</b></p>
		</BODY>
	</HTML>';
     * */


    $mail->body = $body;

    $mail->CharSet = 'utf-8';
    $mail->From = $your_email;
    $mail->FromName = 'Deluse. Design. Duas palavras intimamente ligadas.';
    $mail->Host = $your_smtp;
    $mail->Mailer   = "smtp";
    $mail->Password = $your_smtp_pass;
    $mail->Username = $your_smtp_user;
    $mail->Subject = "Aprovação de acesso ao site www.deluse.com.br";
    $mail->SMTPAuth  =  "true";

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->AltBody = "Para ver esse e-mail, habilite a abertura de e-mails HTML!";
    $mail->MsgHTML($body);

    $mail->AddAddress($email, $rs_nome);
    $mail->AddReplyTo('comercial@deluse.com.br','Comercial Deluse');

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Messagem enviada!";
    }

}

$objeto = new usuarios();
$objeto->id_usuario = limpadados($id_usuario);
$objeto->cnpj_cpf = limpadados($cnpj_cpf);
$objeto->rs_nome = limpadados($rs_nome);
$objeto->telefone = limpadados($telefone);
$objeto->email = limpadados($email);
$objeto->senha = limpadados($senha);
$objeto->atividade = limpadados($atividade);
$objeto->aprovado = limpadados($aprovado);


$id = limpadados($id_usuario);
$tg_mod_tabela = 'usuarios';
$tg_mod_tipo = 'Usuário';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');
