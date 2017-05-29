<?php
class noticias{
	public $id_noticia, $slug, $titulo, $linha_apoio, $texto, $data, $imagem;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'noticias';
		$campos = '*';
		$condicao = "WHERE id_noticia = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_noticia = $id;
        $this->slug = $dados['slug'];
		$this->titulo = $dados['titulo'];
        $this->linha_apoio = $dados['linha_apoio'];
		$this->texto = $dados['texto'];
		$this->data = $dados['data'];
        $this->imagem = $dados['imagem'];
	}
	
	public function __destruct(){
		
	}
}
?>