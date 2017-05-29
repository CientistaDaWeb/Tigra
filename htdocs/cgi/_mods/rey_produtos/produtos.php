<?php
class produtos{
    var $id_produto, $id_produtos_categoria, $id_categorias_subcategoria, $produto, $ref, $descricao, $imagem, $imagem2, $video, $slug;

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
        $this->id_categorias_subcategoria = $dados['id_categorias_subcategoria'];
		$this->produto = $dados['produto'];
        $this->ref = $dados['ref'];
        $this->descricao = $dados['descricao'];
        $this->imagem = $dados['imagem'];
        $this->imagem2 = $dados['imagem2'];
        $this->video = $dados['video'];
        $this->slug = $dados['slug'];
	}
    function  __destruct() {
    }
}

?>
