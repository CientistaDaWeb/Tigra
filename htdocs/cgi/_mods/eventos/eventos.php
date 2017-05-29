<?php
class eventos{
	public $id_evento, $evento, $subtitulo, $descricao, $local, $imagem, $data;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'eventos';
		$campos = '*';
		$condicao = "WHERE id_evento = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_evento = $id;
		$this->evento = $dados['evento'];
		$this->subtitulo = $dados['subtitulo'];
		$this->descricao = $dados['descricao'];
		$this->local = $dados['local'];
		$this->imagem = $dados['imagem'];
		$this->data = $dados['data'];
	}
	
	public function __destruct(){
		
	}
}
?>