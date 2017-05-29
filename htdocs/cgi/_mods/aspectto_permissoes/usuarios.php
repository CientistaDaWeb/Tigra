<?php
class usuarios{
	public $id_usuario, $nome, $email, $usuario, $senha;
	
	public function __construct(){
	}
	public function busca($id){
		$tabela = "usuarios";
		$campos = "*";
		$condicao = "WHERE id_usuario = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_usuario = $id;
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
                $this->usuario = $dados['usuario'];
                $this->senha = $dados['senha'];
	}
	public function __destruct(){
	}
}
?>