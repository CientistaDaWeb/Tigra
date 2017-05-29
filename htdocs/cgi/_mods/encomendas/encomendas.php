<?php
class encomendas{
	public $id_encomenda, $nf, $observacoes, $cnpj;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'encomendas';
		$campos = '*';
		$condicao = "WHERE id_encomenda = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_encomenda = $id;
		$this->nf = $dados['nf'];
		$this->observacoes = $dados['observacoes'];
		$this->cnpj = $dados['cnpj'];
	}
	
	public function __destruct(){
		
	}
}
?>