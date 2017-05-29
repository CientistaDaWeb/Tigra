<?php 
class setors {
    public $id_setor, $setor, $slug;

    public function __construct() {

    }
    public function busca($id) {
        $query = 'SELECT * FROM setors WHERE id_setor = '.$id;
        $con = new database2();
        $rs = $con->executa($query);
        if($rs && $rs->num_rows > 0) {
            $dados = mysqli_fetch_assoc($rs);
            $this->id_setor = $id;
            $this->setor = $dados['setor'];
        }
    }
    public function __destruct() {

    }
}