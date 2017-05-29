<?php
class produtos{
    var $id_produto, $id_produtos_categoria, $nome, $referencia, $imagem_1, $imagem_2, $descrição, $slug;

    function  __construct() {
    }
    public function busca($id){
        $tabela = 'produtos';
        $campos = '*';
        $condicao = "WHERE id_produto = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);

        $this->id_produto =   $id;
        $this->id_produtos_categoria = $dados['id_produtos_categoria'];
        $this->nome         = $dados['nome'];
        $this->referencia   = $dados['referencia'];
        $this->imagem_1     = $dados['imagem_1'];
        $this->imagem_2     = $dados['imagem_2'];
        $this->descricao    = $dados['descricao'];
    }
    function  __destruct() {
    }
}

?>
