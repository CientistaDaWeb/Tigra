<?php
class familiares{
	public $id_familiare, $fk_pai, $nome, $data_nascimento, $data_falecimento, $conjuge, $conj_data_nascimento, $conj_data_falecimento, $endereco, $cidade, $cep, $estado, $email, $telefone, $profissao, $chefe, $imagem, $imagem_conjuge;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = "familiares";
		$campos = "*";
		$condicao = "WHERE id_familiare = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_familiare = $dados['id_familiare'];
		$this->fk_pai = $dados['fk_pai'];
		$this->nome = $dados['nome'];
		$this->data_nascimento = $dados['data_nascimento'];
		$this->data_falecimento = $dados['data_falecimento'];
		$this->conjuge = $dados['conjuge'];
		$this->conj_data_nascimento = $dados['conj_data_nascimento'];
		$this->conj_data_falecimento = $dados['conj_data_falecimento'];
		$this->endereco = $dados['endereco'];
		$this->cidade = $dados['cidade'];
		$this->cep = $dados['cep'];
		$this->estado = $dados['estado'];
		$this->email = $dados['email'];
		$this->telefone = $dados['telefone'];
		$this->profissao = $dados['profissao'];
		$this->chefe = $dados['chefe'];
		$this->imagem = $dados['imagem'];
		$this->imagem_conjuge = $dados['imagem_conjuge'];
	}
	
	public function __destruct(){
		
	}
}
?>