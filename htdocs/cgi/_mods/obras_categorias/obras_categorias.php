<?php
class obras_categorias{
	public $id_obras_categoria, $categoria, $slug;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "obras_categorias";
		$campos = "*";
		$condicao = "WHERE id_obras_categoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_obras_categoria = $id;
		$this->categoria = $dados['categoria'];
                $this->descricao = $dados['descricao'];
		$this->slug = $dados['slug'];
	}
	
	public function __destruct(){
		
	}
}
?>