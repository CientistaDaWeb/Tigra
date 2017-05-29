<?php
class alunos {
    public $id_aluno, $id_setor, $matricula, $nome, $email, $senha, $ativo;
    public function __construct() {

    }
    public function busca($id) {
        $query = 'SELECT * FROM alunos WHERE id_aluno = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_aluno = $id;
        $this->id_setor = $dados['id_setor'];
        $this->matricula = $dados['matricula'];
        $this->nome = $dados['nome'];
        $this->email = $dados['email'];
        $this->senha = $dados['senha'];
        $this->ativo = $dados['ativo'];
    }
    public function __destruct() {

    }
}