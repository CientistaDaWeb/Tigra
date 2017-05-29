<?php 
class produtos_categorias {
    public $id_produtos_categoria, $categoria, $slug;

    public function __construct() {
    }

    public function busca($id) {
        $query = 'SELECT * FROM produtos_categorias WHERE id_produtos_categoria = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        if($rs && $rs->num_rows > 0) {
            $dados = mysqli_fetch_assoc($rs);
            $this->id_produtos_categoria = $id;
            $this->categoria = $dados['categoria'];
        }
    }

    public function __destruct() {
    }
}