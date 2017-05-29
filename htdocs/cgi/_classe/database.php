<?php

/**
 * Classe DataBase
 *
 */
class database extends mysqli {

    /**
     * M�todo Construtor
     * Cria um objeto de conex�o Mysqli
     *
     */
    function __construct() {
//		if($_SERVER['SERVER_ADDR'] == '189.38.90.54'){
        if ($_SERVER['SERVER_ADDR'] == '200.98.246.169') {
            $host = 'cpmy0028.servidorwebfacil.com';
            $dbname = 'wslabs_tigra';
            $usuario = 'wslabs_tigra';
            $senha = '$,pNtdAsPs(.';
        } else {
            $host = "localhost";
            $dbname = "weentigra";
            $usuario = "root";
            $senha = "";
        }

        try {
            $this->connect($host, $usuario, $senha, $dbname);
            if (mysqli_connect_errno() != 0) {
                throw new Exception(mysqli_connect_errno());
            }
        } catch (Exception $erro) {
            $mensagem = $erro->getMessage();
            $codigo = $erro->getCode();
            $arquivo = $erro->getFile();
            $trace = $erro->getTraceAsString();
        }
    }

    /**
     * M�todo para execu��o de querys
     *
     * @param string $query
     */
    function executa($query) {
        return $this->query($query);
    }

    /**
     * M�todo destrutor
     * Depois de Utilizado, o objeto de autodestr�i
     * Fechando assim, o link com o banco de dados
     *
     */
    function __destruct() {
        $this->close();
    }

}

?>