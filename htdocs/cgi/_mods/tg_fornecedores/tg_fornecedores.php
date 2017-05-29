<?php
class tg_fornecedores{
	public $id_tg_fornecedore, $fornecedor;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_fornecedores';
		$campos = '*';
		$condicao = "WHERE id_tg_fornecedore = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_fornecedore = $id;
		$this->fornecedor = $dados['fornecedor'];
	}
	
	public function __destruct(){
		
	}
}