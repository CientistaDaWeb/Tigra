<?php
class frotas{
	public $id_frota, $descricao, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'frotas';
		$campos = '*';
		$condicao = "WHERE id_frota = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_frota = $id;
		$this->descricao = $dados['descricao'];
		$this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>