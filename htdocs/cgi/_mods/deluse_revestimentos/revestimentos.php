<?php
class revestimentos{
	var $id_revestimento, $id_revestimentos_categoria, $id_revestimentos_subcategoria, $nome, $referencia, $imagem, $slug;

	function  __construct() {
	}
	public function busca($id){
		$query = 'SELECT * FROM revestimentos WHERE id_revestimento = '.$id;
		$con = new database2();
		$rs = $con->executa($query);
		if($rs && $rs->num_rows > 0){
			$dados = mysqli_fetch_assoc($rs);
			$this->id_revestimento = $id;
			$this->id_revestimentos_categoria = $dados['id_revestimentos_categoria'];
			$this->id_revestimentos_subcategoria = $dados['id_revestimentos_subcategoria'];
			$this->nome = $dados['nome'];
			$this->referencia = $dados['referencia'];
			$this->imagem = $dados['imagem'];
		}
	}
	function  __destruct() {
	}
}

?>
