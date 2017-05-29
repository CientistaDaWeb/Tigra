<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto CEF SIGCB: Davi Nunes Camargo				  |
// +----------------------------------------------------------------------+
// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// Inclui as funções e a database
require_once('cgi/_inc/function.php');
require_once('cgi/_classe/database.php');
$con = new database();

//Desmancha a URL
$url = $_SERVER['REQUEST_URI'];
$var = explode('/', $url);

$id_boleto = decripfy($var[2],'b0l370');
$boletos = $con->executa("SELECT b.id_tg_boleto, b.data, b.status, b.valor, c.id_tg_cliente, c.documento, c.nome, c.endereco, e.uf, c.cidade, c.cep, c.dominio, b.data_vencimento, b.descritivo
    FROM tg_boletos AS b, tg_clientes AS c, tg_estados AS e
    WHERE b.id_tg_boleto = $id_boleto AND b.id_tg_cliente = c.id_tg_cliente AND c.fk_tg_estado = e.id_tg_estado");
if($boletos && mysqli_num_rows($boletos)>0){
	$boleto = mysqli_fetch_assoc($boletos);
	
	// DADOS DO BOLETO PARA O SEU CLIENTE
	$dias_de_prazo_para_pagamento = 15;
	$taxa_boleto = 2.60;
	$data_venc = ajustadata($boleto['data_vencimento'],'site');  // Prazo de X dias OU informe data: "13/04/2006";
	$valor_cobrado = $boleto['valor']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
	$valor_cobrado = str_replace(",", ".",$valor_cobrado);
	$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
	
	// Composição Nosso Numero - CEF SIGCB
	$dadosboleto["nosso_numero1"] = "033"; // tamanho 3
	$dadosboleto["nosso_numero_const1"] = "2"; //constanto 1 , 1=registrada , 2=sem registro
	$dadosboleto["nosso_numero2"] = substr('000'.$boleto['id_tg_cliente'],-3); // tamanho 3
	$dadosboleto["nosso_numero_const2"] = "4"; //constanto 2 , 4=emitido pelo proprio cliente
	$dadosboleto["nosso_numero3"] = substr('00000000000'.$boleto['id_tg_boleto'],-9); // tamanho 9
	
	
	$dadosboleto["numero_documento"] = substr('0000'.$boleto['id_tg_cliente'],-5).'-'.substr('0000'.$boleto['id_tg_boleto'],-5);	// Num do pedido ou do documento
	$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
	$dadosboleto["data_documento"] = ajustadata($boleto['data'],'site'); // Data de emiss�o do Boleto
	$dadosboleto["data_processamento"] = date('d/m/Y'); // Data de processamento do boleto (opcional)
	$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
	
	// DADOS DO SEU CLIENTE
	$dadosboleto["sacado"] = $boleto['nome'];
	$dadosboleto["endereco1"] = $boleto['endereco'];
	$dadosboleto["endereco2"] = "$boleto[cidade] - $boleto[uf] -  CEP: $boleto[cep]";
	
	// INFORMACOES PARA O CLIENTE
	$dadosboleto["demonstrativo1"] = "Pagamento para Ween Soluções Web LTDA";
	$dadosboleto["demonstrativo2"] = "$boleto[descritivo]<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
	$dadosboleto["demonstrativo3"] = "http://www.".decripfy($boleto['dominio'],'h0s7');
	
	// INSTRU��ES PARA O CAIXA
	$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2%, após o vencimento";
	$dadosboleto["instrucoes2"] = "- Sr. Caixa, cobrar mora de 0.033% ao dia, após o vencimento";
	$dadosboleto["instrucoes3"] = "- Receber até 10 dias após o vencimento<br>- Em caso de dúvidas entre em contato conosco: ween@ween.com.br";
	$dadosboleto["instrucoes4"] = "- ou através dos telefones (54) 3055.3125 - (54) 3055.3126";
	
	// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
	$dadosboleto["quantidade"] = "";
	$dadosboleto["valor_unitario"] = "";
	$dadosboleto["aceite"] = "";		
	$dadosboleto["especie"] = "R$";
	$dadosboleto["especie_doc"] = "";
	
	
	// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
	
	
	// DADOS DA SUA CONTA - CEF
	$dadosboleto["agencia"] = "0457"; // Num da agencia, sem digito
	$dadosboleto["conta"] = "123"; 	// Num da conta, sem digito
	$dadosboleto["conta_dv"] = "0"; 	// Digito do Num da conta
	
	// DADOS PERSONALIZADOS - CEF
	$dadosboleto["conta_cedente"] = "094111"; // C�digo Cedente do Cliente, com 6 digitos (Somente N�meros)
	$dadosboleto["carteira"] = "SR";  // C�digo da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)
	
	// SEUS DADOS
	$dadosboleto["identificacao"] = "Ween Soluções Web LTDA";
	$dadosboleto["cpf_cnpj"] = $boleto['documento'];
	$dadosboleto["endereco"] = "Av. Osvaldo Aranha, 1075 - Sala 407";
	$dadosboleto["cidade_uf"] = "Bento Gonçalves / RS";
	$dadosboleto["cedente"] = "Ween Soluções Web LTDA";
	
	// NãO ALTERAR!
	require_once("boleto/funcoes_cef_sigcb.php"); 
	require_once("boleto/layout_cef.php");
}else{
	echo 'Boleto n&atilde;o encontrado!';
}
?>
