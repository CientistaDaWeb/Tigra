<?php
class categorias_subcategorias{
	public $id_categorias_subcategoria, $id_produtos_categorias, $subcategoria, $slug;
	
	public function __construct(){
	}
	
	public function busca($id){
		$tabela = "categorias_subcategorias";
		$campos = "*";
		$condicao = "WHERE id_categorias_subcategoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_categorias_subcategoria = $id;
        $this->id_produtos_categorias = $dados['id_produtos_categorias'];
		$this->subcategoria = $dados['subcategoria'];
		$this->slug = $dados['slug'];
	}
	
	public function __destruct(){
	}
}
?>