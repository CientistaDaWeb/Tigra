<?php
class eventos{
	public $id_evento, $nome;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'cad_clientes';
		$campos = '*';
		$condicao = "WHERE id_cad_cliente = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_cad_clientes = $id;
		$this->nome = $dados['nome'];
	}
	
	public function __destruct(){
		
	}
}
?>