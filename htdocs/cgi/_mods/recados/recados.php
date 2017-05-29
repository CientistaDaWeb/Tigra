<?php
class recados{
	public $id_recado, $nome, $email, $recado, $aprovado, $data;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'recados';
		$campos = '*';
		$condicao = "WHERE id_recado = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_recado = $id;
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
		$this->recado = $dados['recado'];
		$this->aprovado = $dados['aprovado'];
		$this->data = $dados['data'];
	}
	
	public function __destruct(){
		
	}
}
?>