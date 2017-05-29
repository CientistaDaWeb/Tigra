<?php
/**
 * Classe DataBase
 *
 */
class database2 extends mysqli{
	/**
	 * Método Construtor
	 * Cria um objeto de conexão Mysqli
	 *
	 */
	public function __construct(){
		if($_SERVER['SERVER_ADDR'] == '200.98.246.169'){
			$host = decripfy($_SESSION['db_host'],'h0s7');
			$dbname =  decripfy($_SESSION['db_dbname'],'h0s7');
			$usuario =  decripfy($_SESSION['db_user'],'h0s7');
			$senha =  decripfy($_SESSION['db_pass'],'h0s7');
		}else{
			$host = "localhost";
			$dbname =  decripfy($_SESSION['db_dbname'],'h0s7');
			$usuario = "root";
			$senha = "";
		}

		try {
			@$this->connect($host, $usuario, $senha, $dbname);
			if(mysqli_connect_errno() != 0) {
                throw new Exception(mysqli_connect_errno());
            }
		}catch(Exception $erro){
			$mensagem = $erro->getMessage();
            $codigo   = $erro->getCode();
            $arquivo  = $erro->getFile();
            $trace    = $erro->getTraceAsString();
		}
	}

	/**
	 * M�todo para execu��o de querys
	 *
	 * @param string $query
	 */
	public function executa($query){
		return $this->query($query);
	}

	/**
	 * M�todo destrutor
	 * Depois de Utilizado, o objeto de autodestr�i
	 * Fechando assim, o link com o banco de dados
	 *
	 */
	public function __destruct(){
		$this->close();
	}
}
?>