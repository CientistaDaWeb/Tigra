<?php
class servicos {
    public $id_servico, $servico, $imagem, $descricao, $slug;

    public function __construct() {
    }

    public function busca($id) {
        $con = new database2();
        $query = 'SELECT * FROM servicos WHERE id_servico = '.$id;
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_servico = $dados['id_servico'];
        $this->id_servicos_categoria = $dados['id_servicos_categoria'];
        $this->servico = $dados['servico'];
        $this->imagem = $dados['imagem'];
        $this->descricao = $dados['descricao'];
    }

    public function __destruct() {
    }
}