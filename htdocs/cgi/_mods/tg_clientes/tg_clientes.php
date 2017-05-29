<?php
class tg_clientes{
	public $id_tg_cliente, $nome, $db_host, $db_user, $db_pass, $db_dbname, $ftp_host, $ftp_user, $ftp_pass, $dominio, $logotipo, $telefone, $cidade, $fk_tg_estado, $endereco, $contato, $email, $data, $avaliacao, $cep;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_clientes';
		$campos = '*';
		$condicao = "WHERE id_tg_cliente = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_cliente = $id;
		$this->nome = $dados['nome'];
                $this->tipo = $dados['tipo'];
                $this->documento = $dados['documento'];
		$this->db_host = $dados['db_host'];
		$this->db_user = $dados['db_user'];
		$this->db_pass = $dados['db_pass'];
		$this->db_dbname = $dados['db_dbname'];
		$this->ftp_host = $dados['ftp_host'];
		$this->ftp_user = $dados['ftp_user'];
		$this->ftp_pass = $dados['ftp_pass'];
		$this->dominio = $dados['dominio'];
		$this->logotipo = $dados['logotipo'];
		$this->telefone = $dados['telefone'];
		$this->cidade = $dados['cidade'];
		$this->fk_tg_estado = $dados['fk_tg_estado'];
		$this->endereco = $dados['endereco'];
                $this->email = $dados['email'];
		$this->contato = $dados['contato'];
		$this->data = $dados['data'];
		$this->avaliacao = $dados['avaliacao'];
		$this->cep = $dados['cep'];
	}
	
	public function __destruct(){
		
	}
}
?>