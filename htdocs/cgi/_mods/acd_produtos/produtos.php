<?php
class produtos{
    var $id_produto, $id_produtos_categoria, $nome_pt, $referencia, $codigo, $composicao_pt, $lancamento, $imagem, $cores, $slug_pt, $nome_es, $composicao_es, $slug_es, $ordem;

    function  __construct() {
    }
    
    public function busca($id){
		$query = 'SELECT * FROM produtos WHERE id_produto = '.$id;
		$con = new database2();
		$rs = $con->executa($query);
		if($rs && $rs->num_rows > 0){
			$dados = mysqli_fetch_assoc($rs);
			$this->id_produto = $dados['id_produto'];
			$this->id_produtos_categoria = $dados['id_produtos_categoria'];
			$this->nome_pt = $dados['nome_pt'];
			$this->referencia = $dados['referencia'];
			$this->codigo = $dados['codigo'];
			$this->composicao_pt = $dados['composicao_pt'];
			$this->lancamento = $dados['lancamento'];
			$this->imagem = $dados['imagem'];
			$this->cores = $dados['cores'];
			$this->ordem = $dados['ordem'];
			$this->nome_es = $dados['nome_es'];
			$this->composicao_es = $dados['composicao_es'];
		}
	}
	
    function  __destruct() {
    }
}