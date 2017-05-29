<?php
class caracteristicas_categorias{
	public $id_caracteristicas_categoria, $id_categorias_produto, $caracteristica, $carac;
	
	public function __construct(){}
	public function busca($id){
		$tabela = "caracteristicas_categorias";
		$campos = "*";
		$condicao = "WHERE id_caracteristicas_categoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
        $this->id_caracteristicas_categoria = $id;
		$this->id_categorias_produto = $dados['id_categorias_produto'];
		$this->caracteristica = $dados['caracteristica'];
        $this->carac = $dados['carac'];
	}
	
	public function __destruct(){}
}
?>