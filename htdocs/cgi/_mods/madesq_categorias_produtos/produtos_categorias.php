<?php
class produtos_categorias{
	public $id_produtos_categoria, $categoria, $slug, $main_cat;
	
	public function __construct(){
	}
	
	public function busca($id){
		$tabela = "produtos_categorias";
		$campos = "*";
		$condicao = "WHERE id_produtos_categoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_produtos_categoria = $id;
		$this->categoria = $dados['categoria'];
		$this->slug = $dados['slug'];
		$this->main_cat = $dados['main_cat'];
	}
	
	public function __destruct(){
	}
}
?>