<?php
class produtos{
    var $id_produto, $id_produtos_categoria, $nome, $descricao, $imagem;

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
		$this->id_produtos_categoria = $dados['id_produtos_categoria'];
		$this->nome = $dados['nome'];
        $this->descricao = $dados['descricao'];
		$this->imagem = $dados['imagem'];
	}
    function  __destruct() {
    }
}

?>
