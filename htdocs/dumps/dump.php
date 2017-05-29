<?php
$dir = date('Ymd-Hi');

require_once('../cgi/_inc/function.php');
require_once('../cgi/_classe/database.php');
require_once('../cgi/phpmailer/class.phpmailer.php');
$con = new database();

$sql = 'SELECT * FROM tg_clientes WHERE avaliacao = 2';
$rs = $con->executa($sql);
mkdir($dir);
chmod($dir,0777);

if($rs && $rs->num_rows>0) {
    while($cliente = mysqli_fetch_assoc($rs)) {
        if($_SERVER['SERVER_ADDR'] == '189.38.90.54') {
            $db_host = decripfy($cliente['db_host'],'h0s7');
            $db_user = decripfy($cliente['db_user'],'h0s7');
            $db_pass = decripfy($cliente['db_pass'],'h0s7');
        }else {
            $db_host = 'localhost';
            $db_user = 'root';
            $db_pass = '';
        }
        $dbname = decripfy($cliente['db_dbname'],'h0s7');
        $con2 = mysql_connect($db_host, $db_user, $db_pass, $dbname);
        if($con2) {
            $back = fopen($dir."/".$dbname.".sql","w+");
            $res = mysql_list_tables($dbname) or die(mysql_error());
            while($tabela = mysql_fetch_row($res)) {
                $table = $tabela[0];
                $cria = "";
                $cria = mysql_query("SHOW CREATE TABLE $table");
                $cria = mysql_fetch_assoc($cria);
                $cria = $cria['Create Table'];
                fwrite($back,"-- Criando tabela : $table --\n");
                fwrite($back,"$cria ;\n-- Dump de Dados --\n");
                $seleciona = mysql_query("SELECT * FROM $table");
                while($r = mysql_fetch_row($seleciona)) {
                    $sql="INSERT INTO $tabela[0] VALUES (";
                    for($j=0;
                    $j<mysql_num_fields($seleciona);
                    $j++) {
                        if(!isset($r[$j]))
                            $sql .= " '',";
                        elseif($r[$j] != "")
                            $sql .= " '".addslashes($r[$j])."',";
                        else
                            $sql .= " '',";
                    }
                    $sql = ereg_replace(",$", "", $sql);
                    $sql .= ");\n";
                    fwrite($back,$sql);
                }
            }
            fclose($back);
            $msg .= 'Backup criado - '.$cliente['nome'].' - ['.$dir.'/'.$dbname.'.sql]<br>';
            mysql_close($con2);
        }else {
            $msg .= 'Erro ao conectar a '.$cliente['nome'].' - '.$e.'<br />';
        }
    }
    $mail = new PHPMailer();
    $mail->IsMail(true);
    $mail->IsHTML(true);
    $mail->SetLanguage("br");
    $mail->CharSet = "UTF-8";
    $mail->From       = 'tigra@weentigra.com.br';
    $mail->FromName   = 'Ween Tigra';
    $mail->AddAddress('ween@ween.com.br', 'Ween Web Solutions');
    $mail->Body = 'Backup efetuado '. $dir.'<br />Bases backapeadas: <br /><br />'.$msg;
    $mail->Subject = '[backup MYSQL] '.$dir;
    $mail->Send();
}

