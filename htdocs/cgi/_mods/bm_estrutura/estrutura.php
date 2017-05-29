<?php
class estrutura{
	public $id_estrutura, $imagem, $descricao;
	
	public function __construct(){}	
	public function busca($id){
		$tabela = "estrutura";
		$campos = "*";
		$condicao = "WHERE id_estrutura = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_estrutura = $id;
		$this->imagem = $dados['imagem'];
		$this->descricao = $dados['descricao'];
	}
	public function __destruct(){}
}
?>