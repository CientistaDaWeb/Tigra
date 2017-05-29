<?php
class eventos{
	public $id_evento, $titulo, $local, $data, $descricao, $slug;
	
	public function __construct(){}	
	public function busca($id){
		$tabela = "eventos";
		$campos = "*";
		$condicao = "WHERE id_evento = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_evento = $id;
		$this->titulo = $dados['titulo'];
		$this->local = $dados['local'];
		$this->data = $dados['data'];
        $this->descricao = $dados['descricao'];
		$this->slug = $dados['slug'];
	}
	public function __destruct(){}
}
?>