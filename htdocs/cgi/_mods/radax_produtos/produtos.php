<?php
class produtos{
    var $id_produto, $id_marca,$id_produtos_subcategoria, $nome, $referencia, $descricao, $imagem, $imagem2, $slug;

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
		$this->id_produto = $id;
		$this->id_marca = $dados['id_marca'];
		$this->id_produtos_subcategoria = $dados['id_produtos_subcategoria'];
		$this->nome = $dados['nome'];
		$this->referencia = $dados['referencia'];
        $this->descricao = $dados['descricao'];
		$this->imagem = $dados['imagem'];
		$this->imagem2 = $dados['imagem2'];
	}
    function  __destruct() {
    }
}

?>
