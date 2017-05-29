<?php
class obras{
	public $id_obra, $id_obras_categoria, $nome, $descricao, $imagem, $andamento, $slug, $ordem;
	
	public function __construct(){
		
	}	
	public function busca($id){
		$tabela = "obras";
		$campos = "*";
		$condicao = "WHERE id_obra = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_obra = $id;
		$this->id_obras_categoria = $dados['id_obras_categoria'];
		$this->nome = $dados['nome'];
		$this->descricao = $dados['descricao'];
		$this->imagem = $dados['imagem'];
        $this->andamento = $dados['andamento'];
		$this->slug = $dados['slug'];
        $this->ordem = $dados['ordem'];
	}
	
	public function __destruct(){
		
	}
}
?>