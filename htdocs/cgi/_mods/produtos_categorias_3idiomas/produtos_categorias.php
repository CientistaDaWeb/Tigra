<?php
class produtos_categorias{
	public $id_produtos_categoria, $categoria_pt, $slug_pt, $categoria_en, $slug_en, $categoria_es, $slug_es, $ordem;
	
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
		$this->categoria_pt = $dados['categoria_pt'];
		$this->slug_pt = $dados['slug_pt'];
        $this->categoria_en = $dados['categoria_en'];
		$this->slug_en = $dados['slug_en'];
        $this->categoria_es = $dados['categoria_es'];
		$this->slug_es = $dados['slug_es'];
		$this->ordem = $dados['ordem'];
	}
	
	public function __destruct(){
	}
}
?>