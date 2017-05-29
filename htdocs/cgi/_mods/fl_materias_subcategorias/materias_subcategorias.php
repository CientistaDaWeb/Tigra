<?php
class materias_subcategorias{
	public $id_materias_subcategoria, $id_materias_categoria, $subcategoria, $subcat;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "materias_subcategorias";
		$campos = "*";
		$condicao = "WHERE id_materias_subcategoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_materias_subcategoria = $id;
		$this->id_materias_categoria = $dados['id_materias_categoria'];
		$this->subcategoria = $dados['subcategoria'];
		$this->subcat = $dados['subcat'];
	}
	
	public function __destruct(){
		
	}
}
?>