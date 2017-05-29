<?php
class produtos {
    var $id_produto, $id_produtos_subcategoria, $nome, $imagem, $descricao, $slug;

    function  __construct() {
    }
    public function busca($id) {
        $tabela = 'produtos';
        $campos = '*';
        $condicao = "WHERE id_produto = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_produto = $id;
        $this->id_produtos_subcategoria = $dados['id_produtos_subcategoria'];
        $this->nome = $dados['nome'];
        $this->imagem = $dados['imagem'];
        $this->descricao = $dados['descricao'];
        $this->slug = $dados['slug'];
    }
    function  __destruct() {
    }
}

?>
