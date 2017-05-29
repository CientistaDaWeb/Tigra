<?php
class infraestruturas{
	public $id_infraestrutura, $descricao, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'infraestruturas';
		$campos = '*';
		$condicao = "WHERE id_infraestrutura = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_infraestrutura = $id;
		$this->descricao = $dados['descricao'];
		$this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>