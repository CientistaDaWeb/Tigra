<?php
class noticias_categorias {
    var $id_noticias_categoria, $categoria, $url;

    function  __construct() {
    }
    public function busca($id) {
        $query = 'SELECT * FROM noticias_categorias WHERE id_noticias_categoria = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_noticias_categoria = $id;
        $this->categoria = $dados['categoria'];
        $this->url = $dados['url'];
    }
    function  __destruct() {
    }
}