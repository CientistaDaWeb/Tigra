<?php
class banners {
    public $id_banner, $id_setor, $titulo, $banner, $largura, $altura, $transparente, $slug;

    public function __construct() {
    }

    public function busca($id) {
        $con = new database2();
        $query = 'SELECT * FROM banners WHERE id_banner = '.$id;
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_banner = $id;
        $this->id_setor = $dados['id_setor'];
        $this->titulo = $dados['titulo'];
        $this->banner = $dados['banner'];
        $this->largura = $dados['largura'];
        $this->altura = $dados['altura'];
        $this->transparente = $dados['transparente'];
    }

    public function __destruct() {
    }
}