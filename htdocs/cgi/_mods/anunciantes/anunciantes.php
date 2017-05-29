<?php
class anunciantes{
	public $id_anunciante, $anunciante, $telefone, $contato;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'anunciantes';
		$campos = '*';
		$condicao = "WHERE id_anunciante = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_anunciante = $id;
		$this->anunciante = $dados['anunciante'];
		$this->contato = $dados['contato'];
		$this->telefone = $dados['telefone'];
	}
	
	public function __destruct(){
		
	}
}
?>