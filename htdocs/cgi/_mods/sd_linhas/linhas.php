<?php
class linhas {
    public $id_linha, $linha, $slug;

    public function __construct() {

    }
    public function busca($id) {
        $tabela = "linhas";
        $campos = "*";
        $condicao = "WHERE id_linha = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_linha = $id;
        $this->linha = $dados['linha'];
        $this->slug = $dados['slug'];
    }
    public function __destruct() {

    }
}