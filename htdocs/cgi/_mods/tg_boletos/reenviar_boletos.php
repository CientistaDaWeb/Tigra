<?php
$con = new database2();
$sql = 'SELECT c.nome, c.id_tg_cliente FROM tg_clientes c, tg_creditos cr WHERE cr.id_tg_cliente = c.id_tg_cliente AND cr.status = 1 GROUP BY c.id_tg_cliente';
$clientes = $con->query($sql);

$id_cliente = $_POST['cliente'];
?>
<form method="post">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th>Cliente</th>
            <td><select class="inpute" name="cliente">
                    <?php
                    if($clientes && $clientes->num_rows > 0) {
                        while($cliente = $clientes->fetch_assoc()) {
                            ?>
                    <option value="<?php echo $cliente['id_tg_cliente'] ; ?>"><?php echo $cliente['nome'] ; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select></td>
            <td><button type="submit">Reenviar</button></td>
        </tr>
    </table>
</form>
<?php
if($id_cliente) {
    $sql = 'SELECT b.id_tg_boleto, b.data_vencimento, b.valor FROM tg_boletos b, tg_creditos c WHERE b.id_tg_cliente = c.id_tg_cliente AND c.data = b.data_vencimento AND b.valor = c.valor AND c.status = 1 AND c.id_tg_cliente = '.$id_cliente.' ORDER BY b.data_vencimento ASC';
    $boletos = $con->query($sql);

    $sql = 'SELECT nome, email, contato FROM tg_clientes WHERE id_tg_cliente = '.$id_cliente;
    $cliente = $con->query($sql);
    $cliente = $cliente->fetch_assoc();
}

if($boletos && $boletos->num_rows > 0) {
    $corpo= '<p>Olá '.$cliente['contato'].',</p>';
    $corpo.= '<p>As seguintes cobranças para '.$cliente['nome'].' seguem em aberto em nosso sistema!</p><hr />';

    while($boleto = $boletos->fetch_assoc()) {
        $corpo.='<p><b>Vencimento:</b> '.ajustadata($boleto['data_vencimento'],'site').'</p>
                    <p><b>valor:</b> R$ '.number_format($boleto['valor'],2,',','.').'</p>
                    <p><a href="http://www.weentigra.com.br/boleto/'.cripfy($boleto['id_tg_boleto'],'b0l370').'">Acessar o boleto</a></p>
                    <hr />';
    }

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
    $mail->Subject = "Cobranças em aberto Ween Web Solutions";
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
        echo "Boletos reenviados!";
    }
}