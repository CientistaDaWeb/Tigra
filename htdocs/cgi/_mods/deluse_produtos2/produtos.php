<?php
class produtos {
    var $id_produto, $id_produtos_categoria, $nome, $referencia, $dimensao, $imagem;

    function  __construct() {
    }
    public function busca($id) {
        $query = 'SELECT * FROM produtos WHERE id_produto = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        if($rs && $rs->num_rows > 0) {
            $dados = mysqli_fetch_assoc($rs);
            $this->id_produto = $dados['id_produto'];
            $this->id_produtos_categoria = $dados['id_produtos_categoria'];
            $this->nome = $dados['nome'];
            $this->referencia = $dados['referencia'];
            $this->dimensao = $dados['dimensao'];
            $this->imagem = $dados['imagem'];
        }
    }
    function  __destruct() {
    }
}