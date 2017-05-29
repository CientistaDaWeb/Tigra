<?php
class obras {
    public $id_obra, $nome, $descricao, $longitude, $latitude, $endereco, $lancamento, $destaque, $concluido, $imagem, $pdf, $slug;

    public function __construct() {

    }
    public function busca($id) {
        $tabela = "obras";
        $campos = "*";
        $condicao = "WHERE id_obra = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_obra = $id;
        $this->nome = $dados['nome'];
        $this->descricao = $dados['descricao'];
        $this->longitude = $dados['longitude'];
        $this->latitude = $dados['latitude'];
        $this->endereco = $dados['endereco'];
        $this->lancamento = $dados['lancamento'];
        $this->destaque = $dados['destaque'];
        $this->descricao_destaque = $dados['descricao_destaque'];
        $this->concluido = $dados['concluido'];
        $this->imagem = $dados['imagem'];
        $this->pdf = $dados['pdf'];
        $this->slug = $dados['slug'];
    }
    public function __destruct() {

    }
}