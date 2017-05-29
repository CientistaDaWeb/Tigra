<?php
class responsabilidades{
	public $id_responsabilidade, $titulo, $linha_apoio, $texto, $imagem, $slug;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'responsabilidades';
		$campos = '*';
		$condicao = "WHERE id_responsabilidade = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_responsabilidade = $id;
		$this->titulo = $dados['titulo'];
        $this->linha_apoio = $dados['linha_apoio'];
		$this->texto = $dados['texto'];
        $this->imagem = $dados['imagem'];
        $this->slug = $dados['slug'];
	}
	
	public function __destruct(){
		
	}
}
?>