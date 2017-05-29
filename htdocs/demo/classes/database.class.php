<?php
class database extends mysqli {
    public function __construct() {
        if($_SERVER['SERVER_ADDR'] == '189.38.90.54') {
            $host = "mysql.weentigra.com.br";
            $dbname = "weentigra01";
            $usuario = "weentigra01";
            $senha = "6ilbca1cps";
        }else {
            $host = "localhost";
            $dbname = "weentigra01";
            $usuario = "root";
            $senha = "";
        }
        try {
            @$this->connect($host, $usuario, $senha, $dbname);
            if(mysqli_connect_errno() != 0) {
                throw new Exception(mysqli_connect_errno());
            }
        }catch(Exception $erro) {
            $mensagem = $erro->getMessage();
            $codigo   = $erro->getCode();
            $arquivo  = $erro->getFile();
            $trace    = $erro->getTraceAsString();
        }
    }
    public function __destruct() {
        $this->close();
    }
}
