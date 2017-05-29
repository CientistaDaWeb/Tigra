<?php
class parceiros{
	public $id_parceiro, $parceiro, $imagem, $url_site;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'parceiros';
		$campos = '*';
		$condicao = "WHERE id_parceiro = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_parceiro = $id;
		$this->parceiro = $dados['parceiro'];
		$this->imagem = $dados['imagem'];
		$this->url_site = $dados['url_site'];
	}
	
	public function __destruct(){
		
	}
}
?>