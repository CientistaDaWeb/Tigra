<?php
class anuncios{
	public $id_anuncio, $id_anunciante, $anuncio, $tamanho, $altura, $largura, $impressoes_contratadas, $impressoes_efetuadas;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'anuncios';
		$campos = '*';
		$condicao = "WHERE id_anuncio = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_anuncio = $id;
		$this->id_anunciante = $dados['id_anunciante'];
		$this->anuncio = $dados['anuncio'];
		$this->tamanho = $dados['tamanho'];
		$this->altura = $dados['altura'];
		$this->largura = $dados['largura'];
		$this->impressoes_contratadas = $dados['impressoes_contratadas'];
		$this->impressoes_efetuadas = $dados['impressoes_efetuadas'];
	}
	
	public function __destruct(){
		
	}
}
?>