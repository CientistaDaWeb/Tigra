<?php
class fac_alunos{
	public $id_fac_aluno, $matricula, $id_fac_curso, $nome, $email, $sexo, $senha, $data_nascimento, $telefone;
	public function __construct(){}
	public function busca($id){
		$tabela = 'fac_alunos';
		$campos = '*';
		$condicao = "WHERE id_fac_aluno = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_fac_aluno = $id;
		$this->matricula = $dados['matricula'];
		$this->id_fac_curso = $dados['id_fac_curso'];
        $this->nome = $dados['nome'];
        $this->email = $dados['email'];
        $this->sexo = $dados['sexo'];
        $this->senha = $dados['senha'];
        $this->telefone = $dados['telefone'];
        $this->data_nascimento = $dados['data_nascimento'];
	}
	public function __destruct(){}
}
?>