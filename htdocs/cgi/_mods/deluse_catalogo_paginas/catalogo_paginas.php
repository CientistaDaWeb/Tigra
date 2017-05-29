<?php
class catalogo_paginas{
	var $id_catalogo_pagina, $id_catalogo_categoria, $pagina, $imagem;

	function  __construct() {
	}
	public function busca($id){
		$tabela = 'catalogo_paginas';
		$campos = '*';
		$condicao = "WHERE id_catalogo_pagina = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_catalogo_pagina = $id;
		$this->id_catalogo_categoria = $dados['id_catalogo_categoria'];
		$this->pagina = $dados['pagina'];
		$this->imagem = $dados['imagem'];
	}
	function arrumaOrdem($pagina, $id=""){
		$con = new database2();
		if($id){
			$query = 'SELECT id_catalogo_pagina FROM catalogo_paginas WHERE pagina >= '.$pagina.' AND id_catalogo_pagina != '.$id.' ORDER BY pagina ASC';
		}else{
			$query = 'SELECT id_catalogo_pagina FROM catalogo_paginas WHERE pagina >= '.$pagina.' ORDER BY pagina ASC';
		}
		$paginas = $con->query($query);
		if($paginas && $paginas->num_rows > 0){
			while($pag = $paginas->fetch_assoc()){
				$pagina++;
				$query = 'UPDATE catalogo_paginas SET pagina = '.($pagina).' WHERE id_catalogo_pagina = '.$pag['id_catalogo_pagina'];
				$con->query($query);
			}
		}

	}
	function  __destruct() {
	}
}