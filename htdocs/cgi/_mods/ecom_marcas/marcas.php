<?php
class marcas{
	public $id_marca, $marca;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "marcas";
		$campos = "*";
		$condicao = "WHERE id_marca = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_marca = $id;
		$this->marca = $dados['marca'];
	}
	
	public function __destruct(){
		
	}
}
?>