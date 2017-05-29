<?php
class apostadores{
    var $id_apostadore, $nome, $email, $senha, $cidade, $estado, $time_coracao, $vip, $aprovado, $data_cadastro;
	
	public function __construct(){
	}	
	public function busca($id){
		$tabela = "apostadores";
		$campos = "*";
		$condicao = "WHERE id_apostadore = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_apostadore = $id;
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
        $this->cidade = $dados['cidade'];
		$this->estado = $dados['estado'];
        $this->time_coracao = $dados['time_coracao'];
        $this->vip = $dados['vip'];
        $this->aprovado = $dados['aprovado'];
        $this->data_cadastro = $dados['data_cadastro'];		
	}
	public function __destruct(){
	}
}
?>