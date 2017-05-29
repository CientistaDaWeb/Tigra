<?php
date_default_timezone_set('America/Sao_Paulo');
function Randomizar($iv_len)
{
    $iv = '';
    while ($iv_len-- > 0) {
        $iv .= chr(mt_rand() & 0xcc);
    }
    return $iv;
}

function cripfy($texto, $senha, $iv_len = 10){
    $texto .= "\x13";
    $n = strlen($texto);
    if ($n % 16) $texto .= str_repeat("\0", 16 - ($n % 16));
    $i = 0;
    $Enc_Texto = Randomizar($iv_len);
    $iv = substr($senha ^ $Enc_Texto, 0, 512);
    while ($i < $n) {
        $Bloco = substr($texto, $i, 16) ^ pack('H*', md5($iv));
        $Enc_Texto .= $Bloco;
        $iv = substr($Bloco . $iv, 0, 512) ^ $senha;
        $i += 16;
    }
    return preg_replace("/[{\/}]/", "&",base64_encode($Enc_Texto));
}

function decripfy($Enc_Texto, $senha, $iv_len = 10){
    $Enc_Texto = preg_replace("/[{&}]/", "/",$Enc_Texto);
    $Enc_Texto = base64_decode($Enc_Texto);
    $n = strlen($Enc_Texto);
    $i = $iv_len;
    $texto = "";
    $iv = substr($senha ^ substr($Enc_Texto, 0, $iv_len), 0, 512);
    while ($i < $n) {
        $Bloco = substr($Enc_Texto, $i, 16);
        $texto .= $Bloco ^ pack('H*', md5($iv));
        $iv = substr($Bloco . $iv, 0, 512) ^ $senha;
        $i += 16;
    }
    return preg_replace("/\\x13\\x00*$/", "", $texto);
}
function limpadados($dados){
	//$dados = addslashes($dados);
	return $dados;
}
function ajustadata($data, $tipo){
	switch($tipo){
		case 'site':
			$dataF = split("-", $data);		
			$data = $dataF[2].'/'.$dataF[1].'/'.$dataF[0];
		break;
		case 'banco':
			$dataF = split('/', $data);			
			$data = $dataF[2].'-'.$dataF[1].'-'.$dataF[0];
		break;
		case 'calculo':		
			$dlist=explode('/',$data);
			$data = mktime($dlist[1],$dlist[0],$dlist[2]);
		break;
		case 'aniversario':		
			$dataF = split("-", $data);		
			$data = $dataF[2].'/'.$dataF[1];
		break;
		case 'timestamp':
			$dataF = split(" ", $data);
			$dataD = ajustadata($dataF[0], 'site');
			$data = $dataD." ".$dataF[1];
		break;
	}
	return $data;	
}
function timer($param,$starttime)
{
    switch($param)
    {
        case 'start':
            $mtime = microtime();
            $mtime = explode(' ',$mtime);
            $mtime = $mtime[1] + $mtime[0];
            $starttime = $mtime;
         $returnable = $starttime;
        break;
        case 'finalize':
            $mtime = microtime();
            $mtime = explode(' ',$mtime);
            $mtime = $mtime[1] + $mtime[0];
            $endtime = $mtime;
            $totaltime = ($endtime - $starttime);
            $returnable = round($totaltime,2);
        break;
    }

    return $returnable;
}
function deixa_amigavel($palavra){
     $palavra = str_replace(' ','-', $palavra);
     $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/'=>'-', '@'=>'', '"'=>'', "'"=>"", '.'=>'', '--'=>'-', '---'=>'-',
        '|' => '-', '('=>'', ')'=>'', ','=>'', 'º' =>'', 'ª'=>'', '&'=>''
    );
    $palavra = strtr($palavra, $table);
    $palavra = strtr($palavra, $table);
    $palavra = strtr($palavra, $table);
    $palavra = strtolower($palavra);    
    return $palavra;
}
?>