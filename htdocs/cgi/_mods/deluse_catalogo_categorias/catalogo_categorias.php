<?php
class catalogo_categorias {
	public $id_catalogo_categoria, $categoria, $slug;

	public function __construct() {
	}

	public function busca($id) {
		$tabela = "catalogo_categorias";
		$campos = "*";
		$condicao = "WHERE id_catalogo_categoria = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_catalogo_categoria = $id;
		$this->categoria = $dados['categoria'];
		$this->slug = $dados['slug'];
	}
	
	public function lista() {
		$con = new database2();
		$query = 'SELECT id_catalogo_categoria, categoria FROM catalogo_categorias ORDER BY categoria';
		$categorias = $con->query($query);
		if ($categorias && $categorias->num_rows > 0) {
			while ($categoria = $categorias->fetch_assoc()) {
				$dados[] = $categoria;
			}
			return $dados;
		}
	}
	
	public function __destruct() {
	}
}