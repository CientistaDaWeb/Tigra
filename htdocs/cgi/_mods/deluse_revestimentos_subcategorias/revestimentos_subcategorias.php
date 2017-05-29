<?php
class revestimentos_subcategorias{
	public $id_revestimentos_subcategoria, $id_revestimentos_categoria, $subcategoria, $slug;
	
	public function __construct(){
	}
	
	public function busca($id){
		$tabela = "revestimentos_subcategorias";
		$campos = "*";
		$condicao = "WHERE id_revestimentos_subcategoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_revestimentos_subcategoria = $id;
		$this->id_revestimentos_categoria = $dados['id_revestimentos_categoria'];
		$this->subcategoria = $dados['subcategoria'];
		$this->slug = $dados['slug'];
	}
	
	public function __destruct(){
	}
}
?>