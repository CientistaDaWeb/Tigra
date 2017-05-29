<?php
class cursos_categorias {
    var $id_cursos_categoria, $id_setor, $categoria, $slug;

    function  __construct() {
    }
    public function busca($id) {
        $query = 'SELECT * FROM cursos_categorias WHERE id_cursos_categoria = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_cursos_categoria = $id;
        $this->id_setor = $dados['id_setor'];
        $this->categoria = $dados['categoria'];
    }
    function  __destruct() {
    }
}