<?php
class destaques{
	public $id_destaque, $titulo, $resumo_texto, $descricao, $data, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'destaques';
		$campos = '*';
		$condicao = "WHERE id_destaque = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_destaque = $id;
		$this->titulo = $dados['titulo'];
		$this->resumo_texto = $dados['resumo_texto'];
		$this->descricao = $dados['descricao'];
		$this->data = $dados['data'];
		$this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>