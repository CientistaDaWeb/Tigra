<?php
class produtos{
    public  $id_produto, $id_marca, $id_categorias_produto, $codigo, $produto, $preco, $peca, $destaque, $descricao, $imagem;

    public function __construct(){
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
		$this->id_categorias_produto = $dados['id_categorias_produto'];
        $this->codigo = $dados['codigo'];
        $this->produto = $dados['produto'];
		$this->preco = $dados['preco'];
		$this->peca = $dados['peca'];
        $this->destaque = $dados['destaque'];
        $this->descricao = $dados['descricao'];
        $this->imagem = $dados['imagem'];
	}
	public function __destruct(){
    }
}
?>
