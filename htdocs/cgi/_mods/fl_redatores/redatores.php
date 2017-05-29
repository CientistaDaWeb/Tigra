<?php
class redatores{
	public $id_redatore, $perfil, $foto, $nome;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "redatores";
		$campos = "*";
		$condicao = "WHERE id_redatore = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_redatore = $id;
		$this->perfil = $dados['perfil'];
		$this->nome = $dados['nome'];
		$this->foto = $dados['foto'];
	}
	
	public function __destruct(){
		
	}
}
?>