<?php
class categorias_produtos{
    var $id_categorias_produto, $categoria;

    function  __construct() {
    }
    public function busca($id){
		$tabela = 'categorias_produtos';
		$campos = '*';
		$condicao = "WHERE id_categorias_produto = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_categorias_produto = $id;
		$this->categoria = $dados['categoria'];
	}
    function  __destruct() {
    }
}

?>
