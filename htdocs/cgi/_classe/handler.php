<?php
/**
 * 
 * Classe para execu��o de INSERT, UPDATE e DELETE no banco de dados Mysql 
 * Pode ser facilmente customizada para qualquer Banco de Dados Relacional
 * @author Andr� Gustavo Espeiorin (Xorna) falecomoxorna@blogdoxorna.com
 * @version 1.0
 *  	
 */
class handler{
	
	/**
	 * M�todo Construtor
	 * Presente para manter tudo no padr�o 
	 * */
	public  function __construct(){
		
	}
	
	/**
	 * M�todo para teste do tipo do valor da propriedade
	 * Se for inteiro, retorna inteiro
	 * Se for string, retorna formatado com ''
	 * @param quaisquer tipo $valor
	 * @return $valor com ou sem ''
	 * @access static
	 */
	public static function verificaInteiro($valor){
		if(is_int($valor)){
			return $valor;
		}else{
			return "'$valor'";
		}
	}
	
	/**
	 * M�todo para execu��o da Inser��o
	 * Separado por conven��o, assim pode ser usado em outras partes da aplica��o
	 * onde o m�todo add n�o possa ser usado
	 * @param string $tabela
	 * @param string $campos
	 * @param string $valores
	 * @access static
	 */
	public static function executaInsercao($tabela, $campos, $valores){
		require_once('database.php');
		$conector = new database();		
		$query = "INSERT INTO $tabela ($campos) VALUES ($valores)";
		$conector->executa($query);
		if($conector->affected_rows > 0){
			return true;		
		}else{
			return false;
		}
	}
	
	/**
	 * M�todo para montagem e execu��o de Querys de UPDATE
	 *
	 * @param string $tabela
	 * @param string $campos_valores
	 * @param string $clausula
	 */
	public static function executaUpdate($tabela, $campos_valores, $clausula){
		require_once('database.php');
		$conector = new database();
		$query = "UPDATE $tabela SET $campos_valores WHERE $clausula";
		$conector->executa($query);
		if($conector->affected_rows > 0){
			return true;		
		}else{
			return false;
		}
	}
	
	/**
	 * M�todo para inser��o de conte�do no banco
	 * Recebe um objeto qualquer
	 * Monta o SQL para inserir e manda brasa
	 *
	 * @param unknown_type $object
	 */
	public static function add($object){
		# Pega o tipo do objeto
		$type = get_class($object);
		
		# Carrega a Classe, se necess�rio
		require_once("../cgi/_mods/$type/$type.php");
		
		# Seta o nome da tabela
		$tabela = $type;
		
		# Inicializa��o dos Elementos da Query
		$campos = "";
		$valores = "";
		
		# Iterador para saber quando � o primeiro �ndice
		$i = 0;
		
		# Entra no loop para montar a query
		foreach ($object as $key => $value) {
			if($value){
				if($i == 0){
					$campos .= $key;
					$valores .=  self::verificaInteiro($value);
				}else{
					$campos .= ", $key";
					$valores .= ", ".self::verificaInteiro($value);
				}
				$i++;
			}
		}		
		return self::executaInsercao($tabela, $campos, $valores);
	}
	
	/**
	 * M�todo para altera��o de dados no banco
	 * Recebe um objeto qualquer
	 * Monta o SQL e manda brasa
	 *
	 * @param unknown_type $object
	 */
	public static function update($object){
		# Pega o tipo do objeto
		$type = get_class($object);
		
		# Carrega a classe, se necess�rio
		require_once("../cgi/_mods/$type/$type.php");
		
		# Seta o nome da tabela
		$tabela = $type;
		
		# Inicializa��o dos Elementos da Query
		$campos_valores = "";
		$clausula = "";
		
		#Iterador para saber quando � o primeiro �ndice
		$i = 0;
		
		# Entra no loop para montar a query
		foreach ($object as $key => $value) {
			if($value){
				switch($i){
					case 0:
						$clausula = "$key = $value";
						break;
					case 1:
						$campos_valores .= "$key = ".self::verificaInteiro($value);
						break;
					default:
						$campos_valores .= ", $key = ".self::verificaInteiro($value);
						break;
				}
			}
			$i++;
		}
		return self::executaUpdate($tabela, $campos_valores, $clausula);
	}
	
	/**
	 * M�todo para apagar registros no banco
	 * Recebe o nome da tabela e o(s)ids
	 * case seja mais de um id passar como array!
	 *
	 * @param string $tabela
	 * @param array or integer $ids
	 */
	public static function delete($tabela, $ids){
		require_once('database.php');
		if(is_array($ids)){
			$ids = implode(',', $ids);
		}
		$singular = substr($tabela, 0, (strlen($tabela) -1));
		$campo_id = "id_$singular";		
		$query = "DELETE FROM $tabela WHERE $campo_id IN($ids)";
		$conector = new database();
		$conector->executa($query);
		if($conector->affected_rows > 0){
			return true;		
		}else{
			return false;
		}
	}
	
	/**
	 * M�todo para consulta completa
	 * Qualquer tabela pegando pelo indice
	 *
	 * @param string $tabela
	 * @param integer $id
	 * @return Mysqli Recordset
	 */
	public static function getData($tabela, $id){
		require_once('database.classe');
		$singular = substr($tabela, 0, (strlen($tabela) -1));
		$campo_id = "id_$singular";
		$query = "SELECT * FROM $tabela WHERE $campo_id = $id";
		$conector = new database();
		$recordSet = $conector->executa($query);
		return $recordSet;
	}
	
	public function __destruct(){
		
	}
}
?>