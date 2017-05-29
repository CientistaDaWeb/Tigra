<?php
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');


class email extends PHPMailer{
	
	function __construct($des_nome, $des_email, $assunto, $corpo, $rem_nome, $rem_email){
		if(!$rem_email){
			$rem_email = 'tigra@weentigra.com.br';
		}
		if(!$rem_nome){
			$rem_nome = 'Ween Tigra';
		}
		if(!$des_email){
			$des_email = 'tigra@weentigra.com.br';
		}
		if(!$des_nome){
			$des_nome = 'Ween Tigra';
		}
		$this->IsSMTP();
		$this->AddAddress($des_email, $des_nome);
		$this->IsHTML(true);
		$this->SetLanguage("br");
		$this->AddReplyTo($rem_email, $rem_nome);
		
		$this->SMTPAuth   = true;                  
		$this->SMTPSecure = "ssl";                 
		$this->Host       = "smtp.gmail.com";      
		$this->Port       = 465;                
		
		$this->Username   = "site@weentigra.com.br";
		$this->Password   = "tigra159753";
		
		$cabecalho = '<HTML><HEAD></HEAD><BODY style="margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; color:#999; font-size:14px; padding-top:120px"><div id="cabecalho" style="height:110px; width:100%; text-align:center; border-bottom:2px solid #8CB400; position:absolute; top:0; margin:0; padding:0; padding-bottom:10px; margin-bottom:20px; display:block;"><img src="http://www.weentigra.com.br/email/logo_tigra.jpg"></div>';		
		$rodape = '<div id="rodape" style="position:relative; text-align:left; width:100%; height:75px;  border-top:2px solid #8CB400; margin:0; padding:0; padding-top:10px; margin-top:20px; display:block;"><img src="http://www.weentigra.com.br/email/cabecalio_wt_mail.jpg"></div></BODY></HTML> ';
		
		$this->From       = $rem_email;
		$this->FromName   = utf8_decode($rem_nome);
		
		$this->Subject    = utf8_decode($assunto);
		$this->Body 	  = $cabecalho . utf8_decode($corpo) . $rodape;
		
		
	}
	
	 
}
?>