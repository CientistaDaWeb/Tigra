<?php
class depoimentos{
	public $id_depoimento, $nome, $cargo, $depoimento, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'depoimentos';
		$campos = '*';
		$condicao = "WHERE id_depoimento = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_depoimento = $id;
		$this->nome = $dados['nome'];
		$this->cargo = $dados['cargo'];
		$this->depoimento = $dados['depoimento'];
		$this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>