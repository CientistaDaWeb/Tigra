<?php
class cursos {
    public $id_curso, $id_cursos_categoria, $curso, $descricao, $slug;

    public function __construct() {
    }
    public function busca($id) {
        $query = 'SELECT * FROM cursos WHERE id_curso ='.$id;
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_curso = $id;
        $this->id_cursos_categoria = $dados['id_cursos_categoria'];
        $this->curso = $dados['curso'];
        $this->descricao = $dados['descricao'];
    }
    public function __destruct() {
    }
}