<?php
class produtos{
    var $id_produto, $id_produtos_categoria, $nome_pt, $caracteristicas_pt, $detalhes_pt, $embalagem_pt, $slug_pt, $nome_en, $caracteristicas_en, $detalhes_en, $embalagem_en, $slug_en, $nome_es, $caracteristicas_es, $detalhes_es, $embalagem_es, $slug_es, $imagem, $codigo_vinhovirtual, $ano, $preco;

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
		$this->nome_pt = $dados['nome_pt'];
		$this->caracteristicas_pt = $dados['caracteristicas_pt'];
        $this->detalhes_pt = $dados['detalhes_pt'];
        $this->embalagem_pt = $dados['embalagem_pt'];
        $this->slug_pt = $dados['slug_pt'];
        $this->nome_en = $dados['nome_en'];
		$this->caracteristicas_en = $dados['caracteristicas_en'];
        $this->detalhes_en = $dados['detalhes_en'];
        $this->embalagem_en = $dados['embalagem_en'];
        $this->slug_en = $dados['slug_en'];
        $this->nome_es = $dados['nome_es'];
		$this->caracteristicas_es = $dados['caracteristicas_es'];
        $this->detalhes_es = $dados['detalhes_es'];
        $this->embalagem_es = $dados['embalagem_es'];
        $this->slug_es = $dados['slug_es'];
        $this->imagem = $dados['imagem'];
        $this->codigo_vinhovirtual = $dados['codigo_vinhovirtual'];
        $this->ano = $dados['ano'];
        $this->preco = $dados['preco'];
	}
    function  __destruct() {
    }
}

?>
