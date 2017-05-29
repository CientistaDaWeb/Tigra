<?php
class materias_comentarios{
	public $id_materias_comentario, $nome, $email, $url_site, $comentario, $data, $status, $id_materia;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'materias_comentarios';
		$campos = '*';
		$condicao = "WHERE id_materias_comentario = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_materias_comentario = $id;
		$this->id_materia = $dados['id_materia'];
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
		$this->comentario = $dados['comentario'];
		$this->status = $dados['status'];
		$this->url_site = $dados['url_site'];
		$this->data = $dados['data'];
	}
	
	public function __destruct(){
		
	}
}
?>