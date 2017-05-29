<?php
class clientes{
	public $id_cliente, $cliente, $link;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'clientes';
		$campos = '*';
		$condicao = "WHERE id_cliente = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_cliente = $id;
		$this->cliente = $dados['cliente'];
		$this->link = $dados['link'];
	}
	
	public function __destruct(){
		
	}
}
?>