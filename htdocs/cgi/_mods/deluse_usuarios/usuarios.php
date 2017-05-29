<?php
class usuarios {
    public $id_usuario, $cnpj_cpf, $rs_nome, $telefone, $mail, $senha, $atividade, $aprovado;

    public function __construct() {
    }
    public function busca($id) {
        $tabela = "usuarios";
        $campos = "*";
        $condicao = "WHERE id_usuario = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_usuario = $id;
        $this->cnpj_cpf = $dados['cnpj_cpf'];
        $this->rs_nome = $dados['rs_nome'];
        $this->telefone = $dados['telefone'];
        $this->email = $dados['email'];
        $this->senha = $dados['senha'];
        $this->atividade = $dados['atividade'];
        $this->aprovado = $dados['aprovado'];
    }
    public function __destruct() {
    }
}
?>