<?php
class permitidos{
	public $id_permitido, $nome, $email, $senha;
	
	public function __construct(){
	}
	public function busca($id){
		$tabela = "permitidos";
		$campos = "*";
		$condicao = "WHERE id_permitido = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_permitido = $id;
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
        $this->senha = $dados['senha'];
	}
	public function __destruct(){
	}
}
?>