<?php
class usuarios_permitidos {
    public $id_usuarios_permitido, $nome, $cnpj, $email, $empresa, $telefone, $endereco, $senha, $status;

    public function __construct() {
    }
    public function busca($id) {
        $tabela = "usuarios_permitidos";
        $campos = "*";
        $condicao = "WHERE id_usuarios_permitido = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_usuarios_permitido = $id;
        $this->nome = $dados['nome'];
        $this->cnpj = $dados['cnpj'];
        $this->email = $dados['email'];
        $this->telefone = $dados['telefone'];
        $this->endereco = $dados['endereco'];
        $this->senha = $dados['senha'];
        $this->status = $dados['status'];
    }
    public function __destruct() {
    }
}