<?php
class portifolios{
	public $id_portifolio, $cliente, $descricao, $url, $data, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'portifolios';
		$campos = '*';
		$condicao = "WHERE id_portifolio = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_portifolio = $id;
		$this->cliente = $dados['cliente'];
		$this->descricao = $dados['descricao'];
		$this->url = $dados['url'];
		$this->data = $dados['data'];
		$this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>