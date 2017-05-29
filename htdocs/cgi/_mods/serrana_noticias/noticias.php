<?php
class noticias {
    public $id_noticia, $titulo, $texto, $data, $slug;

    public function __construct() {

    }
    public function busca($id) {
        $tabela = "noticias";
        $campos = "*";
        $condicao = "WHERE id_noticia = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_noticia = $id;
        $this->titulo = $dados['titulo'];
        $this->texto = $dados['texto'];
        $this->data = $dados['data'];
        $this->slug = $dados['slug'];
    }
    public function __destruct() {

    }
}