<?php
extract($_POST);

require_once("$tg_mod.php");

$objeto = new tg_boletos();
$objeto->id_tg_boleto = $id_tg_boleto;
$objeto->id_tg_cliente = $id_tg_cliente;
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->valor = limpadados($valor);
$objeto->data_vencimento = limpadados(ajustadata($data_vencimento,'banco'));
$objeto->descritivo =limpadados($descritivo);

	
$id = limpadados($id_tg_boleto);
$tg_mod_tabela = 'tg_boletos';
$tg_mod_tipo = 'Boleto';
$tg_mod_sexo = 'o';

if(!$remessa){
    if(!$id_tg_boleto && !$del_item){
        $sql = 'INSERT INTO tg_creditos (id_tg_cliente, valor, data, descritivo, status)
            VALUES ('.$id_tg_cliente.',"'.$valor.'","'.ajustadata($data,'banco').'", "'.$descritivo.'", 1)';
        $con_tigra->query($sql);
    }
    require_once('_inc/action.php');
}else{
    $sql = 'SELECT * FROM tg_clientes WHERE id_tg_cliente = '.$id_tg_cliente;
    $cliente = $con_tigra->query($sql);
    $cliente = $cliente->fetch_assoc();
    $corpo= '<p>Olá '.$cliente['contato'].',</p>';
    $corpo.= '<p>As seguintes cobranças foram criadas para '.$cliente['nome'].'!</p><hr />';
    for($i=0; $i<$parcelas; $i++){
        $sql = 'INSERT INTO tg_boletos (id_tg_cliente, data, valor, data_vencimento, descritivo)
            VALUES ('.$id_tg_cliente.',"'.date('Y-m-d').'","'.$valorp[$i].'","'.ajustadata($datap[$i],'banco').'", "'.$descritivo.'<br />Parcela '.($i+1).'/'.$parcelas.'")';
        $con_tigra->query($sql);
        if($con_tigra->insert_id){
            $id = $con_tigra->insert_id;
            $corpo.='<p><b>Vencimento:</b> '.$datap[$i].'</p>
                    <p><b>valor:</b> R$ '.$valorp[$i].'</p>
                    <p><a href="http://www.weentigra.com.br/boleto/'.cripfy($id,'b0l370').'">Acessar o boleto</a></p>
                    <hr />';
        }
        $sql = 'INSERT INTO tg_creditos (id_tg_cliente, valor, data, descritivo, status)
            VALUES ('.$id_tg_cliente.',"'.$valorp[$i].'","'.ajustadata($datap[$i],'banco').'", "'.$descritivo.'<br />Parcela '.($i+1).'/'.$parcelas.'", 1)';
        $con_tigra->query($sql);
    }
    //envia o e-mail
    require_once '_classe/phpmailer.class.php';

    $your_email = "financeiro@ween.com.br";
    $your_smtp = "smtp.gmail.com";
    $your_smtp_user = "financeiro@ween.com.br";
    $your_smtp_pass = "email159753";
    $your_website = "http://www.ween.com.br";

    $mail = new PHPMailer();
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
			'.$corpo.'
		</BODY>
	</HTML>';

    $mail->body = $body;

    $mail->CharSet = 'utf-8';
    $mail->From = $your_email;
    $mail->FromName = '[Financeiro] Ween Web Solutions';
    $mail->Host = $your_smtp;
    $mail->Mailer   = "smtp";
    $mail->Password = $your_smtp_pass;
    $mail->Username = $your_smtp_user;
    $mail->Subject = "Nova Cobrança Ween Web Solutions";
    $mail->SMTPAuth  =  "true";
    $mail->ConfirmReadingTo = $your_email;
    $mail->Priority = 1;

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->AltBody = "Para ver esse e-mail, habilite a abertura de e-mails HTML!";
    $mail->MsgHTML($body);

    $mail->AddAddress($cliente['email'], $cliente['contato']);
    $mail->AddReplyTo('financeiro@ween.com.br','[Financeiro] Ween Web Solutions');
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Boletos criados e enviados!";
    }
}