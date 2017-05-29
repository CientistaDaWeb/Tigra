<?php
class tags{
	public $id_tag, $tag;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "tags";
		$campos = "*";
		$condicao = "WHERE id_tag = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tag = $id;
		$this->tag = $dados['tag'];
	}
	
	public function __destruct(){
		
	}
}
?>