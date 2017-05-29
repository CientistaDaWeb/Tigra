<?php
class materias_categorias{
	public $id_materias_categoria, $categoria, $cat;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "materias_categorias";
		$campos = "*";
		$condicao = "WHERE id_materias_categoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_materias_categoria = $id;
		$this->categoria = $dados['categoria'];
		$this->cat = $dados['cat'];
	}
	
	public function __destruct(){
		
	}
}
?>