<?php
class noticias_categorias{
    var $id_noticias_categoria, $categoria, $url;

    function  __construct() {
    }
    public function busca($id){
		$tabela = 'noticias_categorias';
		$campos = '*';
		$condicao = "WHERE id_noticias_categoria = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_noticias_categoria = $id;
		$this->categoria = $dados['categoria'];
		$this->url = $dados['url'];
	}
    function  __destruct() {
    }
}

?>
