<?php
class servicos_categorias {
    public $id_servicos_categoria, $categoria, $imagem, $slug;

    public function __construct() {
    }

    public function busca($id) {
        $con = new database2();
        $query = 'SELECT * FROM servicos_categorias WHERE id_servicos_categoria = '.$id;
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_servicos_categoria = $dados['id_servicos_categoria'];
        $this->categoria = $dados['categoria'];
        $this->imagem = $dados['imagem'];
    }

    public function __destruct() {
    }
}