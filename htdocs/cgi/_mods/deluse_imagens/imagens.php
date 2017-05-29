<?php
class imagens {
    public $id_imagen, $legenda, $imagem;

    public function __construct() {
    }

    public function busca($id) {
        $tabela = 'imagens';
        $campos = '*';
        $condicao = "WHERE id_imagen = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_imagen = $id;
        $this->legenda = $dados['legenda'];
        $this->imagem = $dados['imagem'];
    }
    public function __destruct() {
    }
}