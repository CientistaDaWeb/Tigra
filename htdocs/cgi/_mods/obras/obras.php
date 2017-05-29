<?php
class obras {
    public $id_obra, $nome, $descricao, $slug, $data;

    public function __construct() {

    }
    public function busca($id) {
        $tabela = "obras";
        $campos = "*";
        $condicao = "WHERE id_obra = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_obra = $id;
        $this->nome = $dados['nome'];
        $this->descricao = $dados['descricao'];
        $this->slug = $dados['slug'];
        $this->data= $dados['data'];
    }

    public function __destruct() {

    }
}