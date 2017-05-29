<?php
class estruturas{
	public $id_estrutura, $descricao, $imagem;
	
	public function __construct(){}	
	public function busca($id){
		$tabela = "estruturas";
		$campos = "*";
		$condicao = "WHERE id_estrutura = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_estrutura = $id;
		$this->descricao = $dados['descricao'];
                $this->imagem = $dados['imagem'];
	}
	public function __destruct(){}
}
?>