<?php
class tg_usuarios{
	public $id_tg_usuario, $fk_tg_cliente, $nome, $usuario, $senha, $email;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "tg_usuarios";
		$campos = "*";
		$condicao = "WHERE id_tg_usuario = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_usuario = $id;
		$this->fk_tg_cliente = $dados['fk_tg_cliente'];
		$this->nome = $dados['nome'];
		$this->usuario = $dados['usuario'];
		$this->senha = $dados['senha'];
		$this->email = $dados['email'];
	}
	
	public function __destruct(){
		
	}
}
?>