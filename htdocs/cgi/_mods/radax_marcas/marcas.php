<?php
class marcas {
    public $id_marca, $marca, $slug, $imagem;

    public function __construct() {
    }

    public function busca($id) {
        $con = new database2();
        $query = 'SELECT * FROM marcas WHERE id_marca = '.$id;
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_marca = $id;
        $this->marca = $dados['marca'];
        $this->slug = $dados['slug'];
        $this->imagem = $dados['imagem'];
    }

    public function __destruct() {
    }
}