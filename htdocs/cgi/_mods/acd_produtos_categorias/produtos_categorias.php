<?php 
class produtos_categorias {
    public $id_produtos_categoria, $categoria_pt, $slug_pt, $categoria_es, $slug_es;
    
    public function __construct() {
    }
    
    public function busca($id) {
    $query = 'SELECT * FROM produtos_categorias WHERE id_produtos_categoria = '.$id;
		$con = new database2();
		$rs = $con->executa($query);
		if($rs && $rs->num_rows > 0){
			$dados = mysqli_fetch_assoc($rs);
			$this->id_produtos_categoria = $id;
			$this->categoria_pt = $dados['categoria_pt'];
			$this->categoria_es = $dados['categoria_es'];
		}
    }
    
    public function __destruct() {
    }
}