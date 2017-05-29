<?php
class noticias {
    public $id_noticia, $id_noticias_categoria, $id_setor, $titulo, $texto, $slug, $imagem, $data, $destaque;

    public function __construct() {
    }
    public function busca($id) {
        $query = 'SELECT * FROM noticias WHERE id_noticia ='.$id;
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_noticia = $id;
        $this->id_noticias_categoria = $dados['id_noticias_categoria'];
        $this->id_setor = $dados['id_setor'];
        $this->titulo = $dados['titulo'];
        $this->texto = $dados['texto'];
        $this->data = $dados['data'];
        $this->imagem = $dados['imagem'];
        $this->destaque = $dados['destaque'];
    }
    public function __destruct() {
    }
}