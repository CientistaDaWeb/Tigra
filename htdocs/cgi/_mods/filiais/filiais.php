<?php
class filiais{
	public $id_filiai, $nome, $endereco, $cep, $cidade, $fk_estado, $fone, $celular, $contato, $email;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'filiais';
		$campos = '*';
		$condicao = "WHERE id_filiai = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_filiai = $id;
		$this->nome = $dados['nome'];
		$this->endereco = $dados['endereco'];
		$this->cep = $dados['cep'];
		$this->cidade = $dados['cidade'];
		$this->fk_estado = $dados['fk_estado'];
		$this->fone = $dados['fone'];
		$this->celular = $dados['celular'];
		$this->contato = $dados['contato'];
		$this->email = $dados['email'];
	}
	
	public function __destruct(){
		
	}
}
?>