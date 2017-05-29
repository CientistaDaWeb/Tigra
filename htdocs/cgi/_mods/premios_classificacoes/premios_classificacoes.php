<?php
class premios_classificacoes{
	public $id_premios_classificacoe, $classificacao, $slug;
	
	public function __construct(){
	}
	
	public function busca($id){
		$tabela = "premios_classificacoes";
		$campos = "*";
		$condicao = "WHERE id_premios_classificacoe = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_premios_classificacoe = $id;
		$this->classificacao = $dados['classificacao'];
		$this->slug = $dados['slug'];
	}
	
	public function __destruct(){
	}
}
?>